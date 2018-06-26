<?php
include "db_connection.php";
include "helper_functions.php";
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = testInput($_POST["user_email"]);
    $password = testInput(($_POST["password"]));
    try {
        $result = $connection->query("SELECT user_type, status from users where email='$email'".
            "and password='$password'");
        if ($result == false) {
            throw new Exception(exceptionMessage("User is not logged in!"));
        } else {
            if ($result->num_rows > 0) {
                $message = userStatus($result, $email);
            } else {
                $message = "Please provide valid email address or password. <br>";
            }
        }
    } catch (Exception $exception) {
        $message = $exception->getMessage();
    }


}

/**
 * This method checks user status whether normal or admin user
 * @param $result
 * @param $email
 * @return string
 */
function userStatus($result, $email)
{
    while ($data = $result->fetch_assoc()) {
        if ($data["status"] == 0) {
            $message = "Status: <b>Inactive</b><br>";
            return $message;
        } else if ($data["status"] == 1) {
            if ($data["user_type"] == "normal_user") {
                welcomePage($email);
            } else if ($data["user_type"] == "admin") {
                listUserDetails($email);
            }
        }
    }
}
/**
 * Welcome page
 * @param string $email
 */
function welcomePage($email)
{
    header("Location: welcome_page.php?email=$email");
}

/**
 *list user details e.g user email and status
 * @param string $email
 */
function listUserDetails($email)
{
    header("Location: user_details.php?email=$email");
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Authentication System</title>
    <style>
        form {
            text-align: center;
            position: relative;
            top: 50px;
            padding-bottom: 30px;
        }
        label {
            display: inline-block;
            width: 150px;
        }
    </style>
</head>

<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
    <h4 style="text-align:center;">Sign In</h4>
    <label>Email</label>
        <input type="email" name="user_email" id="user_email" required/><br><br>
    <label>Password</label>
        <input type="password" name="password" id="password" maxlength="16" required/><br><br>
    <span><?php echo $message ?></span><br>
    <button type="submit" target="self">Sign In</button><br><br>
</form>

</body>

</html>
