<?php

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $uname = $_POST["uname"];
        $pswd = $_POST["pswd"];

        $conn = new mysqli("localhost", "root", "", "test");
        $sql = "SELECT password FROM `phplogin` where username = '". $uname ."'";
        $result = $conn->query($sql);
        $record = $result->fetch_row();
        if(empty($record[0]))
            echo "User not found";
        else
            echo $record[0] == $pswd? "Login Success": "Invalid Password";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="uname" placeholder="Username">
        <br><br>
        <input type="password" name="pswd" placeholder="Password">
        <br><br>
        <input type="submit" value="Login">
    </form>
    <br>
    <a href="register.php">Register</a>
</body>
</html>