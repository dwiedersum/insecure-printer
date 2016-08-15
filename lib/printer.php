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

function print_line_of_file($filedirectory, $fileextension, $linenumber){
    $textcontent = fopen($filedirectory . $fileextension, 'r');
    while(!feof($textcontent)){
        $lines[] = trim(fgets($textcontent));
    }
    fclose($textcontent);

    return $lines[$linenumber];
}

function implode_array_of_lines_of_file($filedirectory, $fileextension){
    $textcontent = fopen($filedirectory . $fileextension, 'r');
    while(!feof($textcontent)){
        $lines[] = fgets($textcontent);
    }
    $text = implode("", $lines);
    fclose($textcontent);

    return $text;
}

function count_lines_of_file($filedirectory, $fileextension){
    $textcontent = fopen($filedirectory . $fileextension, 'r');
    while(!feof($textcontent)){
        $lines[] = fgets($textcontent);
    }
    $count_of_lines = count(array_filter($lines));
    fclose($textcontent);

    return $count_of_lines;
}

function overwrite_file_content($filedirectory, $fileextension, $word, $number_of_whitespaces, $linenumber){
    $textcontent = fopen($filedirectory . $fileextension, 'a+');
    fwrite($textcontent, insecure_text($word, $number_of_whitespaces));
    $text = print_line_of_file($filedirectory, $fileextension, $linenumber);
    fclose($textcontent);

    return $text;
}
