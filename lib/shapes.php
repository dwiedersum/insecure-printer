<?php
namespace shapes;

function build_square($value, $i = 0){
    while($i < $value){
        $square_text .= square_length($value);
        $i++;
    }
    return $square_text;
}

function square_length($value){
    $hash_string = str_repeat("#", $value);
    return $hash_string . "\n";
}
