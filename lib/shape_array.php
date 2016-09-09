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

function create_chunk_with_seperator($element, $repeat, $seperator){
    $chunk = array();
    for($i = 0; $i < $repeat; $i++){
        $chunk = array_merge($chunk, $element);
        if($i + 1 < $repeat){
            $chunk[] = $seperator;
        }
    }
    return $chunk;
}

function build_line_chunk($big_figure){
    $small_figure = shape_array($big_figure->filler);
    $line_chunk = array();
    foreach($small_figure as $figure_line){
        $line = create_chunk_with_seperator($figure_line, $big_figure->repeat, 0);
        $line_chunk[] = $line;
    }
    return $line_chunk;
}

function big_shape_array($big_figure){
    $line_chunk = build_line_chunk($big_figure);
    $line_number = $big_figure->repeat * $big_figure->filler->size + $big_figure->repeat - 1;
    $special_line = array_fill(0, $line_number, 0);
    return create_chunk_with_seperator($line_chunk, $big_figure->repeat, $special_line);
}
