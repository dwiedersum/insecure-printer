<?php

require("../lib/shapes.php");

use shapes as sh;

$value = $argv[1];
$arrow = sh\build_arrow($value);
echo $arrow;
