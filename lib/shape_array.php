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

function pad_left_and_right($word, $number_of_whitespaces){
    $whitespace_string = str_repeat(" ", $number_of_whitespaces);

    return $whitespace_string . $word . $whitespace_string;
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

function categorize_options_from_cli($options){
    if($options == "help"){
        $help = help_message();
    }elseif(is_array($options)){
            return $options;
    }else{
        echo $options;
        return $options;
    }
}

function help_message(){
    echo "\n";
    echo "set of options:\n\n";
    echo "draw shape with direct input:\n\n";
    echo "--shape" . pad_left_and_right(" ", 2) .
         "draw a big shape with a filler if it is available\n" . pad_left_and_right("", 6) .
         "available fillers and shapes are: square, arrow, rotated square, triangle\n\n";
    echo "--repeat" . pad_left_and_right("", 2) .
         "change the size of the build shape\n" .
         pad_left_and_right("", 6) . "max size = 10\n\n";
    echo "--filler" . pad_left_and_right("", 2) .
         "set small shape as filler to draw the big shape(default: 'square')\n\n";
    echo "--size" . pad_left_and_right("", 3) .
         "optional -> set size of the fillers\n" .
         pad_left_and_right("", 6) . "max size = 5\n\n\n";
    echo "draw shape with input in CLI:\n\n";
    echo "-i" . pad_left_and_right("", 5) .
         "activate interactive mode to insert the values for the shape\n\n";
}

function check_if_size_is_valid($size){
    if(!is_numeric($size)){
        echo "'size' muss eine Zahl sein\n" .
             "der Default-Wert für size wird verwendet.(3)\n";
        return 3;
    }elseif($size <= 0){
        echo "'size' ist zu klein\n" .
             "der Default-Wert für size wird verwendet.(3)\n";
        return 3;
    }elseif($size > 5){
        echo "'size' darf nicht größer als 5 sein\n" .
             "der Default-Wert für size wird verwendet.(3)\n";
        return 3;
    }else{
        return $size;
    }
}

function read_options_from_input(){
    $shape = read_shape();
    $repeat = read_repeat();
    $filler = read_filler();
    $size = read_size();
    $figure_array = array("shape" => $shape, "repeat" => $repeat, "filler" => $filler, "size" => $size);
    return $figure_array;
}

function read_shape(){
    $shape = readline("Bitte wählen Sie eine Form für Ihre Figur.\n");
    readline_add_history($shape);
    $shape = strtolower($shape);
    return $shape;
}

function read_repeat(){
    $repeat = readline("Wie groß soll Ihre Form sein? (max = 10)\n");
    readline_add_history($repeat);
    return $repeat;
}

function read_filler(){
    $filler = readline("Welche Filler möchten Sie benutzen?\n");
    readline_add_history($filler);
    $filler = strtolower($filler);
    return $filler;
}

function read_size(){
    $check = readline("Möchten Sie die Größe der Filler anpassen? (y/n)\n");
    readline_add_history($check);
    if($check == "y" || $check == "yes" || $check == "ja"){
        $size = readline("Welche Größe sollen Ihre Filler haben?\n");
        readline_add_history($size);
        return $size;
    }
    echo "Der Default-Wert '3' wird verwendet.\n";
    $size = 3;
    return $size;
}
