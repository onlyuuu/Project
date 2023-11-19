
<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "project";

$data = mysqli_connect($host, $user, $password, $db);

if ($data == false) {
    die("Connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM login WHERE username = '" . $username . "' AND password = '" . $password . "'";
        $result = mysqli_query($data, $sql);
        $row = mysqli_fetch_array($result);

        if ($row["usertype"] == "user") {
            header("location:user/user_home.php");
        } elseif ($row["usertype"] == "admin") {
            header("location:admin/admin_home.php");
        } else {
            echo "Incorrect username or password";
        }
    }
}
?>
!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            text-align: center;
            background-image: url('images/sky.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #fff;
            margin-top: 50px;
        }

        #login {
            background-color: rgba(255, 255, 255, 0.8);
            width: 500px;
            height: 300px;
            margin: 0 auto;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type='submit'] {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        p {
            color: #333;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <br>
    <h1>When in doubt, travel</h1>
    <br>
    <h1>Login</h1>
    <div id="login">
        <form action="" method="post">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <input type="submit" name="login" value="Login">
            </div>
            <div>
                <p>New User? <a href="register.php">Register here</a></p>
            </div>
        </form>
    </div>
</body>
</html>
