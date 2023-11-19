<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "project";

$data = mysqli_connect($host, $user, $password, $db);

if ($data == false) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingId = mysqli_real_escape_string($data, $_POST["bookingId"]);
    $passengerName = mysqli_real_escape_string($data, $_POST["passengerName"]);
    $baggageWeight = mysqli_real_escape_string($data, $_POST["baggageWeight"]);
    $age = mysqli_real_escape_string($data, $_POST["age"]);
    $fromCity = mysqli_real_escape_string($data, $_POST["fromCity"]);
    $toCity = mysqli_real_escape_string($data, $_POST["toCity"]);

    $insertQuery = "INSERT INTO e_checkin (booking_id, passenger_name, age, departure, arrival, baggage_weight, status)
                VALUES ('$bookingId', '$passengerName', '$age', '$fromCity', '$toCity', '$baggageWeight', 'Pending')";
    $insertResult = mysqli_query($data, $insertQuery);

    if ($insertResult) {
        echo "Check-in details successfully recorded!";
    } else {
        echo "Error recording check-in details: " . mysqli_error($data);
    }
}

mysqli_close($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Checkin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 50px;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        label {
            display: block;
            margin: 10px 0;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>E-Checkin</h2>
    <form action="" method="post">
        <label for="bookingId">Booking ID</label>
        <input type="text" name="bookingId" id="bookingId" required>
        <label for="passengerName">Passenger Name</label>
        <input type="text" name="passengerName" id="passengerName" required>
        <label for="baggageWeight">Baggage Weight</label>
        <input type="text" name="baggageWeight" id="baggageWeight" required>
        <label for="age">Age</label>
        <input type="text" name="age" id="age" required>
        <label for="fromCity">From City</label>
        <input type="text" name="fromCity" id="fromCity" required>
        <label for="toCity">To City</label>
        <input type="text" name="toCity" id="toCity" required>
        <input type="submit" value="Check-in">
    </form>
</body>
</html>
