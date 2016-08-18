<?php
namespace test\printer;

require("../lib/printer.php");

use PHPUnit\Framework\TestCase;
use printer;

class printer_testcase extends TestCase {
    public function test_pad_left_and_right_with_spaces(){
        $this->assertEquals("   Hallo   ",
                           printer\pad_left_and_right("Hallo", 3));
        $this->assertEquals("  Test  ",
                           printer\pad_left_and_right("Test", 2));
    }


    public function test_insecure_text(){
        $this->assertEquals("Ich wollte sagen:     Hallo     wenn es dir recht ist.\n",
                            printer\insecure_text("Hallo", 5));
        $this->assertEquals("Ich wollte sagen:     Hallo     wenn es dir recht ist.\n",
                                                printer\insecure_text("Hallo"));
    }

    public function test_input_of_filename_operation(){
        $this->assertEquals("Die Eingabe wurde nicht erkannt.\n" .
                            "Bitte geben Sie 'php insecure_printer.php -h' ein, um die Hilfe zu öffnen.",
                            printer\input_of_filename_operation(""));
        $this->assertEquals("Bitte geben Sie den vollständigen Namen der Datei an.",
                            printer\input_of_filename_operation("asdf"));
        $this->assertEquals("Datei konnte nicht gefunden werden.",
                            printer\input_of_filename_operation("text.txt"));
    }

    public function test_extension_query_operation(){
        $this->assertEquals("Die Datei wurde erstellt.",
                            printer\response_to_extension("php")["messages"]);
        $this->assertEquals("Die Eingabe ist ungültig." .
                            " Bitte geben Sie eine Extension ein, die nicht mehr als 5 Zeichen besitzt.",
                            printer\response_to_extension("phptxt")["messages"]);
        $this->assertEquals("Es wurde keine Eingabe erkannt.",
                            printer\response_to_extension("")["messages"]);
        $this->assertEquals(".php",
                            printer\response_to_extension("php")["right_fileextension"]);
        $this->assertEquals(false,
                            printer\response_to_extension("phptxt")["right_fileextension"]);
        $this->assertEquals(false,
                            printer\response_to_extension("")["right_fileextension"]);
    }

    public function test_string_length(){
        $this->assertEquals(5, printer\extension_length("asdfg"));
        $this->assertEquals(0, printer\extension_length(""));
    }


    public function test_file_extension(){
        $this->assertEquals(".txt",
                            printer\file_extension("/source/insecure_printer/bin/print.txt"));
    }

    public function test_array_of_lines_from_text_file(){
        $this->assertEquals("was ich",
                            printer\array_of_lines_from_file("/source/insecure_printer/bin/print.txt")[2]);
        $this->assertEquals("Es tut mir leid.",
                            printer\array_of_lines_from_file("/source/insecure_printer/bin/write.txt")[0]);
    }

    public function test_overwrite_file_content(){
        $this->assertEquals("Ich wollte sagen:     Hallo     wenn es dir recht ist.\n",
                            printer\overwrite_file_content("/source/insecure_printer/bin/print_insecure",
                            ".txt", "Hallo"));
    }
}
