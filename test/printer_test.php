<?php
namespace test\printer;

require("../lib/printer.php");

use PHPUnit\Framework\TestCase;
use printer;

class printer_testcase extends TestCase {
    public function test_pad_left_and_right_with_spaces(){
        $this->assertEquals("   Hallo   "),
                           printer\pad_left_and_right("Hallo", 3));
        $this->assertEquals("  Test  "),
                           printer\pad_left_and_right("Test", 2));
    }
}
