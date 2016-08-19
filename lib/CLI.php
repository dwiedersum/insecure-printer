<?php
namespace cli;

function check_options_from_commandline($modulename){
    $shape_and_size = array( "shape:", "size:");
    $option = getopt("hi::", $shape_and_size);
    if ($option[h] !== null){
        return "help";
    }else{
        if(isset($option[i]) == true){
            if (is_string($option[i]) == true){
                $filename_array = array("message" => "\nInteractive Mode: Activated", "filename" => $option[i]);
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
            if ($option["shape"] !== null && $option["size"] !== null){
                $shape_array = array("shape" => $option["shape"], "size" => $option["size"], "message" => $error_msg);
                return $shape_array;
            }else{
                echo $error_msg;
                return false;
            }
        }
    }
}
