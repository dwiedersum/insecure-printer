<?php
namespace cli;

function check_options_from_commandline($modulename){
    $shape_and_size = array( "shape:", "size:");
    $option = getopt("hi:", $shape_and_size);
    if ($option[h] != null){
        return "help";
    }else{
        if(isset($option[i]) == true){
            if (is_string($option[i]) == true){
                $filename_array = array("message" => "Interactive Mode: Activated", "filename" => $option[i]);
                return $filename_array;
            }else{
                return "Interactive Mode: Activated";
            }
        }else{
            $error_msg = "Die Eingabe wurde nicht erkannt.\n" .
                         "Bitte geben Sie 'php " . $modulename . " -h' ein, um die Hilfe zu öffnen.\n";
            if ($option["shape"] !== null && $option["size"] !== null){
                $shape_array = array("shape" => $option["shape"], "size" => $option["size"], "message" => $error_msg);
                return $shape_array;
            }else{
                return false;
            }
        }
    }
}
