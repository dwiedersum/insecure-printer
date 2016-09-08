<?php
namespace shape_array;

function shape_array($figure){
    $array = array_fill(0, $figure->size, 1);
    $array_of_arrays = array_fill(0, $figure->size, $array);
    return $array_of_arrays;
}

function big_shape_array($big_figure){
    $small_figure = shape_array($big_figure->filler);
    $line_number = $big_figure->repeat * 2;
    $big_figure_array = array();
    $line = array();
    for($i = 0; $i < $big_figure->repeat; $i++){
        $line = array_merge($line, $small_figure[0]);
    }
    for($i = 0; $i < $line_number; $i++){
        $big_figure_array[$i] = $line;
    }
    return $big_figure_array;
}
