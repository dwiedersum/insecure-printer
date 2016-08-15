<?php
namespace printer;

function pad_left_and_right($word, $number_of_whitespaces){
    $whitespace_string = str_repeat(" ", $number_of_whitespaces);

    return $whitespace_string . $word . $whitespace_string;
}

function insecure_text($word, $number_of_whitespaces){
    $insecure_string = "Ich wollte sagen:" . pad_left_and_right($word, $number_of_whitespaces) . "wenn es dir recht ist.\n";

    return $insecure_string;
}

function create_new_file_from_old_file($old_directory, $old_extension, $new_extension, $added_name){
    $new_directory = $old_directory.$added_name;
    copy($old_directory . $old_extension, $new_directory . $new_extension);
    if (!copy($old_directory . $old_extension, $new_directory . $new_extension)){
        $text = false;
    }else{
        $text = true;
    }

    return $text;
}

function array_of_lines_from_file($filedirectory, $fileextension){
    $textcontent = fopen($filedirectory . $fileextension, 'r');
    while(!feof($textcontent)){
        $line_array[] = trim(fgets($textcontent));
    }
    $line_array = array_filter($line_array);
    fclose($textcontent);

    return $line_array;
}

function overwrite_file_content($filedirectory, $fileextension, $word, $number_of_whitespaces){
    $textcontent = fopen($filedirectory . $fileextension, 'a+');
    $text = insecure_text($word, $number_of_whitespaces);
    fwrite($textcontent, $text);
    fclose($textcontent);
        return $text;
}
