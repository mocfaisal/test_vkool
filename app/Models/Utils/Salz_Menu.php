<?php

namespace App\Models\Utils;

use App\Models\Table\Role_Access;
use App\Models\Table\Menu2;

class Salz_Menu {
    private function buildMenu($parent, $menu) {
        // Menu builder function, parentId 0 is the root
        // reff : https://stackoverflow.com/a/39824933/10351006
        // this use fontawesome icons

        // declare variables

        $configDefaults = [
            'icon' => [
                'init_class' => '',
                'non_slider' => 'fa fa-circle-o',
                'slider' => 'fa fa-circle-o'
            ]
        ];


        $output = "";

        if (isset($menu['parents'][$parent])) {
            foreach ($menu['parents'][$parent] as $itemId) {
                $link = $menu['items'][$itemId]['url'];

                $url = (!empty($link) ? route($link) : 'javascript:void(0);');

                $icon =  $configDefaults['icon']['init_class'] . ' ' . ($menu['items'][$itemId]['icon'] ?? $configDefaults['icon']['non_slider']);
                $name = $menu['items'][$itemId]['name'];

                $is_navigated =  $menu['items'][$itemId]['is_navigated'] ?? 0;
                $depth_level =  $menu['items'][$itemId]['depth_level'] ?? 1;
                $txt_is_navigated = '';

                if (!empty($link)) {
                    $link_ = $this->get_routeLink($link);
                }

                if ($is_navigated == 1) {
                    $txt_is_navigated = 'wire:navigate';
                }

                if (!isset($menu['parents'][$itemId])) {

                    if ($menu['items'][$itemId]['parent_id'] == 0) {
                        // jika parent_id = 0
                        $output .= '<li class="sidebar-item">';
                        $output .= '<a href="' . $url . '" class="sidebar-link" ' . $txt_is_navigated .  '>';
                        $output .= '<i class="' . $icon . '"></i>';
                        $output .= '<span>' . $name . '</span>';
                        $output .= '</a>';
                        $output .= '</li>';
                    } else {

                        $output .= '<li class="submenu-item">';
                        $output .= '<a href="' . $url . '" class="submenu-link" ' . $txt_is_navigated .  '>';
                        // $output .= '<i class="' . $icon . '"></i>';
                        $output .= '<span>' . $name . '</span>';
                        $output .= '</a>';
                        $output .= '</li>';
                    }
                }

                if (isset($menu['parents'][$itemId])) {
                    // multi-level
                    $txt_itemClass = '';

                    if ($depth_level >= 2) {
                        $txt_itemClass = 'submenu';
                    } else {
                        // parent level 1
                        $txt_itemClass = 'sidebar';
                    }

                    $output .= '<li class="' . $txt_itemClass . '-item has-sub">';
                    $output .= '<a href="' . $url . '" class="' . $txt_itemClass . '-link" ' . $txt_is_navigated .  '>';
                    $output .= '<i class="' . $icon . '"></i>';
                    $output .= '<span>' . $name . '</span>';
                    $output .= '</a>';

                    $output .= '<ul class="submenu';

                    if ($depth_level >= 2) {
                        $output .= ' submenu-level-' . $depth_level;
                    }

                    $output .= '">';

                    $output .= $this->buildMenu($itemId, $menu);

                    $output .= '</ul>';
                    $output .= '</li>';
                }
            }
        }

        return $output;
    }

    private function buildMenu2($parent, $menu) {
        // Menu builder function, parentId 0 is the root
        // reff : https://stackoverflow.com/a/39824933/10351006
        // this use fontawesome icons

        // declare variables

        $configDefaults = [
            'icon' => [
                'init_class' => '',
                'non_slider' => 'fa fa-circle-o',
                'slider' => 'fa fa-circle-o'
            ]
        ];


        $output = "";

        if (isset($menu['parents'][$parent])) {
            foreach ($menu['parents'][$parent] as $itemId) {
                $link = $menu['items'][$itemId]['url'];

                $url = (!empty($link) ? route($link) : 'javascript:void(0);');

                $icon =  $configDefaults['icon']['init_class'] . ' ' . ($menu['items'][$itemId]['icon'] ?? $configDefaults['icon']['non_slider']);
                $name = $menu['items'][$itemId]['name'];

                $is_navigated =  $menu['items'][$itemId]['is_navigated'] ?? 0;
                $bool_navigate = false;

                if ($is_navigated == 1) {
                    $bool_navigate = true;
                }

                if (!isset($menu['parents'][$itemId])) {

                    if ($menu['items'][$itemId]['parent_id'] == 0) {
                        // jika parent_id = 0
                        $output .= '<x-maz-sidebar-item name="' . $name . '" :link="' . $url . '" icon="' . $icon . '" :navigate="' . $bool_navigate . '"></x-maz-sidebar-item>';
                    } else {

                        $output .= '<x-maz-sidebar-sub-item name="' . $name . '" :link="' . $url . '" :navigate="' . $bool_navigate . '"></x-maz-sidebar-sub-item>';
                    }
                }

                if (isset($menu['parents'][$itemId])) {
                    // multi-level
                    $output .= '<x-maz-sidebar-item name="' . $name . '" :link="' . $url . '" icon="' . $icon . '" :navigate="' . $bool_navigate . '">';
                    $output .= $this->buildMenu($itemId, $menu);
                    $output . '</x-maz-sidebar-item>';
                }
            }
        }

        return $output;
    }


    public function get_data() {
        $new_data = [];

        // Get Roles
        // Role_Access::get();

        // Get Menu
        $data = Menu2::selectRaw('id, parent_id, `name`, icon, slider, url, sort_no, keterangan as ket, is_active, is_navigated, depth_level')
            ->where('is_active', '1')
            ->orderBy('sort_no', 'asc')
            ->get()->toArray();

        foreach ($data as $key => $val) {
            if (empty($val['icon'])) {
                $val['icon'] = 'empty';
            }
            // $val['icon'] = "fa " . $val['icon'];

            $new_data[] = $val;
        }

        return $new_data;
    }

    public function printMenu() {
        /*
         * $nav_position : 0 -> left
         *				   1 -> top
         */

        // Select all entries from the menu table

        $menuz = array();
        $parentz = array();

        // $this->db->select('menu');
        // $this->db->from(tbl_roles);
        // $this->db->where('id', $this->roleid);

        // $role = $this->db->get()->result_array();

        // if (!empty($role)) {
        //     $rolez = unserialize($role[0]['menu']);
        //     foreach ($rolez as $keyx => $val) {
        //         $new_data['list']['parent_id'][$val['parent_id']] = $val['parent_id'];
        //         $new_data['list']['id_menu'][$val['id_menu']] = $val['id_menu'];
        //     }
        // }


        // if (!empty($this->id_unit)) {
        //     $this->db->select('id, parent_id');
        //     $this->db->from(tbl_menu);
        //     $this->db->where('is_active', '1');
        //     $this->db->where('id_unit', $this->id_unit);
        //     $get  = $this->db->get();
        //     $data2 = $get->result_array();

        //     if (!empty($data2)) {
        //         foreach ($data2 as $key => $val) {

        //             $new_data['list']['parent_id'][$val['parent_id']] = $val['parent_id'];
        //             $new_data['list']['id_menu'][$val['id']] = $val['id'];
        //         }
        //     }
        // }

        // $new_data['list_data'] = array_values(array_filter(array_unique(array_merge($new_data['list']['parent_id'], $new_data['list']['id_menu']))));

        // unset($new_data['list']);

        // $this->db->select('*');
        // $this->db->from(tbl_menu);
        // $this->db->order_by('sort_no', 'asc');
        // $this->db->order_by('parent_id', 'asc');
        // $this->db->where('is_active', '1');

        // if (!empty($this->id_unit)) {
        //     $this->db->group_start();
        //     $this->db->where('id_unit', $this->id_unit);
        //     $this->db->or_where('id_unit', null);
        //     $this->db->group_end();
        // }

        // $this->db->where_in('id', $new_data['list_data']);

        // $get  = $this->db->get();
        // $data = $get->result_array();

        $data = $this->get_data();

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $result[] = $value;
            }

            // Create a multidimensional array to conatin a list of items and parents
            $menu = array(
                'items'   => array(),
                'parents' => array(),
            );

            // Builds the array lists with data from the menu table
            foreach ($result as $items) {
                // Creates entry into items array with current menu item id ie. $menu['items'][1]
                $menu['items'][$items['id']] = $items;
                // Creates entry into parents array. Parents array contains a list of all items with children
                $menu['parents'][$items['parent_id']][] = $items['id'];
            }

            echo $this->buildMenu(0, $menu);
        }
    }

    public function printMenu2() {
        /*
         * $nav_position : 0 -> left
         *				   1 -> top
         */

        // Select all entries from the menu table

        $menuz = array();
        $parentz = array();

        // $this->db->select('menu');
        // $this->db->from(tbl_roles);
        // $this->db->where('id', $this->roleid);

        // $role = $this->db->get()->result_array();

        // if (!empty($role)) {
        //     $rolez = unserialize($role[0]['menu']);
        //     foreach ($rolez as $keyx => $val) {
        //         $new_data['list']['parent_id'][$val['parent_id']] = $val['parent_id'];
        //         $new_data['list']['id_menu'][$val['id_menu']] = $val['id_menu'];
        //     }
        // }


        // if (!empty($this->id_unit)) {
        //     $this->db->select('id, parent_id');
        //     $this->db->from(tbl_menu);
        //     $this->db->where('is_active', '1');
        //     $this->db->where('id_unit', $this->id_unit);
        //     $get  = $this->db->get();
        //     $data2 = $get->result_array();

        //     if (!empty($data2)) {
        //         foreach ($data2 as $key => $val) {

        //             $new_data['list']['parent_id'][$val['parent_id']] = $val['parent_id'];
        //             $new_data['list']['id_menu'][$val['id']] = $val['id'];
        //         }
        //     }
        // }

        // $new_data['list_data'] = array_values(array_filter(array_unique(array_merge($new_data['list']['parent_id'], $new_data['list']['id_menu']))));

        // unset($new_data['list']);

        // $this->db->select('*');
        // $this->db->from(tbl_menu);
        // $this->db->order_by('sort_no', 'asc');
        // $this->db->order_by('parent_id', 'asc');
        // $this->db->where('is_active', '1');

        // if (!empty($this->id_unit)) {
        //     $this->db->group_start();
        //     $this->db->where('id_unit', $this->id_unit);
        //     $this->db->or_where('id_unit', null);
        //     $this->db->group_end();
        // }

        // $this->db->where_in('id', $new_data['list_data']);

        // $get  = $this->db->get();
        // $data = $get->result_array();

        $data = $this->get_data();

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $result[] = $value;
            }

            // Create a multidimensional array to conatin a list of items and parents
            $menu = array(
                'items'   => array(),
                'parents' => array(),
            );

            // Builds the array lists with data from the menu table
            foreach ($result as $items) {
                // Creates entry into items array with current menu item id ie. $menu['items'][1]
                $menu['items'][$items['id']] = $items;
                // Creates entry into parents array. Parents array contains a list of all items with children
                $menu['parents'][$items['parent_id']][] = $items['id'];
            }

            echo $this->buildMenu2(0, $menu);
        }
    }

    private function get_routeLink($url) {
        $urlExp = explode('.', $url);
        array_pop($urlExp);

        return implode('.', $urlExp);
    }
}
