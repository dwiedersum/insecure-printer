<?php

require("../lib/shapes.php");

use shapes as sh;

$shape_and_size = sh\read_shape_and_size();
if(sh\open_help($shape_and_size[h]) == true){

}else{
    $shape = $shape_and_size["shape"];
    $size = $shape_and_size["size"];
    echo sh\draw_shape_with_input_from_commandline($shape, $size);
}
