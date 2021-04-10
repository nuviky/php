<?php

require 'getRes.php';

$input = glob("A/*.dat");
$output = glob("A/*.ans");

$index = 0;

foreach ($input as $in) {
    $fRes = getRes($in);
    $file = fopen($output[$index], 'r');
    $fileRes = fgets($file);
    $index++;
    echo "Test № $index: ";
    if($fRes == $fileRes){
        echo "correct</p>";
    }
    else{
        echo "incorrect</p>";
    }
}

?>