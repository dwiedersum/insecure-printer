<?php
namespace truth_test;

use PHPUnit\Framework\TestCase;

class truth_testcase extends TestCase{
    public function test_truth(){
        $this->assertEquals(true, true);
    }
}
