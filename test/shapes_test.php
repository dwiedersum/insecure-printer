<?php
namespace test\shapes;

require("../lib/shapes.php");

use PHPUnit\Framework\TestCase;
use shapes;

class shapes_testcase extends TestCase {

    public function test_square_build(){
        $this->assertEquals("###\n###\n###\n", shapes\build_square(3));
        $this->assertEquals("", shapes\build_square(0));
        $this->assertEquals("#####\n#####\n#####\n#####\n#####\n", shapes\build_square(5));
        $this->assertEquals("##\n##\n", shapes\build_square(2));
        $this->assertEquals("", shapes\build_square(-1));
    }

    public function test_arrow_build(){
        $this->assertEquals("#\n##\n###\n####\n###\n##\n#\n", shapes\build_arrow(4));
        $this->assertEquals("#\n##\n#\n", shapes\build_arrow(2));
        $this->assertEquals("", shapes\build_arrow(0));
        $this->assertEquals("", shapes\build_arrow(-1));
    }

    public function test_rotated_square(){
        $this->assertEquals("   #\n  ###\n #####\n#######\n #####\n  ###\n   #\n",
                            shapes\build_rotated_square(4));
        $this->assertEquals(" #\n###\n #\n",
                            shapes\build_rotated_square(2));
        $this->assertEquals("", shapes\build_rotated_square(0));
        $this->assertEquals("", shapes\build_rotated_square(-1));
    }

    public function test_draw_shape(){
        $this->assertEquals("###\n###\n###\n",
                            shapes\draw_shape_with_input_from_commandline("square", 3));
        $this->assertEquals("#\n##\n###\n##\n#\n",
                            shapes\draw_shape_with_input_from_commandline("arrow", 3));
        $this->assertEquals("  #\n ###\n#####\n ###\n  #\n",
                            shapes\draw_shape_with_input_from_commandline("rotated square", 3));
        $this->assertEquals("\nDie gewünsche geometrische Form kann nicht gebaut werden.\n" .
               "Für weitere Informationen geben Sie 'php print_shape.php -h' ein.\n\n",
                            shapes\draw_shape_with_input_from_commandline("triangle", 3));
    }

    public function test_open_help(){
        $this->assertEquals(true, shapes\open_help(h));
    }

}
