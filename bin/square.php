<?php

require("../lib/shapes.php");

use shapes as sh;

$value = $argv[1];
$square = sh\build_square($value);
echo $square;
