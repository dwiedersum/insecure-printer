<?php
namespace printer;

require("../lib/CLI.php");

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
    if (file_exists($filename) == true && isset($filename) == true && strpos($filename, ".") !== false){
        $filename_array = explode(".", $filename);
        $file_array = array("message" => "Interactive Mode:Activated", "filename" => $filename_array[0], "fileextension" => "." . $filename_array[1]);
        return $file_array;
    }elseif(strpos($filename, ".") == false){
        return "Bitte geben Sie den vollständigen Namen der Datei an.\n";
    }else{
        return "Datei konnte nicht gefunden werden.\n";
    }
}

function input_of_filename_via_interactive_shell($options){
    if ($options == false){
        echo "Die Eingabe wurde nicht erkannt.\n" .
             "Bitte geben Sie 'php insecure_printer.php -h' ein, um die Hilfe zu öffnen.\n";
        return false;
    }
    if ($options == "help"){
        echo "\n";
        echo "-i 'filename'" . pad_left_and_right(" ", 2) .
             "activate interactive shell to create file with new extension and insecure printed content\n\n";
        return false;
    }else{
        if(is_array($options)){
            if (array_key_exists("shape", $options)){
                echo $options["message"];
                return false;
            }
            if (array_key_exists("filename", $options)){
                $checked_file = input_of_filename_operation($options["filename"]);
                if (is_array($checked_file) == true){
                    echo $options["message"];
                    return $checked_file;
                }else{
                    echo $checked_file;
                    return false;
                }
            }
        }
    }
}

function extension_length($extension){
    return strlen($extension);
}

function read_extension_from_commandline(){
    echo "\n";
    $query_input = readline("Unter welcher Extension soll die Datei gespeichert werden?\n");
    readline_add_history($query_input);
    return $query_input;
}

function print_response($output){
    echo "\n";
    echo $output . "\n";
    echo "\n";
}

function response_to_extension($input){
    if (extension_length($input) == 0){
        $response = array("messages" => "Es wurde keine Eingabe erkannt.", "right_fileextension" => false);
        return $response;
    }elseif (extension_length($input) >= 5){
        $response = array("messages" => "Die Eingabe ist ungültig. Bitte geben Sie eine Extension ein, die nicht mehr als 5 Zeichen besitzt.", "right_fileextension" => false);
        return $response;
    }else{
        $response = array("messages" => "Die Datei wurde erstellt.", "right_fileextension" => add_dot_extension($input));
        return $response;
    }
}

function add_dot_extension($extension){
    if ($extension[0] == "."){
        return $extension;
    }else{
        return "." . $extension;
    }
}

function extension_query(){
    $extension = read_extension_from_commandline();
    $response = response_to_extension($extension);
    print_response($response["messages"]);
    return $response["right_fileextension"];
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
