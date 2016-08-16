<?php
namespace printer;

function pad_left_and_right($word, $number_of_whitespaces){
    $whitespace_string = str_repeat(" ", $number_of_whitespaces);

    return $whitespace_string . $word . $whitespace_string;
}

function insecure_text($word, $number_of_whitespaces = 5){
    $insecure_string = "Ich wollte sagen:" . pad_left_and_right($word, $number_of_whitespaces) . "wenn es dir recht ist.\n";

    return $insecure_string;
}

function file_extension($filedirectory){
    $fileextension = pathinfo($filedirectory, PATHINFO_EXTENSION);
    $fileextension = "." . $fileextension;
    return $fileextension;
}

function array_of_lines_from_file($filedirectory, $key = ''){
    $line_array = file($filedirectory, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return $line_array;
}

function overwrite_file_content($filedirectory, $fileextension, $word){
    $textcontent = fopen($filedirectory . $fileextension, 'a+');
    $text = insecure_text($word);
    fwrite($textcontent, $text);
    fclose($textcontent);
        return $text;
}
