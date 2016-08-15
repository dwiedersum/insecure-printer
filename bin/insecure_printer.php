<?php

require("../lib/printer.php");

use printer as p;

echo "Hallo von der Kommandozeile ... \n";
echo "Mit 5 spaces: |" . p\pad_left_and_right("Hallo", 5) . "|\n";

//Define directory of the textfile and set the start of the textfile to line 1
$old_filedirectory = "./print";
$old_fileextension = ".txt";
$number_of_line = 0;

//Define the new filename and directory
$new_fileextension = ".TEXT";
$new_filedirectory = "./print_insecure";
$added_name = "_insecure";

$line_count = p\count_lines_of_file($old_filedirectory, $old_fileextension);//line count of the old file
$number_of_whitespaces = 5;

/**Create a new file and write the desired text in it:
* "Ich wollte sagen:     line_of_the_old_textfile     wenn es dir recht ist."
* also displaying the text on the command line.*/
while($number_of_line  < $line_count){
    $word = p\print_line_of_file($old_filedirectory, $old_fileextension, $number_of_line);
    $text .= p\overwrite_file_content($new_filedirectory, $new_fileextension, $word, $number_of_whitespaces, $number_of_line) . "\n";
    $number_of_line++;
}
echo $text;
