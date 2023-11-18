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
    $flightNumber = mysqli_real_escape_string($data, $_POST["flightNumber"]);
    $departureAirport = mysqli_real_escape_string($data, $_POST["departureAirport"]);
    $arrivalAirport = mysqli_real_escape_string($data, $_POST["arrivalAirport"]);
    $departureTime = mysqli_real_escape_string($data, $_POST["departureTime"]);
    $arrivalTime = mysqli_real_escape_string($data, $_POST["arrivalTime"]);
    $airlineId = mysqli_real_escape_string($data, $_POST["airlineId"]);
    $capacity = mysqli_real_escape_string($data, $_POST["capacity"]);
    $date = mysqli_real_escape_string($data, $_POST["date"]);

    $insertQuery = "INSERT INTO flights (flight_number, departure_airport_id, arrival_airport_id, departure_time, arrival_time, airline_id, capacity, date)
                    VALUES ('$flightNumber', '$departureAirport', '$arrivalAirport', '$departureTime', '$arrivalTime', '$airlineId', '$capacity', '$date')";
    $insertResult = mysqli_query($data, $insertQuery);

    if ($insertResult) {
        echo "Flight added successfully!";
    } else {
        echo "Error adding flight: " . mysqli_error($data);
    }
}

mysqli_close($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Flights</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin: 10px 0;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
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
    <h2>Add Flights</h2>
    <form action="" method="post">
        <label for="flightNumber">Flight Number</label>
        <input type="text" name="flightNumber" required>

        <label for="departureAirport">Departure Airport</label>
        <input type="text" name="departureAirport" required>

        <label for="arrivalAirport">Arrival Airport</label>
        <input type="text" name="arrivalAirport" required>

        <label for="departureTime">Departure Time</label>
        <input type="datetime-local" name="departureTime" required>

        <label for="arrivalTime">Arrival Time</label>
        <input type="datetime-local" name="arrivalTime" required>

        <label for="airlineId">Airline ID</label>
        <input type="number" name="airlineId" required>

        <label for="capacity">Capacity</label>
        <input type="number" name="capacity" required>

        <label for="date">Date</label>
        <input type="date" name="date" required>

        <input type="submit" value="Add Flight">
    </form>
</body>
</html>
