<?php
namespace shape_array;

class BigFigure{
    public $shape;
    public $size;
    public $filler;
    public function __construct($shape = "square", $repeat = 3, $filler = "square", $size = 3){
        $this->shape = $shape;
        $this->repeat = $repeat;
        $this->filler = $filler;
        $this->size = $size;
        if($repeat > 10){
            throw new \InvalidArgumentException("Size is not allowed to be higher than 10\n");
        }
        if(!is_numeric($repeat)){
            throw new \InvalidArgumentException("Size has to be a number\n");
        }
        if($repeat <= 0){
            throw new \InvalidArgumentException("Size is too small\n");
        }
        if(is_numeric($shape)){
            throw new \InvalidArgumentException("Shape has to be a word\n");
        }
        switch($shape){
            case "square":
            case "triangle":
            case "rotated square":
            case "arrow":
                break;
            default:
                throw new \InvalidArgumentException("Shape has to be either: triangle, arrow, square or rotated square\n");
                break;
        }
        /*switch($filler){
            case "square":
            case "triangle":
            case "rotated square":
            case "arrow":
                break;
            default:
                throw new \InvalidArgumentException("Filler has to be either: triangle, arrow, square or rotated square\n");
                break;
        }*/
    }
}

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

function draw_big_shape($big_figure){
    $big_shape_array = big_shape_array($big_figure);
    $shape_text = "";
    foreach($big_shape_array as $line){
        foreach($line as $numbers){
            if($numbers == 0){
                $shape_text .= " ";
            }else{
                $shape_text .= "#";
            }
        }
        $shape_text .= "\n";
    }
    return $shape_text;
}
