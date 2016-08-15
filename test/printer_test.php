<?php
namespace test\printer;

require("../lib/printer.php");

use PHPUnit\Framework\TestCase;
use printer;

class printer_testcase extends TestCase {
    public function test_pad_left_and_right_with_spaces(){
        $this->assertEquals("   Hallo   ",
                           printer\pad_left_and_right("Hallo", 3));
        $this->assertEquals("  Test  ",
                           printer\pad_left_and_right("Test", 2));
    }


    public function test_insecure_text(){
        $this->assertEquals("Ich wollte sagen:     Hallo     wenn es dir recht ist.\n",
                            printer\insecure_text("Hallo", 5));
    }

    public function test_create_new_file_from_old_file(){
        $this->assertEquals(true,
                            printer\create_new_file_from_old_file("../bin/print", ".txt", ".text", "_insecure"));
    }

    public function test_array_of_lines_from_text_file(){
        $this->assertEquals("was ich",
                            printer\array_of_lines_from_file("/source/insecure_printer/bin/print",
                            ".txt", 2));
    }

    public function test_count_lines_of_file(){
        $this->assertEquals(4, printer\count_lines_of_file("../bin/print", ".txt"));
    }

    //public function test_print_lines(){
    //    $this->assertEquals("Hallo\nich weiss\nwas ich\nmache\n", printer\print_lines("../bin/print", ".txt"));
    //}

    //public function test_overwrite_file_content(){
    //    $this->assertEquals("Ich wollte sagen:     Hallo     wenn es dir recht ist.",
    //                        printer\overwrite_file_content("/source/insecure_printer/bin/print", ".txt", "Hallo", 5, 4));
    //}
}
