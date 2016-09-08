<?php
namespace shape_array;

function shape_array($figure){
    switch ($figure->shape){
        case 'square':
        return square_array($figure);
        break;

        case 'triangle':
        return triangle_array($figure);
        break;

        default:
        echo "Ich kann diese Form nicht finden\n";
        break;
    }
}

function square_array($figure){
    $array = array_fill(0, $figure->size, 1);
    $array_of_arrays = array_fill(0, $figure->size, $array);
    return $array_of_arrays;
}

function triangle_array($figure){
    $triangle_array = array();
    $array_of_array = array();
    for($i = 0; $i < $figure->size; $i++){
        for($j = 0; $j < $figure->size; $j++){
            if($j <= $i){
                $triangle_array[] = 1;
            }else{
                $triangle_array[] = 0;
            }
        }
        $array_of_array[] = $triangle_array;
        $triangle_array = array();
    }
    return $array_of_array;
}

function big_shape_array($big_figure){
    $small_figure = shape_array($big_figure->filler);
    $line_number = $big_figure->repeat * $big_figure->filler->size + $big_figure->repeat - 1;
    $big_figure_array = array();
    $line = array();
    $line_chunk = array();
    $special_line = array_fill(0, $line_number, 0);
    for($i = 0; $i < $big_figure->repeat; $i++){
        $line = array_merge($line, $small_figure[0]);
        if($i +1 < $big_figure->repeat){
            $line[] = 0;
        }
    }
    for($i = 0; $i < $big_figure->filler->size; $i++){
        $line_chunk[] = $line;
    }
    for($i = 0; $i < $big_figure->repeat; $i++){
        $big_figure_array = array_merge($big_figure_array, $line_chunk);
        if($i +1 < $big_figure->repeat){
            $big_figure_array[] = $special_line;
        }
    }
    return $big_figure_array;
}
