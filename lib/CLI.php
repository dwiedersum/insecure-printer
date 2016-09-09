<?php
namespace cli;

function check_options_from_commandline($modulename){
    $error_msg = "\n" .
                 "Die Eingabe wurde nicht erkannt.\n" .
                 "Bitte geben Sie 'php " . $modulename . " -h' ein, um die Hilfe zu öffnen.\n" .
                 "\n";
    if($modulename == "print_shape.php"){
        $figure_input = array("shape:", "size:", "filler:");
        $option = getopt("hi", $figure_input);
        if(isset($option["h"])){
            return "help";
        }else{
            if(isset($option["i"])){
                return "\n" .
                       "Interactive Mode: Activated\n" .
                       "\n";
            }else{
                $shape_array = array();
                $shape_array["message"] = $error_msg;
                if(isset($option["shape"]) || isset($option["size"]) || isset($option["filler"])){
                    $shape_array["shape"] = $option["shape"];
                    $shape_array["size"] = $option["size"];
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
    }elseif($modulename == "insecure_printer.php"){
        $option = getopt("hi:");
        if (isset($option["h"])){
            return "help";
        }else{
            if(isset($option["i"]) == true){
                $filename_array = array("message" => "\nInteractive Mode: Activated", "filename" => $option["i"]);
                return $filename_array;
            }else{
                echo $error_msg;
                return false;
            }
        }
    }elseif($modulename == "big_figure.php"){
        $figure_input = array("shape:", "repeat:", "filler:", "size::");
        $option = getopt("hi", $figure_input);
        if(isset($option["h"])){
            return "help";
        }else{
            if(isset($option["i"])){
                $message = "\n" .
                           "Interactive Mode: Activated\n" .
                           "\n";
                return $message;
            }else{
                $shape_array = array();
                $shape_array["message"] = $error_msg;
                if(isset($option["shape"]) || isset($option["repeat"]) || isset($option["filler"])){
                    $shape_array["shape"] = $option["shape"];
                    $shape_array["repeat"] = $option["repeat"];
                    $shape_array["filler"] = $option["filler"];
                    if(isset($option["size"])){
                        $shape_array["size"] = $option["size"];
                    }
                    return $shape_array;
                }else{
                    echo $error_msg;
                    die();
                }
            }
        }
    }
}
