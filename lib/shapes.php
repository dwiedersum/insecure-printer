<?php
namespace shapes;

function build_square($value, $i = 0){
    while($i < $value){
        $square_text .= hash_length($value) . "\n";
        $i++;
    }
    return $square_text;
}

function hash_length($value){
    $hash_string = str_repeat("#", $value);
        return $hash_string;
}

function whitespace_string($value){
    $whitespace_string = str_repeat(" ", $value);
    return $whitespace_string;
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
