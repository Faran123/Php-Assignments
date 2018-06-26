<?php
include "db_connection.php";
include "helper_functions.php";
$email = $_GET["email"];
$activation_code = $_GET["code"];
$activate = "";
try {
    $result = $connection->query("UPDATE users SET status='1' WHERE email='$email' and activation_code='$activation_code'");
    if ($result == false) {
        throw new Exception(exceptionMessage("The user is not activated yet!"));
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
    <meta http-equiv="refresh" content="2;URL=sign_in.php" />
    <title>User Verification</title>
</head>
<body>
    <div style="text-align: center;">
    <h4><?php echo $activate ?></h4>
        <h5>Redirecting to login page.<h5>
    </div>
</body>
</html>