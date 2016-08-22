<?php

require("../lib/printer.php");
require_once("../lib/CLI.php");

use printer as p;

//Define the directory of the textfile

/**
 * To start the creation of the new file write:
 * 'php insecure_printer.php -i "filename"' in commandline
 * Create a new file via interactive shell query and write the text in it:
 * "Ich wollte sagen:     line_of_the_old_textfile     wenn es dir recht ist."
 * also displaying the text on the command line.
 */
$options = cli\check_options_from_commandline("insecure_printer.php");
$full_filename = p\read_filename_via_interactive_shell($options);
if (is_string($full_filename) == true && $full_filename !== "help"){
    echo $full_filename;
}elseif (isset($full_filename["filename"]) == true){
    $filename = $full_filename["filename"];
    $old_fileextension = $full_filename["fileextension"];
    if($full_filename == false){
        return;
    }
    $new_fileextension = p\extension_query($filename);
    if($new_fileextension == false){
        return;
    }
    $line_array = p\array_of_lines_from_file($filename . $old_fileextension);
    foreach ($line_array as $linetext){
        $text .= p\overwrite_file_content($filename, $new_fileextension, $linetext);
    }
    echo "Der folgende Text wurde in die Datei überschrieben.\n";
    echo "\n";
    echo $text;
    echo "\n";
}elseif($full_filename !== "help" && $options !== false){
    echo "\n";
    echo "Die Eingabe wurde nicht erkannt.\n";
    echo "Bitte geben Sie 'php insecure_printer.php -h' ein, um die Hilfe zu öffnen.\n";
    echo "\n";
}
