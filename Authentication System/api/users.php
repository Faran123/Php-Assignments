<?php
include "../db_connection.php";
include "../helper_functions.php";
retrieveUsers($connection);

/**
 * This method retrieves user details from users table
 * @param $connection
 */
function retrieveUsers($connection)
{
    try {
        $result = $connection->query("SELECT email, status, user_type from users");
        if ($result == false) {
            throw new Exception(exceptionMessage(""));
        } else {
            if ($result->num_rows > 0) {
                $users_array = displayUsers($result);
                echo $users_array;
            } else {
                echo "User not found!";
            }
        }
    } catch (Exception $exception) {
        echo $exception->getMessage();
    }
}

/**
 * This method displays users details as an json array
 * @param $result
 * @return string
 */
function displayUsers($result)
{
    $users['data'] = array();
    while ($data = $result->fetch_assoc()) {
        $users_array = array(
            'email' => $data['email'],
            'status' => $data['status'],
            'user type' => $data['user_type'],
        );
        array_push($users['data'], $users_array);
    }
    return json_encode($users);
}
