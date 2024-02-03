<?php

namespace App\Livewire\Backend\Admin\Settings\Menu;

use Illuminate\Http\Request;
use App\Models\Table\Menu2;
use App\Models\Utils\Salz_utils;

use Livewire\Component;

class Index extends Component {
    protected $Salz_utils;

    public function render() {
        return view('livewire.backend.admin.settings.menu.index')
            ->layout("layouts.backend.admin.mainLayout");
    }


    public function __construct() {
        $this->Salz_utils = new Salz_utils();
    }

    function mount() {
    }

    function getData() {
        $this->skipRender();
        // return json

        $new_data = [];
        $data = Menu2::selectRaw('id, parent_id, `name` AS text, icon, slider, url, sort_no, keterangan as ket, is_active, is_navigated')
            ->where('is_active', '1')
            ->orderBy('sort_no', 'asc')
            ->get()->toArray();

        if ($data) {
            foreach ($data as $key => $val) {
                if (empty($val['icon'])) {
                    $val['icon'] = 'empty';
                }
                // $val['icon'] = "fa " . $val['icon'];

                $new_data[] = $val;
            }
        }

        // dd($new_data);

        $treeList = $this->Salz_utils->buildTree($new_data);
        unset($new_data);
        $new_data = $treeList;

        // dd($new_data);

        if (!empty($new_data)) {
            $r = ['success' => true, 'data' => $new_data];
        } else {
            $r['msg'] = 'Data is empty';
        }

        return response()->json($r);
    }

    function save(Request $request) {
        if ($request->ajax()) {

            $dataSave = [
                'update' => [],
                'insert' => [],
            ];
            $new_data = [];
            $whereArr = [];

            $tgl_now = date('Y-m-d H:i:s');
            $is_save = false;
            $save1 = false;
            $save2 = false;

            if ($request->has('dataJson')) {

                $dataJson = $request->input("dataJson");

                $new_data = $this->Salz_utils->objectToArray2($dataJson);

                // dd($new_data);

                $old_data2 = $this->parseJsonArray($new_data);
                $new_data = $old_data2;

                // dd($new_data);
                $iterate_parent = 1;
                $iterate_child = 1;

                foreach ($new_data as $key => $val) {
                    $is_children = $val['is_children'];
                    $id = $val['id'];
                    $parent_id = $val['parent_id'];
                    $menu_name = $val['text'];
                    $keterangan = $val['ket'];
                    $icon = $val['icon'];
                    $url = $val['url'];
                    $is_navigated = $val['is_navigated'] ?: 0;
                    // $index = $val['index'] ?? $val['index_key'] ?: 0;
                    // $index = $key;
                    $depth_level = $val['depth_level'] ?? 1;

                    if ($is_children) {
                        $is_slider = '1';
                    } else {
                        $is_slider = '0';
                    }

                    if (empty($menu_name)) {
                        $r = ['success' => false, 'msg' => 'Data save failed!'];
                        return response()->json($r);
                    }


                    if ($parent_id != 0) {
                        // child menu

                        $dataArr = array(
                            'parent_id' => $parent_id,
                            'name' => $menu_name,
                            'keterangan' => $keterangan,
                            'icon' => $icon,
                            'url' => $url,
                            // 'id' => $id,
                            'sort_no' => $iterate_child,
                            // 'sort_no' => $index,
                            // 'slider' => '0',
                            'slider' => $is_slider,
                            'is_navigated' => $is_navigated,
                            'depth_level' => $depth_level,
                        );

                        if (!empty($id)) {
                            $dataArr['id'] = $id;
                            $dataArr['date_update'] = $tgl_now;
                            array_push($dataSave['update'], $dataArr);
                        } else {
                            $dataArr['date_create'] = $tgl_now;
                            array_push($dataSave['insert'], $dataArr);
                        }

                        $iterate_child++;
                    } else {
                        // parent menu

                        $dataArr = array(
                            'parent_id' => $parent_id,
                            'name' => $menu_name,
                            'keterangan' => $keterangan,
                            'icon' => $icon,
                            'url' => $url,
                            // 'id' => $id,
                            'sort_no' => $iterate_parent,
                            // 'sort_no' => $index,
                            'slider' => $is_slider,
                            'is_navigated' => $is_navigated,
                            'depth_level' => $depth_level,
                        );

                        // dd($dataArr);

                        if (!empty($id)) {
                            $dataArr['id'] = $id;
                            $dataArr['date_update'] = $tgl_now;
                            array_push($dataSave['update'], $dataArr);
                        } else {
                            $dataArr['date_create'] = $tgl_now;
                            array_push($dataSave['insert'], $dataArr);
                        }

                        $iterate_parent++;
                        $iterate_child = 1;
                    }
                }
            }

            // dd($dataSave);

            if (!empty($dataSave['insert'])) {
                $save1 = Menu2::insert($dataSave['insert']);
            }

            if (!empty($dataSave['update'])) {
                $save2 = Menu2::upsert($dataSave['update'], ['id'], ['parent_id', 'name', 'keterangan', 'icon', 'url', 'sort_no', 'slider', 'is_navigated', 'depth_level']);
            }

            if ($save1 || $save2) {
                $is_save = true;
            }

            if ($is_save) {
                $r = ['success' => true, 'msg' => 'Data saved!'];
            } else {
                $r = ['success' => false, 'msg' => 'Data save failed!'];
            }

            return response()->json($r);
        } else {
            return false;
        }
    }


    /* -------------------------------------------------------------------------- */
    /*                              Private Function                              */
    /* -------------------------------------------------------------------------- */

    private function parseJsonArray($jsonArray, $parentID = 0, $depth_level = 1, $is_children_ = false)
    {
        // Only for menu
        $parentIndex = 'parent_id';
        $idIndex = 'id';

        $return = array();

        // print_r($jsonArray);exit;

        $is_multiArr = $this->is_multidimensional($jsonArray);

        if ($is_multiArr) {
            $depth_level_ = $depth_level;
            if ($is_children_) {
                $depth_level_++;
            }


            foreach ($jsonArray as $key => $subArray) {
                $is_children = false;
                $returnSubSubArray = array();
                $index = $subArray['index'] ?? null;

                if (isset($subArray['children'])) {
                    $is_children = true;
                    $returnSubSubArray = $this->parseJsonArray($subArray['children'], $subArray[$idIndex], $depth_level_, $is_children);
                }

                // $return[] = $subArray;
                $return[] = array(
                    $idIndex => $subArray[$idIndex],
                    $parentIndex => $parentID,
                    'is_children' => $is_children,
                    'text' => $subArray['text'],
                    'icon' => $subArray['icon'],
                    'url' => $subArray['url'],
                    'ket' => $subArray['ket'],
                    'is_navigated' => $subArray['is_navigated'] ?? 0,
                    'index' => $index,
                    'index_key' => $key,
                    'depth_level' => $depth_level_,
                );


                $return = array_merge($return, $returnSubSubArray);

                // unset($subArray[$idIndex], $subArray[$parentIndex], $subArray['is_children']);
            }
        } else {
            // else not multidimesional array
            $index = $jsonArray['index'] ?? null;
            $return[] = array(
                $idIndex => $jsonArray[$idIndex],
                $parentIndex => $parentID,
                'is_children' => false,
                'text' => $jsonArray['text'],
                'icon' => $jsonArray['icon'],
                'url' => $jsonArray['url'],
                'ket' => $jsonArray['ket'],
                'is_navigated' => $jsonArray['is_navigated'] ?? 0,
                'index' => $index,
                'index_key' => 0,
                'depth_level' => 1,
            );
        }



        // print_r($return); exit;
        return $return;
    }

    private function is_multidimensional(array $array)
    {
        return count($array) !== count($array, COUNT_RECURSIVE);
    }
}
