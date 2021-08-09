<?php

    $status = "";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $uname = trim($_POST["uname"]);
        $pswd1 = trim($_POST["pswd1"]);
        $pswd2 = trim($_POST["pswd2"]);

        if(empty($uname))
            $status = "<p class='my-alert alert-danger'>Username can't be empty</p>";
        else if(strlen($pswd1) < 8)
            $status = "<p class='my-alert alert-danger'>Password should be atleast 8 characters long</p>";
        else if($pswd1 != $pswd2)
            $status = "<p class='my-alert alert-danger'>Passwords not matching</p>";

        else
        {
            $conn = new mysqli("localhost", "root", "", "test");
            $sql = "SELECT username from `phplogin` WHERE username = '$uname'";
            $result = $conn->query($sql);
            $record = $result->fetch_row();

            if(!empty($record[0]))
                $status = "<p class='my-alert alert-danger'>Username is already taken</p>";

            else
            {
                $sql = "INSERT INTO `phplogin` VALUES('$uname', '$pswd1')";
                $conn->query($sql);
                $conn->close();
                $status = "<p class='my-alert alert-success'>Registration Success</p>";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body class="container bg-primary">

    <div class="card bg-light col-11 col-sm-8 col-lg-5">
        <?php echo $status ?>

        <form method="POST">

            <div class="mb-3">
                <label for="uname" class="form-label">Username</label>
                <input type="text" id="uname" name="uname" placeholder="Username" class="form-control">
            </div>

            <div class="mb-3">
                <label for="pswd1" class="form-label">Password</label>
                <input type="password" id="pswd1" name="pswd1" placeholder="Password" class="form-control">
            </div>

            <div class="mb-3">
                <label for="pswd2" class="form-label">Confirm Password</label>
                <input type="password" id="pswd2" name="pswd2" placeholder="Confirm Password" class="form-control">
            </div>
            
            <div class="row justify-content-around">
                <input type="submit" value="Sign Up" class="btn btn-primary col-5 col-sm-4 col-md-3">
                <a href="login.php" class="btn btn-secondary col-5 col-sm-4 col-md-3">Login</a>
            </div>
        </form>
    </div>
    
</body>
</html>