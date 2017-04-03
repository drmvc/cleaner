<?php namespace DrMVC\Helpers;

class HTML
{

    /**
     * Generate selectors
     *
     * @param $name
     * @param $arr
     * @param int $test
     * @param null $data_id
     * @return string
     */
    public static function selector($name, $arr, $test = -1, $data_id = NULL)
    {
        $out = "<select class='" . $name . " form-control' name='" . $name . "' data-id='" . $data_id . "'>";
        //$out = $out."<option value='NULL' disabled selected>---</option>";
        $out = $out . "<option value='NULL' selected>---</option>";
        $i = 0;
        while ($i < count($arr)) {
            if ($test != $arr[$i]->id) {
                $out = $out . "<option value='" . $arr[$i]->id . "'>" . $arr[$i]->name . "</option>";
            } else {
                $out = $out . "<option value='" . $arr[$i]->id . "' selected>" . $arr[$i]->name . "</option>";
            }
            $i++;
        }
        $out = $out . "</select>";
        return $out;
    }

    /**
     * Generate checkbox
     *
     * @param $name
     * @param $status
     * @param null $id
     * @return string
     */
    public static function checkbox($name, $status, $id = NULL)
    {
        if ('t' == $status) $ch = 'checked'; else  $ch = '';
        return "<input type='checkbox' class='checkbox " . $name . "' data-id='" . $id . "' name='" . $name . "' " . $ch . ">";
    }

}
