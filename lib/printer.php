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

function input_of_filename_output($output){
    echo "\n";
    echo $output . "\n";
    echo "\n";
}

function input_of_filename_operation($filename){
    if(empty($filename)){
        return "Die Eingabe wurde nicht erkannt.\n" .
               "Bitte geben Sie 'php insecure_printer.php -h' ein, um die Hilfe zu öffnen.";
    }elseif(strpos($filename, ".") == false){
        return "Bitte geben Sie den vollständigen Namen der Datei an.";
    }else{
        return "Datei konnte nicht gefunden werden.";
    }
}

function input_of_filename_via_interactive_shell(){
    $option = getopt("i:h");
    if(isset($option[h])){
        echo "\n";
        echo "-i 'filename'" . pad_left_and_right(" ", 2) .
             "activate interactive shell to create file with new extension and insecure printed content\n\n";
        return false;
    }elseif(file_exists($option[i]) == true && !empty($option[i]) && strpos($option[i], ".") !== false){
        $filename_array = explode(".", $option[i]);
        return $filename_array;
    }else{
        input_of_filename_output(input_of_filename_operation($option[i]));
        return false;
    }
}

function extension_length($extension){
    return strlen($extension);
}

function extension_query_input(){
    echo "\n";
    $query_input = readline("Unter welcher Extension soll die Datei gespeichert werden?\n");
    readline_add_history($query_input);
    return $query_input;
}

function extension_query_output($output){
    echo "\n";
    echo $output . "\n";
    echo "\n";
}

function extension_query_operation($input){
    if (extension_length($input) == 0){
        return "Es wurde keine Eingabe erkannt.";
    }elseif (extension_length($input) >= 5){
        return "Die Eingabe ist ungültig. Bitte geben Sie eine Extension ein, die nicht mehr als 5 Zeichen besitzt.";
    }else{
        return "Die Datei wurde erstellt.";
}
}

function extension_query(){
    $extension = extension_query_input();
    if (extension_length($extension) == 0){
        extension_query_output(extension_query_operation($extension));
        return false;
    }elseif (extension_length($extension) >= 6){
        extension_query_output(extension_query_operation($extension));
        return false;
    }elseif ($extension[0] == "."){
        extension_query_output(extension_query_operation($extension));
        return $extension;
    }else{
        $extension = "." . $extension;
        extension_query_output(extension_query_operation($extension));
        return $extension;
    }
}

function array_of_lines_from_file($filedirectory){
    $line_array = file($filedirectory, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return $line_array;
}

function overwrite_file_content($filedirectory, $fileextension, $word, $writerights = 'a+'){
    $textcontent = fopen($filedirectory . $fileextension, $writerights);
    $text = insecure_text($word);
    fwrite($textcontent, $text);
    fclose($textcontent);
        return $text;
}
