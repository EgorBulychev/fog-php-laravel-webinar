<?php

namespace App\Common;

interface AnimalInterface
{
    /**
     * @param $speed
     *
     * @return mixed
     */
    public function move($speed);

    /**
     * @return mixed
     */
    public function die();
}