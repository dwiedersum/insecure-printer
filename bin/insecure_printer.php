<?php

require("../lib/printer.php");

use printer as p;

//Define the directory of the textfile

/**
 * To start the creation of the new file write:
 * 'php insecure_printer.php -i "filename"' in commandline
 * Create a new file via interactive shell query and write the text in it:
 * "Ich wollte sagen:     line_of_the_old_textfile     wenn es dir recht ist."
 * also displaying the text on the command line.
 */
$full_filename = p\input_of_filename_via_interactive_shell();
$filename = $full_filename["filename"];
$old_fileextension = $full_filename["fileextension"];
if($full_filename !== false){
    $new_fileextension = p\extension_query();
    if($new_fileextension !== false){
        $line_array = p\array_of_lines_from_file($file_location . $filename . "." . $old_fileextension);
        foreach ($line_array as $linetext){
            $text .= p\overwrite_file_content($file_location . $filename, $new_fileextension, $linetext);
        }
        echo "\n";
        echo "Der folgende Text wurde in die Datei überschrieben.\n";
        echo "\n";
        echo $text;
        echo "\n";
    }
}
