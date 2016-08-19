<?php

require("../lib/shapes.php");
require_once("../lib/CLI.php");

use shapes as sh;

$options = cli\check_options_from_commandline("print_shape.php");
$shape_and_size = sh\categorize_options_from_cli($options);
if (is_array($options)){
    $shape = $options["shape"];
    $size = $options["size"];
    if (is_numeric($size) == true){
        sh\draw_shape_with_input_from_commandline($shape, $size);
    }else{
        echo sh\message_to_shape_choice(false);
    }
}elseif(is_string($options) == true && $options !== "help"){
    $shape = sh\read_shape_with_interactive_mode();
    if ($shape !== false){
        $size = sh\set_size_with_interactive_mode();
        if($size !== false){
            sh\draw_shape_with_input_from_commandline($shape, $size);
        }else{
            echo "\n";
            echo "Die gewählte Größe wurde nicht erkannt.\n";
            echo "Für weitere Informationen geben Sie 'php print_shape.php -h' ein.\n";
            echo "\n";
        }
    }else{
        echo "\n";
        echo "Die gewählte Form wurde nicht erkannt.\n";
        echo "Für weitere Informationen geben Sie 'php print_shape.php -h' ein.\n";
        echo "\n";
    }
}
