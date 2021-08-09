<?php

    $status = "";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $uname = $_POST["uname"];
        $pswd = $_POST["pswd"];

        $conn = new mysqli("localhost", "root", "", "test");
        $sql = "SELECT password FROM `phplogin` where username = '$uname'";
        $result = $conn->query($sql);
        $record = $result->fetch_row();

        if(empty($record[0]))
        $status = "<p class='bg-danger col-4'>User not found</p>";
        else
            $status = $record[0] == $pswd? "<p class='bg-success col-4'>Login Success</p>": "<p class='bg-danger col-4'>Wrong Password</p>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body class="container">

    <?php echo $status ?>

    <form method="POST" class="col-4">

        <div class="mb-3">
            <label for="uname" class="form-label">Username</label>
            <input type="text" id="uname" name="uname" placeholder="Username" class="form-control">
        </div>

        <div class="mb-3">
            <label for="pswd" class="form-label">Password</label>
            <input type="password" id="pswd" name="pswd" placeholder="Password" class="form-control">
        </div>
        
        <input type="submit" value="Login" class="btn btn-primary">
        <a href="register.php" class="btn btn-secondary">Register</a>
    </form>
    
</body>
</html>