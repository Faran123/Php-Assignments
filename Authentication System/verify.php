<?php
/**
 * Created by PhpStorm.
 * User: coeus-sol
 * Date: 6/22/18
 * Time: 4:01 AM
 */
include "dbConnection.php";
$email = $_GET["email"];
$activate = "";
try {
    $result = $connection->query("UPDATE users SET status='1' WHERE email='$email'");
    if ($result == false) {
        throw new Exception("Something went wrong while activating the user! ");
    } else {
            $activate = "User activation successful!";
    }
} catch (Exception $exception) {
    $activate = $exception->getMessage();
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="2;URL=signin.php" />
    <title>User Verification</title>
</head>
<body>
    <div style="text-align: center;">
    <h4><?php echo $activate ?></h4>
        <h5>Redirecting to login page.<h5>
    </div>
</body>
</html>