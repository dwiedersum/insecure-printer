<?php

require("../lib/shapes.php");

use shapes as sh;

$value = $argv[1];
$rotated_square = sh\build_rotated_square($value);
echo $rotated_square;
