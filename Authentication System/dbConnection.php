<?php
/**
 * this method creates db connection
 * @param string $server_name
 * @param string $user_name
 * @param string $password
 * @return string
 */
$connection = connection("localhost", "root","coeus123", "authentication_system");
function connection($server_name, $user_name, $password, $database)
{
    try {
        // Check connection
        $connection = new mysqli($server_name, $user_name, $password, $database);
        if ($connection->connect_error) {
            throw  new Exception("Unable to connect to database!");
        }
        return $connection;
    } catch (Exception $exception) {
        return $exception->getMessage();
    }
}

