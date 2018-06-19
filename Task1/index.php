<?php

/**
 * @param $path
 * @param $outputFilePath
 */
function readCsvFile($path, $outputFilePath)
{
    $file = fopen($path, "r");
    try {
        if (file_exists($path) == false) {
            throw  new Exception("File not exists!");
        } else {
            writeToCsvFile($file, $outputFilePath);
            fclose($file);
        }
    } catch (Exception $e) {
            echo "<b>". $e->getMessage(). "</b>";
    }
}

/**
 * @param $file
 * @param $path
 */
function writeToCsvFile($file, $path)
{
    $write_file = fopen($path, "w+");
    while (($data = fgetcsv($file, filesize("input.csv"), ",")) !== false) {
        foreach ($data as $key => $value) {
            $match = preg_match("/^([0-9]+[a-z]|[a-z]+[0-9])[a-zA-Z0-9]*@(coeus-solutions.de)$/", $value);
            if ($match == 1) {
                $output_data = $data[0].",". $data[1]. ",". $data[3].",". $data[2].",";
                echo $output_data. "<br>";
                if (!fputcsv($write_file, explode(',', $output_data))) {
                    echo "<br> Something went wrong writing data to file $data";
                }
            }
        }
    }
}
    readCsvFile("input.csv", "output.csv");
