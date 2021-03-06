<?php
namespace shapes;

class Figure{
    public $shape;
    public $size;
    public $filler;
    public function __construct($shape = "square", $size = 3, $filler = "#"){
        $this->shape = $shape;
        $this->size = $size;
        $this->filler = $filler;
        if($size > 50){
            throw new \InvalidArgumentException("Size is not allowed to be higher than 50\n");
        }
        if(!is_numeric($size)){
            throw new \InvalidArgumentException("Size has to be a number\n");
        }
        if($size <= 0){
            throw new \InvalidArgumentException("Size is too small\n");
        }
        if(is_numeric($shape)){
            throw new \InvalidArgumentException("Shape has to be a word\n");
        }
        /*switch($shape){
            case "square":
            case "triangle":
            case "rotated square":
            case "arrow":
                break;
            default:
                throw new \InvalidArgumentException("Shape has to be either: triangle, arrow, square or rotated square\n");
                break;
        }*/
    }
}

function whitespace_left_and_right($word, $number_of_whitespaces){
    $whitespace_string = str_repeat(" ", $number_of_whitespaces);
    return $whitespace_string . $word . $whitespace_string;
}

function filler_length($value, $filler){
    $filler_string = str_repeat($filler, $value);
        return $filler_string;
}

function whitespace_string($value){
    $whitespace_string = str_repeat(" ", $value);
    return $whitespace_string;
}

function build_square($value, $filler, $i = 0){
    $square_text = "";
    while($i < $value){
        $square_text .= filler_length($value, $filler) . "\n";
        $i++;
    }
    return $square_text;
}

function build_arrow($value, $filler, $i = 0){
    $arrow_text = "";
    while ($i < $value){
        $i++;
        $arrow_text .= filler_length($i, $filler) . "\n";
    }
    while($i - 1 > 0){
        $i--;
        $arrow_text .= filler_length($i, $filler) . "\n";
    }
    return $arrow_text;
}

function build_rotated_square($value, $filler, $i = 0){
    $rotated_square_text = "";
    while ($i < $value){
        $i++;
        $rotated_square_text .= whitespace_string($value - $i) . filler_length($i, $filler);
        $i--;
        $rotated_square_text .= filler_length ($i, $filler) . "\n";
        $i++;
    }
    while ($i - 1 > 0){
        --$i;
        $rotated_square_text .= whitespace_string($value - $i) . filler_length($i, $filler);
        $i--;
        $rotated_square_text .= filler_length ($i, $filler) . "\n";
        $i++;
    }
    return $rotated_square_text;
}

function build_triangle($value, $filler, $i = 0){
    $triangle_text = "";
    while ($i < $value){
        $i++;
        $triangle_text .= whitespace_string($value - $i) . filler_length($i, $filler);
        $i--;
        $triangle_text .= filler_length ($i, $filler) . "\n";
        $i++;
    }
    return $triangle_text;
}

function categorize_options_from_cli($options){
    if ($options == "help"){
        open_help($options);
        return "help";
    }elseif(is_array($options) && count($options) == 4){
        $array = $options;
        return $array;
    }elseif($options == false || is_array($options)){
        if(is_array($options) && count($options != 4)){
            return false;
        }
        return false;
    }else{
        echo ($options);
        return $options;
    }
}

function open_help($options = null){
    if (isset($options) == "help"){
        echo "\n";
        echo "set of options:\n\n";
        echo "draw shape with direct input:\n\n";
        echo "--shape" . whitespace_left_and_right(" ", 2) .
             "draw shape with a character if it is available\n" . whitespace_left_and_right("", 6) .
             "available shapes are: square, arrow, rotated square, triangle\n\n";
        echo "--size" . whitespace_left_and_right("", 3) .
             "change the size of the build shape\n" .
             "max size = 50\n\n";
        echo "--filler" . whitespace_left_and_right("", 2) .
             "set character to draw the shape(default: '#')\n\n\n";
        echo "draw shape with input in CLI:\n\n";
        echo "-i" . whitespace_left_and_right("", 5) .
             "activate interactive mode to insert the values for the shape\n\n";
        return true;
    }else{
        return false;
    }
}

function read_shape_with_interactive_mode(){
    $query_shape = readline("Bitte geben Sie eine Form ein:\n");
    readline_add_history($query_shape);
    return $query_shape;
}

function message_to_shape_choice($shape){
    if ($shape !== false){
        echo "\n";
        echo "Sie haben '$shape' gewählt.\n";
        echo "\n";
        return $shape;
    }else{
        return false;
    }
}

function set_size_with_interactive_mode(){
    $query_size = readline("Bitte geben Sie eine Größe ein:\n");
    readline_add_history($query_size);
    return $query_size;
}

function set_filler_with_interactive_mode(){
    $query_filler = readline("Möchten Sie die Füllung umstellen? (default = #) (y/n):\n");
    readline_add_history($query_filler);
    $query_filler = strtolower($query_filler);
    if($query_filler == "ja" || $query_filler == "yes" || $query_filler == "y"){
        $filler = readline("Bitte geben Sie den gewünschten Charakter ein:\n");
        readline_add_history($filler);
        if(strlen($filler) == 1){
            return $filler;
        }else{
            echo "Der gewünschte Charakter wurde nicht erkannt. Der Default-Wert wird benutzt.\n";
            return "#";
        }
    }else{
        echo "Der Default-Wert wird benutzt.\n";
        return "#";
    }
}

function draw_shape_with_input_from_commandline($figure){
    switch ($figure->shape) {
        case 'square':
            $square = build_square($figure->size, $figure->filler);
            echo $square;
            return $square;
            break;

        case 'arrow':
            $arrow = build_arrow($figure->size, $figure->filler);
            echo $arrow;
            return $arrow;
            break;

        case 'rotated square':
            $rotated_square = build_rotated_square($figure->size, $figure->filler);
            echo $rotated_square;
            return $rotated_square;
            break;

        case 'triangle':
            $triangle = build_triangle($figure->size, $figure->filler);
            echo $triangle;
            return $triangle;
            break;

        default:
            message_to_shape_choice(false);
            return false;
            break;
    }
}
