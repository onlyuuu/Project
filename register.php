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
    if (isset($_POST["register"])) {
        $regUsername = $_POST["reg_username"];
        $regPassword = $_POST["reg_password"];
        $confirmPassword = $_POST["confirm_password"];
        $userType = $_POST["user_type"];
        $securityKey = isset($_POST["security_key"]) ? $_POST["security_key"] : "";

        if ($userType === "admin" && $securityKey !== "ADMIN123") {
            echo "Invalid security key for admin registration.";
        } elseif ($regPassword !== $confirmPassword) {
            echo "Passwords do not match.";
        } else {
            $regSql = "INSERT INTO login (username, password, usertype) VALUES ('" . $regUsername . "', '" . $regPassword . "', '" . $userType . "')";
            mysqli_query($data, $regSql);

            echo "Registration successful!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        body {
            bottom: 200px;
            text-align: center;
            background-image: url('images/background.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
        }

        #registration {
            background-color: rgba(255, 255, 255, 0.8);
            width: 500px;
            height: 300px;
            margin: 0 auto;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Register</h1>
    <br>
    <div id="registration">
        <form action="" method="post">
            <div>
                <label for="reg_username">Username</label>
                <input type="text" name="reg_username" id="reg_username" required>
            </div>
            <br>
            <div>
                <label for="reg_password">Password</label>
                <input type="password" name="reg_password" id="reg_password" required>
            </div>
            <br>
            <div>
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <br>
            <div>
                <label for="user_type">User Type</label>
                <select name="user_type" id="user_type" onchange="showSecurityKeyInput(this.value)">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <br>
            <div id="securityKeyContainer" style="display: none;">
                <label for="security_key">Security Key</label>
                <input type="text" name="security_key" id="security_key">
            </div>
            <br>
            <div>
                <input type="submit" name="register" value="Register">
            </div>
        </form>
        <div>
            <p>Login? <a href="login.php">Click here</a></p>
        </div>
    </div>

    <script>
        function showSecurityKeyInput(userType) {
            var securityKeyContainer = document.getElementById("securityKeyContainer");

            if (userType === "admin") {
                securityKeyContainer.style.display = "block";
            } else {
                securityKeyContainer.style.display = "none";
            }
        }
    </script>
</body>
</html>
