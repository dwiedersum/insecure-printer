<?php

require("../lib/printer.php");

use printer as p;

//Define directory of the textfile
$old_filedirectory = "/source/insecure_printer/bin/print.txt";

//Define the new filename and directory w/o extension needed
$new_filedirectory = "/source/insecure_printer/bin/print_insecure";

/**Create a new file and write the desired text in it:
* "Ich wollte sagen:     line_of_the_old_textfile     wenn es dir recht ist."
* also displaying the text on the command line.*/
$input = p\activate_interactive_mode();
/**if ($activation == true){
    $extension = p\extension_query();
    if (strlen($extension) <=5){
        $line_array = p\array_of_lines_from_file($old_filedirectory);
        foreach ($line_array as $linetext){
            $text .= p\overwrite_file_content($new_filedirectory, $extension, $linetext);
        }
        echo $text;
    }else{
        echo $extension;
    }
}else{
    echo "Failure in activating interactive mode.\n";
}*/
