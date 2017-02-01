<?php

namespace App\Lib\Skills\Traits;

use \App\Lib\Utils\Debugger;

trait ParseItemsTrait
{
    public static function parseItems($itemsFull, $sortByList = false)
    {
        $items = [];

        foreach ($itemsFull as $item) {
            if ($sortByList) {
                $items[$item->list_id][$item->field_order] = $item->entry_text;
            } else {
                $items[$item->field_order] = $item->entry_text;
            }
        }

        return $items;
    }


}