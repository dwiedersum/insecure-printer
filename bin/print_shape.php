<?php

require("../lib/shapes.php");

use shapes as sh;

$options = sh\read_options();
if (sh\open_help($options[h]) == true){
    echo "\n";
}elseif(sh\activate_interactive_mode($options[i]) == true){
    $shape = sh\read_shape_with_interactive_mode();
    if ($shape !== false){
        $size = sh\set_size_with_interactive_mode();
        if($size !== false){
            sh\response_to_shape_and_size($shape, $size);
        }else{
            echo "Die gewählte Größe wurde nicht erkannt.\n";
        }
    }else{
        echo "Die gewählte Form wurde nicht erkannt.\n";
    }
}/**else{
    $shape = $options["shape"];
    $size = $options["size"];
    sh\response_to_shape_and_size($shape, $size);
}*/
