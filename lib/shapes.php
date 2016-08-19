<?php
namespace shapes;

function pad_left_and_right($word, $number_of_whitespaces){
    $whitespace_string = str_repeat(" ", $number_of_whitespaces);

    return $whitespace_string . $word . $whitespace_string;
}

function hash_length($value){
    $hash_string = str_repeat("#", $value);
        return $hash_string;
}

function whitespace_string($value){
    $whitespace_string = str_repeat(" ", $value);
    return $whitespace_string;
}

function build_square($value, $i = 0){
    while($i < $value){
        $square_text .= hash_length($value) . "\n";
        $i++;
    }
    return $square_text;
}

function build_arrow($value, $i = 0){
    while ($i < $value){
        $i++;
        $arrow_text .= hash_length($i) . "\n";
    }
    while($i - 1 > 0){
        $i--;
        $arrow_text .= hash_length($i) . "\n";
    }
    return $arrow_text;
}

function build_rotated_square($value, $i = 0){
    while ($i < $value){
        $i++;
        $rotated_square_text .= whitespace_string($value - $i) . hash_length($i);
        $i--;
        $rotated_square_text .= hash_length ($i) . "\n";
        $i++;
    }
    while ($i - 1 > 0){
        --$i;
        $rotated_square_text .= whitespace_string($value - $i) . hash_length($i);
        $i--;
        $rotated_square_text .= hash_length ($i) . "\n";
        $i++;
    }
    return $rotated_square_text;
}

function categorize_options_from_cli($options){
    if ($options == "help"){
        open_help($options);
        return "help";
    }elseif(is_array($options) && count($options) == 3){
        $array = $options;
        return $array;
    }elseif($options == false || count($options) == 2){
        return false;
    }else{
        $string = $options;
        echo $string;
        return $string;
    }
}

function open_help($options = null){
    if (isset($options) == "help"){
        echo "\n";
        echo "--shape" . pad_left_and_right(" ", 2) .
             "draw shape with hashes if it is available\n" . pad_left_and_right("", 6) .
             "available shapes are: square, arrow, rotated square\n\n";
        echo "--size" . pad_left_and_right("", 3) .
             "change the size of the build shape\n\n";
        echo "-i" . pad_left_and_right("", 5) .
             "activate interactive mode to insert the values for the shape\n\n";
        return true;
    }else{
        return false;
    }
}

function read_shape_with_interactive_mode(){
        $query_shape = readline("Bitte geben Sie eine Form ein.\n");
        readline_add_history($query_shape);
        switch ($query_shape){
            case 'square':
            case 'arrow':
            case 'rotated square':
            return message_to_shape_choice($query_shape);
            break;

            default:
            return false;
        }
}

function set_size_with_interactive_mode(){
        $query_size = readline("Bitte geben Sie eine Größe ein.\n");
        readline_add_history($query_size);
        if (is_numeric($query_size) == true){
            echo "\n";
            echo "Die gewählte Größe lautet: " . $query_size . "\n";
            echo "\n";
            return $query_size;
        }else{
            return false;
        }
}

function draw_shape_with_input_from_commandline($shape, $size){
    switch ($shape) {
        case 'square':
            $square = build_square($size);
            echo $square;
            return $square;
            break;

        case 'arrow':
            $arrow = build_arrow($size);
            echo $arrow;
            return $arrow;
            break;

        case 'rotated square':
            $rotated_square = build_rotated_square($size);
            echo $rotated_square;
            return $rotated_square;
            break;

        default:
            message_to_shape_choice(false);
            return false;
            break;
    }
}

function message_to_shape_choice($shape){
    if ($shape !== false){
        echo "\n";
        echo "Sie haben '$shape' gewählt.\n";
        echo "\n";
        return $shape;
    }else{
        echo "Die gewünschte geometrische Form kann nicht gebaut werden.\n" .
             "Für weitere Informationen geben Sie 'php print_shape.php -h' ein.\n\n";
        return false;
    }
}
