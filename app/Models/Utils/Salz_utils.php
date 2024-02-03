<?php

namespace App\Models\Utils;

use Illuminate\Support\Facades\Storage;
use App\Models\Utils\Salz_Encryption;

class Salz_utils {
    protected $Salz_Encryption;

    public function __construct() {
        $this->Salz_Encryption = new Salz_Encryption();
    }


    public function convertStdToArray($data) {
        // NOTE convert object std to array
        $result = collect($data)->map(function ($x) {
            return (array) $x;
        })->toArray();

        return $result;
    }

    public function convertMonthToNum_id($date, $ReplaceWithleadingZero = false) {
        $list_search = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des',];
        if ($ReplaceWithleadingZero) {
            $List_replace = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        } else {
            $List_replace = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        }
        return str_replace($list_search, $List_replace, $date);
    }

    public function objectToArray2($dataJson) {
        $data = array();

        foreach ($dataJson as $key => $value) {
            # Remove ' from value
            $value = str_replace("'", '', $value);

            # Set value as array not as array object from json_encode
            $value = (array) json_decode($value, true);

            # Pushing into $old_data
            $data = $value;
        }

        return $data;
    }

    public function parseJsonArray($jsonArray, $parentID = 0, $parentIndex = 'parent_id', $idIndex = 'id', $withOtherData = false) {
        $return = array();

        foreach ($jsonArray as $subArray) {
            $returnSubSubArray = array();

            if (isset($subArray['children'])) {
                $returnSubSubArray = $this->parseJsonArray($subArray['children'], $subArray[$idIndex], $parentIndex, $idIndex, $withOtherData);
            }

            if ($withOtherData) {
                unset($subArray['children']);

                $return[] = array($idIndex => $subArray[$idIndex], $parentIndex => $parentID, 'other' => $subArray);
            } else {
                $return[] = array($idIndex => $subArray[$idIndex], $parentIndex => $parentID);
            }

            $return = array_merge($return, $returnSubSubArray);
        }

        return $return;
    }

    /**
     * Builds a tree array.
     * call function on looping values
     * ex : buildTree($row, $parentId)
     *
     * refference : https://stackoverflow.com/a/13878662/10351006
     * @param  array   $data     The data array
     * @param  integer $parentId The parent identifier
     * @return array   The tree.
     */
    public function buildTree($data = array(), $parentId = 0, $parentIndex = 'parent_id', $idIndex = 'id', $is_counted_children = false) {
        $branch     = array();
        $sort_index = 1;


        if (count($data) > 1) {
            foreach ($data as $element) {
                $element['sort_index'] = $sort_index;

                if ($element[$parentIndex] == $parentId) {
                    $children = $this->buildTree($data, $element[$idIndex], $parentIndex, $idIndex, $is_counted_children);

                    if ($children) {
                        if ($is_counted_children) {
                            $element['count_child'] = count($children);
                        }
                        $element['children'] = $children;
                    }
                    // else{
                    // $element['count_child'] = 1;
                    // }

                    $branch[] = $element;
                }

                $sort_index++;
            }
        } else {
            return $data;
        }

        return $branch;
    }

    public function get_assetFile($file_path, $disk = 'public') {
        if (Storage::disk($disk)->exists($file_path)) {
            $url = Storage::disk($disk)->url($file_path);
            return asset($url);
        }
        return false;
    }

    public function delete_assetFile($file_path, $disk = 'public') {
        if (Storage::disk($disk)->exists($file_path)) {
            Storage::disk($disk)->delete($file_path);
            return true;
        }
        return false;
    }

    public function upload_file_replace($objfile, $filepath, $old_filename, $new_filename, $disk = 'public') {
        // NOTE Delete old file & update with new file

        // Delete old file
        $is_delete = $this->delete_assetFile($filepath . '/' . $old_filename, $disk);

        // Upload new file
        $path = $objfile->storeAs($filepath, $new_filename, $disk);
        return true;
    }

    public function encrypt_password($password) {
        return $this->Salz_Encryption->encrypt($password);
    }

    // decrypt password
    public function decrypt_password($password) {
        return $this->Salz_Encryption->decrypt($password);
    }

    // Number Formatting
    public function ceiling($number, $multiple) {
        return ceil($number / $multiple) * $multiple;
    }
}
