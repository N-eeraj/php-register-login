<?php

    $status = "";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // accessing user input
        $uname = trim($_POST["uname"]);
        $pswd = $_POST["pswd"];

        // db connection & run query
        $conn = new mysqli("localhost", "root", "", "test");
        $sql = "SELECT password FROM `phplogin` where username = '$uname'";
        $result = $conn->query($sql);
        $record = $result->fetch_row();

        // validation & login
        if(empty($uname))
            $status = "<p class='my-alert alert-danger'>Username can't be empty</p>";
        else if(empty($record[0]))
            $status = "<p class='my-alert alert-danger'>User not found</p>";
        else
            $status = $record[0] == $pswd? 
            "<p class='my-alert alert-success'>Login Success</p>": 
            "<p class='my-alert alert-danger'>Wrong Password</p>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                <label for="pswd" class="form-label">Password</label>
                <input type="password" id="pswd" name="pswd" placeholder="Password" class="form-control">
            </div>
            
            <div class="row justify-content-around">
                <input type="submit" value="Login" class="btn btn-primary col-5 col-sm-4 col-md-3">
                <a href="register.php" class="btn btn-secondary col-5 col-sm-4 col-md-3">Register</a>
            </div>
        </form>
    </div>
    
</body>
</html>