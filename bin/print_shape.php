<?php

require("../lib/shapes.php");
require_once("../lib/CLI.php");

use shapes as sh;
use shapes\Figure;

$options = cli\check_options_from_commandline("print_shape.php");
$shape_and_size = sh\categorize_options_from_cli($options);
if (is_array($options)){
    $shape = $options["shape"];
    $size = floor($options["size"]);
    $filler = $options["filler"];
    $figure = new Figure ($shape, $size, $filler);
    if (is_numeric($figure->size) == true){
        sh\draw_shape_with_input_from_commandline($figure);
    }else{
        echo sh\message_to_shape_choice(false);
    }
}elseif(is_string($options) == true && $options !== "help"){
    $shape = sh\read_shape_with_interactive_mode();
    $size = sh\set_size_with_interactive_mode();
    $filler = sh\set_filler_with_interactive_mode();
    try{
        $figure = new Figure($shape, $size, $filler);
    }catch(\Exception $e){
        echo $e->getMessage();
        die();
    }
    sh\draw_shape_with_input_from_commandline($figure);
}
