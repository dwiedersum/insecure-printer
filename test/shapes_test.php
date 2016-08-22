<?php
namespace test\shapes;

require("../lib/shapes.php");

use PHPUnit\Framework\TestCase;
use shapes;

class shapes_testcase extends TestCase {

    public function test_whitespace_string(){
        $this->assertEquals("", shapes\whitespace_string(0));
        $this->assertEquals("     ", shapes\whitespace_string(5));
    }

    public function test_pad_left_and_right_with_spaces(){
        $this->assertEquals("   Hallo   ",
                           shapes\pad_left_and_right("Hallo", 3));
        $this->assertEquals("  Test  ",
                           shapes\pad_left_and_right("Test", 2));
    }

    public function test_hash_string(){
        $this->assertEquals("", shapes\hash_length(0));
        $this->assertEquals("#####", shapes\hash_length(5));
    }

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

    public function test_triangle_build(){
        $this->assertEquals("   #\n  ###\n #####\n#######\n",
                            shapes\build_triangle(4));
        $this->assertEquals(" #\n###\n",
                            shapes\build_triangle(2));
        $this->assertEquals("", shapes\build_triangle(0));
        $this->assertEquals("", shapes\build_triangle(-1));
    }

    public function test_draw_shape(){
        $this->assertEquals("###\n###\n###\n",
                            shapes\draw_shape_with_input_from_commandline("square", 3));
        $this->assertEquals("#\n##\n###\n##\n#\n",
                            shapes\draw_shape_with_input_from_commandline("arrow", 3));
        $this->assertEquals("  #\n ###\n#####\n ###\n  #\n",
                            shapes\draw_shape_with_input_from_commandline("rotated square", 3));
        $this->assertEquals("  #\n ###\n#####\n",
                            shapes\draw_shape_with_input_from_commandline("triangle", 3));
        $this->assertEquals(false,
                            shapes\draw_shape_with_input_from_commandline("pyramid", 4));
    }

    public function test_open_help(){
        $this->assertEquals(true, shapes\open_help("help"));
        $this->assertEquals(false, shapes\open_help());
    }

    public function test_messages_to_shape_choice(){
        $this->assertEquals("square", shapes\message_to_shape_choice("square"));
        $this->assertEquals("arrow", shapes\message_to_shape_choice("arrow"));
        $this->assertEquals("square rotated", shapes\message_to_shape_choice("square rotated"));
        $this->assertEquals(false, shapes\message_to_shape_choice(false));
    }

    public function test_categorize_options_from_cli(){
        $this->assertEquals("help", shapes\categorize_options_from_cli("help"));
        $this->assertEquals("hallo", shapes\categorize_options_from_cli("hallo"));
        $this->assertEquals(array("hallo", "tschüss", "welt"), shapes\categorize_options_from_cli(array("hallo", "tschüss", "welt")));
        $this->assertEquals(false, shapes\categorize_options_from_cli(array("hallo", "welt")));
        $this->assertEquals(false, shapes\categorize_options_from_cli(false));
    }

}
