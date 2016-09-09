<?php
namespace test\shape_array;
require("../lib/shape_array.php");
require_once("../lib/shapes.php");

use PHPUnit\Framework\TestCase;
use shapes\Figure;
use shape_array\BigFigure;
use shape_array as sa;

class big_shapes_testcase extends TestCase {
    public function test_default_figure_produces_right_array(){
        $square = new Figure();
        $this->assertEquals([[1, 1, 1],
                             [1, 1, 1],
                             [1, 1, 1]], sa\shape_array($square));
    }

    public function test_square_with_size_4_produces_right_array(){
        $square = new Figure("square", 4);
        $this->assertEquals([[1, 1, 1, 1],
                             [1, 1, 1, 1],
                             [1, 1, 1, 1],
                             [1, 1, 1, 1]], sa\shape_array($square));
    }

    public function test_rotated_square_with_size_3_produces_right_array(){
        $rot_square = new Figure("rotated square", 3);
        $this->assertEquals([[0, 1, 0],
                             [1, 1, 1],
                             [0, 1, 0]], sa\shape_array($rot_square));
    }

    public function test_arrow_with_size_3_produces_right_array(){
        $arrow = new Figure("arrow", 3);
        $this->assertEquals([[1, 0, 0],
                             [1, 1, 0],
                             [1, 0, 0]], sa\shape_array($arrow));
    }

    public function test_triangle_with_size_3_produces_right_array(){
        $triangle = new Figure("triangle", 3);
        $this->assertEquals([[1, 0, 0],
                             [1, 1, 0],
                             [1, 1, 1]], sa\shape_array($triangle));
    }

    public function test_triangle_with_size_4_produces_right_array(){
        $triangle = new Figure("triangle", 4);
        $this->assertEquals([[1, 0, 0, 0],
                             [1, 1, 0, 0],
                             [1, 1, 1, 0],
                             [1, 1, 1, 1]], sa\shape_array($triangle));
    }

    public function test_big_figure_array_with_size_1(){
        $filler = new Figure("square", 2);
        $square = new BigFigure("square", 1, $filler);
        $triangle_filler = new Figure("triangle", 2);
        $square_2 = new BigFigure("square", 1, $triangle_filler);
        $rot_square_filler = new Figure("rotated square", 3);
        $arrow_filler = new Figure("arrow", 3);
        $square_3 = new BigFigure("square", 1, $rot_square_filler);
        $square_4 = new BigFigure("square", 1, $arrow_filler);
        $this->assertEquals([[1, 1],
                             [1, 1]], sa\big_shape_array($square));
        $this->assertEquals([[1, 0],
                             [1, 1]], sa\big_shape_array($square_2));
        $this->assertEquals([[0, 1, 0],
                             [1, 1, 1],
                             [0, 1, 0]], sa\big_shape_array($square_3));
        $this->assertEquals([[1, 0, 0],
                             [1, 1, 0],
                             [1, 0, 0]], sa\big_shape_array($square_4));
    }

    public function test_big_figure_array_with_size_2(){
        $filler = new Figure("square", 2);
        $square = new BigFigure("square", 2, $filler);
        $triangle_filler = new Figure("triangle", 2);
        $square_2 = new BigFigure("square", 2, $triangle_filler);
        $rot_square_filler = new Figure("rotated square", 3);
        $arrow_filler = new Figure("arrow", 3);
        $square_3 = new BigFigure("square", 2, $rot_square_filler);
        $square_4 = new BigFigure("square", 2, $arrow_filler);
        $this->assertEquals([[1, 1, 0, 1, 1],
                             [1, 1, 0, 1, 1],
                             [0, 0, 0, 0, 0],
                             [1, 1, 0, 1, 1],
                             [1, 1, 0, 1, 1]], sa\big_shape_array($square));
        $this->assertEquals([[1, 0, 0, 1, 0],
                             [1, 1, 0, 1, 1],
                             [0, 0, 0, 0, 0],
                             [1, 0, 0, 1, 0],
                             [1, 1, 0, 1, 1]], sa\big_shape_array($square_2));
        $this->assertEquals([[0, 1, 0, 0, 0, 1, 0],
                             [1, 1, 1, 0, 1, 1, 1],
                             [0, 1, 0, 0, 0, 1, 0],
                             [0, 0, 0, 0, 0, 0, 0],
                             [0, 1, 0, 0, 0, 1, 0],
                             [1, 1, 1, 0, 1, 1, 1],
                             [0, 1, 0, 0, 0, 1, 0]], sa\big_shape_array($square_3));
        $this->assertEquals([[1, 0, 0, 0, 1, 0, 0],
                             [1, 1, 0, 0, 1, 1, 0],
                             [1, 0, 0, 0, 1, 0, 0],
                             [0, 0, 0, 0, 0, 0, 0],
                             [1, 0, 0, 0, 1, 0, 0],
                             [1, 1, 0, 0, 1, 1, 0],
                             [1, 0, 0, 0, 1, 0, 0]], sa\big_shape_array($square_4));
    }

    public function test_line_chunk(){
        $filler = new Figure("square", 2);
        $triangle_filler = new Figure("triangle", 2);
        $square = new BigFigure("square", 2, $filler);
        $square_2 = new BigFigure("square", 2, $triangle_filler);
        $rot_square_filler = new Figure("rotated square", 3);
        $arrow_filler = new Figure("arrow", 3);
        $square_3 = new BigFigure("square", 2, $rot_square_filler);
        $square_4 = new BigFigure("square", 2, $arrow_filler);
        $this->assertEquals([[1, 1, 0, 1, 1],
                             [1, 1, 0, 1, 1]], sa\build_line_chunk($square));
        $this->assertEquals([[1, 0, 0, 1, 0],
                             [1, 1, 0, 1, 1]], sa\build_line_chunk($square_2));
        $this->assertEquals([[0, 1, 0, 0, 0, 1, 0],
                             [1, 1, 1, 0, 1, 1, 1],
                             [0, 1, 0, 0, 0, 1, 0]], sa\build_line_chunk($square_3));
        $this->assertEquals([[1, 0, 0, 0, 1, 0, 0],
                             [1, 1, 0, 0, 1, 1, 0],
                             [1, 0, 0, 0, 1, 0, 0]], sa\build_line_chunk($square_4));
    }

    public function test_draw_big_shape_with_size_1(){
        $filler = new Figure("square", 2);
        $triangle_filler = new Figure("triangle", 2);
        $square = new BigFigure("square", 1, $filler);
        $square_2 = new BigFigure("square", 1, $triangle_filler);
        $rot_square_filler = new Figure("rotated square", 3);
        $arrow_filler = new Figure("arrow", 3);
        $square_3 = new BigFigure("square", 1, $rot_square_filler);
        $square_4 = new BigFigure("square", 1, $arrow_filler);
        $this->assertEquals("##\n##\n", sa\draw_big_shape($square));
        $this->assertEquals("# \n##\n", sa\draw_big_shape($square_2));
        $this->assertEquals(" # \n###\n # \n", sa\draw_big_shape($square_3));
        $this->assertEquals("#  \n## \n#  \n", sa\draw_big_shape($square_4));
    }

    public function test_draw_big_shape_with_size_2(){
        $filler = new Figure("square", 2);
        $triangle_filler = new Figure("triangle", 2);
        $square = new BigFigure("square", 2, $filler);
        $square_2 = new BigFigure("square", 2, $triangle_filler);
        $rot_square_filler = new Figure("rotated square", 3);
        $arrow_filler = new Figure("arrow", 3);
        $square_3 = new BigFigure("square", 2, $rot_square_filler);
        $square_4 = new BigFigure("square", 2, $arrow_filler);
        $this->assertEquals("## ##\n## ##\n     \n## ##\n## ##\n", sa\draw_big_shape($square));
        $this->assertEquals("#  # \n## ##\n     \n#  # \n## ##\n", sa\draw_big_shape($square_2));
        $this->assertEquals(" #   # \n### ###\n #   # \n       \n #   # \n### ###\n #   # \n", sa\draw_big_shape($square_3));
        $this->assertEquals("#   #  \n##  ## \n#   #  \n       \n#   #  \n##  ## \n#   #  \n", sa\draw_big_shape($square_4));
    }
}
