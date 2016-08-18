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
    }

}
