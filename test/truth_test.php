<?php
namespace truth_test;

use PHPUnit\Framework\TestCase;

class truth_testcase extend TestCase{
    public function test_truth(){
        $this->assertEquals(true, true);
    }
}
