<?php

namespace App\Common;

class Animal implements AnimalInterface
{
    /**
     * @var int
     */
    private $var;



    public function __construct()
    {
        $this->var = 1;
    }

    /**
     * Передвижение
     *
     * @param integer $speed скорость
     */
    public function move($speed)
    {
         $x = $speed * $this->calcK();
        return $x;
    }

    /**
     * Коэффициент
     *
     * @return int
     */
    private function calcK()
    {
        // a + b
        return 1;
    }

    /**
     * @return int
     */
    public function getVar(): int
    {
        //
        return $this->var;
    }

    /**
     * @param int $var
     */
    public function setVar(int $var)
    {
        //
        $this->var = $var;
    }

    /**
     * @return mixed
     */
    public function die()
    {
        // TODO: Implement die() method.
    }
}