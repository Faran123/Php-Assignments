<?php
include "db_connection.php";
$email = $_GET["email"];
try {
    $result = $connection->query("SELECT status, email from users WHERE email !='$email'");
    if ($result == false) {
        throw new Exception(exceptionMessage("Unable to get user details!"));
    }
} catch (Exception $exception) {
    echo $exception->getMessage();
}
?>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <div style="padding-left:50px;">
        <span style="display: inline-block;width: 163px;">Email</span>
        <span >Status</span><br>
            <?php
            if ($result->num_rows > 0) {
                while ($data = $result->fetch_assoc()) {
                    ?>
        <span style="display: inline-block;width: 163px;"><?php echo $data["email"];?></span>
        <span><?php echo $data["status"];?></span><br>
                    <?php
                }
            }?>
    </div>

</body>
</html>
