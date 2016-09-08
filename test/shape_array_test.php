<?php
namespace test\shape_array;
require("../lib/shape_array.php");
require_once("../lib/shapes.php");
require_once("../lib/big_shapes.php");

use PHPUnit\Framework\TestCase;
//use shapes;
use shapes\Figure;
use big_shapes\BigFigure;
use shape_array as sa;

class big_shapes_testcase extends TestCase {
    public function test_default_figure_produces_right_array(){
        $square = new Figure();
        $this->assertEquals([[1, 1, 1],
                             [1, 1, 1],
                             [1, 1, 1]], sa\shape_array($square));
    }

    public function test_figure_with_size_4_produces_right_array(){
        $square = new Figure("square", 4);
        $this->assertEquals([[1, 1, 1, 1],
                             [1, 1, 1, 1],
                             [1, 1, 1, 1],
                             [1, 1, 1, 1]], sa\shape_array($square));
    }

    public function test_big_figure_array_with_size_1(){
        $filler = new Figure("square", 2);
        $square = new BigFigure("square", 1, $filler);
        $this->assertEquals([[1, 1],
                             [1, 1]], sa\big_shape_array($square));

    }

    public function test_big_figure_array_with_size_2(){
        $filler = new Figure("square", 2);
        $square = new BigFigure("square", 2, $filler);
        $this->assertEquals([[1, 1, 1, 1],
                             [1, 1, 1, 1],
                             [1, 1, 1, 1],
                             [1, 1, 1, 1]], sa\big_shape_array($square));
    }
}