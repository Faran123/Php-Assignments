<?php
/**
 * Created by PhpStorm.
 * User: coeus-sol
 * Date: 6/22/18
 * Time: 12:04 AM
 */
include "dbConnection.php";
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = testInput($_POST["user_email"]);
    $password = testInput(($_POST["password"]));
    try {
        $result = $connection->query("SELECT user_type, status from users where email='$email'".
            "and password='$password'");
        if ($result == false) {
            throw new Exception("Something went wrong.");
        } else {
            if ($result->num_rows > 0) {
                while ($data = $result->fetch_assoc()) {
                    if ($data["status"] == 0) {
                        $message = "Status: <b>Inactive</b><br>";
                    } else if ($data["status"] == 1) {
                        if ($data["user_type"] == "normal_user") {
                            welcomePage($email);
                        } else if ($data["user_type"] == "admin") {
                            listUserDetails($email);
                        }
                    }
                }
            } else {
                $message = "Please provide valid email address or password. <br>";
            }
        }
    } catch (Exception $exception) {
        $message = $exception->getMessage();
    }


}
/**
 * Welcome page
 * @param string $email
 */
function welcomePage($email)
{
    header("Location: welcomePage.php?email=$email");
}

/**
 *list user details e.g user email and status
 * @param string $email
 */
function listUserDetails($email)
{
    header("Location: userDetails.php?email=$email");
}
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
