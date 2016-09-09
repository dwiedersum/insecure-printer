<?php

require("../lib/shape_array.php");
require("../lib/CLI.php");

use shape_array as sa;
use shape_array\BigFigure;

$options = CLI\check_options_from_commandline("big_figure.php");
$options = sa\categorize_options_from_cli($options);
if(is_array($figure_options)){
    if(isset($options["size"])){
        $size = check_if_size_is_valid($options["size"]);
    }else{
        $size = 3;
    }
    try{
        $figure = new BigFigure($options["shape"], $options["repeat"], $options["filler"], $size);
    }catch(\Exception $e){
        echo $e->getMessage();
        die();
    }
    echo sa\draw_big_shape($figure);
}else{
    $figure_array = read_options_from_input();
    $size = check_if_size_is_valid($option["size"]);
    try{
        $figure = new BigFigure($figure_array["shape"], $figure_array["repeat"], $figure_array["filler"], $size);
    }catch(\Exception $e){
        echo $e->getMessage();
        die();
    }
    echo sa\draw_big_shape($figure);
}
