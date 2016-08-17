<?php
namespace printer;

function pad_left_and_right($word, $number_of_whitespaces){
    $whitespace_string = str_repeat(" ", $number_of_whitespaces);

    return $whitespace_string . $word . $whitespace_string;
}

function insecure_text($word, $number_of_whitespaces = 5){
    $insecure_string = "Ich wollte sagen:" . pad_left_and_right($word, $number_of_whitespaces) .
                       "wenn es dir recht ist.\n";

    return $insecure_string;
}

function file_extension($filedirectory){
    $fileextension = pathinfo($filedirectory, PATHINFO_EXTENSION);
    $fileextension = "." . $fileextension;
    return $fileextension;
}

function input_of_filename_via_interactive_shell($filedirectory){
    $full_filename = getopt("i:");
    $filepath = pathinfo($filedirectory, PATHINFO_DIRNAME) . "/";
    if(file_exists($filepath . $full_filename[i]) == true){
        $filename_array = explode(".", $full_filename[i]);
        $filename = $filename_array[0];
        return $filename;
    }else{
        echo "Datei konnte nicht gefunden werden.\n";
        return false;
    }
}

function extension_query(){
    $extension = readline("Unter welcher Extension soll die Datei gespeichert werden?\n");
    readline_add_history($extension);
    if (strlen($extension) == 0){
        echo "Es wurde keine Eingabe erkannt.\n";
        return false;
    }elseif (strlen($extension) >= 5){
        echo "Die Eingabe ist ungültig.\n";
        return false;
    }elseif ($extension[0] == "."){
        return $extension;
    }else{
        $extension = "." . $extension;
        return $extension;
    }

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
