<?php

require("../lib/printer.php");

use printer as p;

//Define the directory of the textfile
$old_filedirectory = "/source/insecure_printer/bin/print.txt";

//Define the new directory
$new_filedirectory = "/source/insecure_printer/bin/";

/**To start the creation of the new file write:
* 'php insecure_printer.php -i "filename"' in commandline
* Create a new file via interactive shell query and write the text in it:
* "Ich wollte sagen:     line_of_the_old_textfile     wenn es dir recht ist."
* also displaying the text on the command line.*/
$filename = p\input_of_filename_via_interactive_shell($old_filedirectory);
if($filename !== false){
    $fileextension = p\extension_query();
    if($fileextension !== false){
        $line_array = p\array_of_lines_from_file($old_filedirectory);
        foreach ($line_array as $linetext){
            $text .= p\overwrite_file_content($new_filedirectory . $filename, $fileextension, $linetext);
        }
        echo $text;
    }
}
