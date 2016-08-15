<?php

require("../lib/printer.php");

use printer as p;

echo "Hallo von der Kommandozeile ... \n";
echo "Mit 5 spaces: |" . p\pad_left_and_right("Hallo", 5) . "|\n";

//Define directory of the textfile
$old_filedirectory = "./print";
$old_fileextension = ".txt";

//Define the new filename and directory
$new_fileextension = ".TEXT";
$new_filedirectory = "./print_insecure";
$added_name = "_insecure";

$number_of_whitespaces = 5;

/**Create a new file and write the desired text in it:
* "Ich wollte sagen:     line_of_the_old_textfile     wenn es dir recht ist."
* also displaying the text on the command line.*/
$line_array = p\array_of_lines_from_file($old_filedirectory, $old_fileextension);
foreach ($line_array as $linetext){
    $text .= p\overwrite_file_content($new_filedirectory, $new_fileextension, $linetext, $number_of_whitespaces);
}
echo $text;
