<?php

readCsvFile("input.csv", "output.csv");
/**
 * Read data from excel file
 * @param string $input_file_path
 * @param string $output_file_path
 */
function readCsvFile($input_file_path, $output_file_path)
{
    $input_file = fopen($input_file_path, "r");
    try {
        if (file_exists($input_file_path) == false) {
            throw  new Exception("Input file does not exist!");
        } else {
            writeToCsvFile($input_file, $output_file_path);
            fclose($input_file);
        }
    } catch (Exception $exception) {
            echo "<b>". $exception->getMessage(). "</b>";
    }
}

/**
 * Write data to excel file
 * @param file $input_file
 * @param string $output_file_path
 */
function writeToCsvFile($input_file, $output_file_path)
{
    set_error_handler('errorHandlerForExceptions');
    $write_file = fopen($output_file_path, "w+");
    while (($data = fgetcsv($input_file, filesize("input.csv"), ",")) !== false) {
        $match = emailValidate($data[3]);
        if ($match) {
            try {
                $output_data = $data[0] . "," . $data[1] . "," . $data[3] . "," . $data[2] . ",";
                echo $output_data. "<br>";
                if (!fputcsv($write_file, explode(',', $output_data))) {
                    echo "<br> Something went wrong writing data to file";
                }
            } catch (Exception $exception) {
                echo $exception->getMessage();
                break;
            }
        }
    }
    fclose($write_file);
}

/**
 * performs email validation
 * @param string $email
 * @return false|true
 */
function emailValidate($email)
{
    $match = preg_match("/^([0-9]+[a-z]|[a-z]+[0-9])[a-zA-Z0-9]*@(coeus-solutions.de)$/", $email);
    return $match;
}
function errorHandlerForExceptions($severity, $message, $file_name, $line_no)
{
    if (error_reporting() == 0) {
        return;
    }
    if (error_reporting() & $severity) {
        throw new ErrorException($message, 0, $severity, $file_name, $line_no);
    }
}