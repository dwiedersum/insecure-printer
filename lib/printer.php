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
    $option = getopt("i:h");
    if(isset($option[h])){
        echo "\n";
        echo "-i 'filename'     activate interactive shell to create file with new extension and insecure printed content\n";
        echo "\n";
        return false;

    }elseif(empty($option[i])){
        echo "\n";
        echo "Die Eingabe wurde nicht erkannt.\n";
        echo "Bitte geben Sie 'php insecure_printer.php -h' ein, um die Hilfe zu öffnen.\n";
        echo "\n";
        return false;

    }elseif(strpos($option[i], ".") == false){
        echo "\n";
        echo "Bitte geben Sie den vollständigen Namen der Datei an.\n";
        echo "\n";
        return false;

    }elseif(file_exists($filedirectory . $option[i]) == true && !empty($option[i])){
        $filename_array = explode(".", $option[i]);
        return $filename_array;

    }else{
        echo "\n";
        echo "Datei konnte nicht gefunden werden.\n";
        echo "\n";
        return false;

    }
}

function extension_length($extension){
    return strlen($extension);
}

function extension_query(){
    echo "\n";
    $extension = readline("Unter welcher Extension soll die Datei gespeichert werden?\n");
    readline_add_history($extension);
    if (extension_length($extension) == 0){
        echo "\n";
        echo "Es wurde keine Eingabe erkannt.\n";
        echo "\n";
        return false;
    }elseif (extension_length($extension) >= 5){
        echo "\n";
        echo "Die Eingabe ist ungültig. Bitte geben Sie eine Extension ein, die nicht mehr als 5 Zeichen besitzt.\n";
        echo "\n";
        return false;
    }elseif ($extension[0] == "."){
        echo "\n";
        echo "Die Datei wurde erstellt.\n";
        echo "\n";
        return $extension;
    }else{
        $extension = "." . $extension;
        echo "\n";
        echo "Die Datei wurde erstellt.\n";
        echo "\n";
        return $extension;
    }
}

function array_of_lines_from_file($filedirectory, $key = ''){
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
