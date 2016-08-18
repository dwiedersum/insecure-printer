<?php
namespace shapes;

function build_square($value, $i = 0){
    while($i < $value){
        $square_text .= hash_length($value);
        $i++;
    }
    return $square_text;
}

function hash_length($value){
    $hash_string = str_repeat("#", $value);
    if ($value !== 0){
        return $hash_string . "\n";
    }
}

function build_arrow($value, $i = 0){
    while ($i < $value){
        $i++;
        $arrow_text .= hash_length($i);
    }
    while($i !== 0){
        --$i;
        $arrow_text .= hash_length($i);
    }
    return $arrow_text;
}
