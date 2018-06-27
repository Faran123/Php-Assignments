<?php
include "db_connection.php";
include "helper_functions.php";
$email = $_GET["email"];
$activation_code = $_GET["code"];
$activate = 0;
try {
    $result = $connection->query("UPDATE users SET status='1' WHERE email='$email' and activation_code='$activation_code'");
    if ($result == false) {
        throw new Exception(exceptionMessage("The user is not activated yet!"));
    } else {
        if (mysqli_affected_rows($connection) > 0) {
            $activate = 1;
            $message = "User activation successful!";
            header("refresh:2; url=sign_in.php");
        } else {
            $message = "The user is already activated!";
            $activate = 0;
        }
    }
} catch (Exception $exception) {
    $activate = $exception->getMessage();
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>User Verification</title>
</head>
<body>
    <div style="text-align: center;">
    <h4><?php echo $message ?></h4>
        <?php if ($activate == 1) {
            echo "<h5>Redirecting to login page.<h5>";
        }
?>
    </div>
</body>
</html>