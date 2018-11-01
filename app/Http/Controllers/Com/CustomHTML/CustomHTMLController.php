<?php

namespace App\Http\Controllers\Com\CustomHTML;

use App\Http\Controllers\Controller;

class CustomHTMLController extends Controller {

    function customhtml($page, $block) {
        return $block;
    }
    
}
