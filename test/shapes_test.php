<?php
namespace test\shapes;

require("../lib/shapes.php");

use PHPUnit\Framework\TestCase;
use shapes;

class shapes_testcase extends TestCase {

    public function test_square_build(){
        $this->assertEquals("###\n###\n###\n", shapes\build_square(3));
    }

}
