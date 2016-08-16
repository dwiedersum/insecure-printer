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
        $this->assertEquals("Ich wollte sagen:     Hallo     wenn es dir recht ist.\n",
                                                printer\insecure_text("Hallo"));
    }

    public function test_file_extension(){
        $this->assertEquals(".txt",
                            printer\file_extension("C:/Projektordner/insecure_printer/bin/print.txt"));
    }

    public function test_array_of_lines_from_text_file(){
        $this->assertEquals("was ich",
                            printer\array_of_lines_from_file("/source/insecure_printer/bin/print.txt",
                            ".txt", 0)[2]);
    }

    public function test_overwrite_file_content(){
        $this->assertEquals("Ich wollte sagen:     Hallo     wenn es dir recht ist.\n",
                            printer\overwrite_file_content("/source/insecure_printer/bin/print", ".txt", "Hallo", 5, 4));
    }
}
