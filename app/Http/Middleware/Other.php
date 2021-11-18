<?php

namespace App\Http\Middleware;

class Other
{
    public function doOther()
    {
        $cat = new Cat();
        $meow = $cat->meow();
        $methodA = $cat::methodA();
        $m = $cat::CAT_VOICE;
    }
}