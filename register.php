<?php

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $uname = trim($_POST["uname"]);
        $pswd1 = trim($_POST["pswd1"]);
        $pswd2 = trim($_POST["pswd2"]);

        if(empty($uname))
            echo "Username can't be empty";
        else if(strlen($pswd1 < 8))
            echo "Password should be atleast 8 characters long";
        else if($pswd1 != $pswd2)
            echo "Passwords not matching";
        else
        {
            $conn = new mysqli("localhost", "root", "", "test");
            $sql = "SELECT username from `phplogin` WHERE username = '$uname'";
            $result = $conn->query($sql);
            $record = $result->fetch_row();
            if(!empty($record[0]))
                echo "Username is already taken";
            else
            {
                $sql = "INSERT INTO `phplogin` VALUES('$uname', '$pswd1')";
                $conn->query($sql);
                $conn->close();
                echo "Registration Success";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="uname" placeholder="Username">
        <br><br>
        <input type="password" name="pswd1" placeholder="Password">
        <br><br>
        <input type="password" name="pswd2" placeholder="Confirm Password">
        <br><br>
        <input type="submit" value="Sign Up">
    </form>
    <br>
    <a href="index.php">Login</a>
</body>
</html>