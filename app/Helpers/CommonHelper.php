<?php

namespace App\Helpers;

class CommonHelper {

    /**
     * Making URL for invoice depends on id.
     *
     * @param $id
     * @return string
     */
    public static function makeUrl($id)
    {
        $random     = rand(0, 1000);
        $invoiceUrl = md5($random . '@@@@@' . $id);

        return $invoiceUrl;
    }
}