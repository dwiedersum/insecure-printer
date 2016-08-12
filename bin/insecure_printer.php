<?php

require("../lib/printer-php");

use printer as p;

echo "Hallo von der Kommandozeile ... \n";
echo "Mit 5 spaces: |" . p\pad_left_and_right("Hallo", 5) . "|\n";
