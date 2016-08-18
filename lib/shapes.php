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

function read_shape_and_size(){
    $options = array("shape:", "size:");
    $shape_and_size = getopt("h", $options);
    return $shape_and_size;
}

function open_help($options = ""){
    if (!empty($options)){
        echo "\n";
        echo "--shape" . pad_left_and_right(" ", 2) .
             "draw shape with hashes if it is available\n" . pad_left_and_right("", 6) .
             "available shapes are: square, arrow, rotated square\n\n" .
             "--size" . pad_left_and_right("", 3) .
             "change the size of the build shape\n\n";
        return true;
    }
}


function draw_shape_with_input_from_commandline($shape, $size){
    switch ($shape) {
        case 'square':
            $square = build_square($size);
            return $square;
            break;

        case 'arrow':
            $arrow = build_arrow($size);
            return $arrow;
            break;

        case 'rotated square':
            $rotated_square = build_rotated_square($size);
            return $rotated_square;
            break;

        default:
            return "\nDie gewünsche geometrische Form kann nicht gebaut werden.\n" .
                   "Für weitere Informationen geben Sie 'php print_shape.php -h' ein.\n\n";
            break;
    }
}
