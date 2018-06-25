<?php
/**
 * Main page file
 */

include "dbConnection.php";
$message = "";
$email_status = "Sign Up";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = testInput($_POST["user_email"]);
    $password = testInput($_POST["password"]);
    $confirm_password = testInput($_POST["confirm_password"]);
    $activation_code = md5(rand(0, 1000));
    $message = insertData($connection, $user_email, $password, $activation_code);
}
/**
 * This method inserts user details in db and then send call email method
 * @param object $connection
 * @param string $user_email
 * @param string $password
 * @param string $activation_code
 * @return string
 */
function insertData($connection, $user_email, $password, $activation_code)
{
    try {
        $result = $connection->query("INSERT INTO users(email, password, activation_code, status, user_type)".
            "VALUES('$user_email', '$password', '$activation_code', '0', 'normal_user')");
        if ($result == false) {
            if (mysqli_errno($connection) == 1062) {
                throw new Exception("Email already exists");
            } else {
                throw new Exception("Something went wrong entering the data in database!");
            }
        } else {
            $connection->close();
            $email_status = "Processing...";
            $status = sendAnEmail($user_email, $activation_code);
            if ($status) {
                $message = "An activation link has been shared with you. Kindly check your inbox!";
                $email_status = "Sign Up";
                return $message;
            }
        }
    } catch (Exception $exception) {
        $connection->close();
        return $exception->getMessage();

    }
}


/**
 * Send an activation code to user email address
 * @param string $user_email
 * @param string $activation_code
 * @return bool
 */
function sendAnEmail($user_email, $activation_code)
{
    try {
        $to = $user_email;
        $subject = "Account Activation Link";
        $body = "Click on the link to complete sign up process " . "<a target='_blank' " .
            "href='http://localhost:1234/php/Assignments/Authentication%20System/" .
            "verify.php?code=$activation_code&email=$user_email'>$activation_code
    </a>";
        $header = "From:abc@example.com \r\n";
        $header .= "Content-type: text/html\r\n";
        $status = mail($to, $subject, $body, $header);
        return $status;
    } catch (Exception $exception) {
        return $exception->getMessage();
    }
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

    <form method="post" onSubmit="validate(event)" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
        <h4 style="text-align:center;">Sign Up</h4>
        <label>Email</label>
            <input type="email" name="user_email" id="user_email" required/><br><br>
        <label>Password</label>
            <input type="password" name="password" id="password" maxlength="16" required/><br><br>
        <label>Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" maxlength="16" required /><br><br>
        <span><?php echo $message ?></span><br><br>
        <span id="mismatched"></span><br>
        <button type="submit" target="self"><?php echo $email_status?></button><br><br>
        <a href="signIn.php" target="_top">Already have an account?</a><br>
    </form>

</body>

</html>
<script>
    function validate(e) {
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;
        if (password != confirm_password) {
            e.preventDefault(true);
            document.getElementById("mismatched").innerHTML = "Password mismatched";
        } else {
            return false;
        }
    }

</script>