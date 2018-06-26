<?php

$server_name = "localhost";
$user_name = "root";
$password = "coeus123";
$database = "authentication_system";
$connection = connection($server_name, $user_name, $password, $database);
/**
 * this method creates db connection
 * @param string $server_name
 * @param string $user_name
 * @param string $password
 * @param string $database
 * @return string
 */
function connection($server_name, $user_name, $password, $database)
{
    try {
        // Check connection
        $connection = new mysqli($server_name, $user_name, $password, $database);
        if ($connection->connect_error) {
            throw  new Exception(exceptionMessage("\"Unable to connect to database!\""));
        }
        return $connection;
    } catch (Exception $exception) {
        return $exception->getMessage();
    }
}

