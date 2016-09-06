<?php
namespace cli;

function check_options_from_commandline($modulename){
    $figure_input = array( "shape:", "size:", "filler:");
    $option = getopt("hi::", $figure_input);
    if (isset($option["h"])){
        return "help";
    }else{
        if(isset($option["i"]) == true){
            if (is_string($option["i"]) == true){
                $filename_array = array("message" => "\nInteractive Mode: Activated", "filename" => $option["i"]);
                return $filename_array;
            }else{
                return "\n" .
                       "Interactive Mode: Activated\n" .
                       "\n";
            }
        }else{
            $error_msg = "\n" .
                         "Die Eingabe wurde nicht erkannt.\n" .
                         "Bitte geben Sie 'php " . $modulename . " -h' ein, um die Hilfe zu öffnen.\n" .
                         "\n";
            $shape_array = array();
            $shape_array["message"] = $error_msg;
            if (isset($option["shape"]) || isset($option["size"]) ||isset($option["filler"])){
                if(isset($option["size"])){
                    $shape_array["size"] = $option["size"];
                }else{
                    $shape_array["size"] = "";
                }
                if(isset($option["shape"])){
                    $shape_array["shape"] = $option["shape"];
                }else{
                    $shape_array["shape"] = "";
                }
                if(isset($option["filler"]) && strlen($option["filler"]) == 1){
                    $shape_array["filler"] = $option["filler"];
                }else{
                    $shape_array["filler"] = "#";
                }
                return $shape_array;
            }else{
                echo $error_msg;
                return false;
            }
        }
    }
}
