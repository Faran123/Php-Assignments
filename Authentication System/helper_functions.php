<?php

/**
 * This method performs validation checks on user input
 * @param string $data
 * @return string
 */
function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function exceptionMessage($message)
{
    return "Something went wrong. ".$message;
}
