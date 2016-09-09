<?php

require("../lib/shape_array.php");
require("../lib/CLI.php");
require("../lib/shapes.php");

use shapes\Figure;
use shape_array as sa;
use shape_array\BigFigure;

$options = CLI\check_options_from_commandline("big_figure.php");
$options = sa\categorize_options_from_cli($options);
if(is_array($options)){
    if(isset($options["size"])){
        $size = sa\check_if_size_is_valid($options["size"]);
    }else{
        $size = 3;
    }
    try{
        $filler = new Figure($options["filler"], $size, "#");
        $figure = new BigFigure($options["shape"], $options["repeat"], $filler, $size);
    }catch(\Exception $e){
        echo $e->getMessage();
        die();
    }
    echo sa\draw_big_shape($figure);
}elseif(is_string($options)){
    $figure_array = sa\read_options_from_input();
    $size = sa\check_if_size_is_valid($figure_array["size"]);
    try{
        $filler = new Figure($figure_array["filler"], $size, "#");
        $figure = new BigFigure($figure_array["shape"], $figure_array["repeat"], $filler, $size);
    }catch(\Exception $e){
        echo $e->getMessage();
        die();
    }
    $filler = new Figure($figure_array["filler"], $size, "#");
    echo sa\draw_big_shape($figure);
}
