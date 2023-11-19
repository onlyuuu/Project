<?php
function getCityName($cityCode) {
    switch ($cityCode) {
        case 1:
            return 'Chennai';
        case 2:
            return 'Bengaluru';
        case 3:
            return 'Coimbatore';
        default:
            return 'Unknown';
    }
}

$host = "localhost";
$user = "root";
$password = "";
$db = "project";

$data = mysqli_connect($host, $user, $password, $db);

if ($data == false) {
    die("Connection failed: " . mysqli_connect_error());
}

$receiptMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = mysqli_real_escape_string($data, $_POST["date"]);
    $fromAirport = mysqli_real_escape_string($data, $_POST["fromAirport"]);
    $toAirport = mysqli_real_escape_string($data, $_POST["toAirport"]);
    $numTickets = mysqli_real_escape_string($data, $_POST["numTickets"]);
    $name = mysqli_real_escape_string($data, $_POST["name"]);
    $age = mysqli_real_escape_string($data, $_POST["age"]);
    $email = mysqli_real_escape_string($data, $_POST["email"]);
    $mobile = mysqli_real_escape_string($data, $_POST["mobile"]);

    $checkQuery = "SELECT * FROM flights 
                   WHERE date = '$date' 
                   AND departure_airport_id = '$fromAirport' 
                   AND arrival_airport_id = '$toAirport'";
    $checkResult = mysqli_query($data, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        $flightData = mysqli_fetch_assoc($checkResult);
        $availableTickets = $flightData['capacity'];

        if ($availableTickets >= $numTickets) {
            $updateQuery = "UPDATE flights 
                            SET capacity = capacity - $numTickets 
                            WHERE date = '$date' 
                            AND departure_airport_id = '$fromAirport' 
                            AND arrival_airport_id = '$toAirport'";
            $updateResult = mysqli_query($data, $updateQuery);

            if ($updateResult) {
                $insertUserQuery = "INSERT INTO user_bookings (name, age, email, mobile, from_city, to_city, date, num_tickets)
                                    VALUES ('$name', '$age', '$email', '$mobile', '$fromAirport', '$toAirport', '$date', '$numTickets')";
                $insertUserResult = mysqli_query($data, $insertUserQuery);

                if ($insertUserResult) {
                    $receiptMessage = "Ticket(s) booked successfully!\n\n";
                    $receiptMessage .= "Name: $name\n";
                    $receiptMessage .= "Age: $age\n";
                    $receiptMessage .= "Email: $email\n";
                    $receiptMessage .= "Mobile: $mobile\n";
                    $receiptMessage .= "Date: $date\n";
                    $receiptMessage .= "Departure Airport: " . getCityName($fromAirport) . "\n";
                    $receiptMessage .= "Arrival Airport: " . getCityName($toAirport) . "\n";
                    $receiptMessage .= "Number of Tickets: $numTickets\n";

                    echo "<pre>$receiptMessage</pre>";
                } else {
                    echo "Error storing user information: " . mysqli_error($data);
                }
            } else {
                echo "Error updating available tickets: " . mysqli_error($data);
            }
        } else {
            echo "Not enough available tickets for the selected flight. Please choose a lower quantity or try on some other date.";
        }
    } else {
        echo "Invalid flight details";
    }
}

mysqli_close($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Ticket</title>
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
            margin-top: 20px;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input, select {
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

        pre {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Book a Ticket</h2>
    <form action="" method="post">
        <label for="date">Select Date</label>
        <input type="date" name="date" id="date" required>
        <br>
        <label for="fromAirport">Departure Airport</label>
        <select name="fromAirport" id="fromAirport" required>
            <option value="1">Chennai</option>
            <option value="2">Bengaluru</option>
            <option value="3">Coimbatore</option>
        </select>
        <br>
        <label for="toAirport">Arrival Airport</label>
        <select name="toAirport" id="toAirport" required>
            <option value="1">Chennai</option>
            <option value="2">Bengaluru</option>
            <option value="3">Coimbatore</option>
        </select>
        <br>
        <label for="numTickets">Number of Tickets</label>
        <input type="number" name="numTickets" id="numTickets" required>
        <br>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="age">Age</label>
        <input type="number" name="age" id="age" required>
        <br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="mobile">Mobile</label>
        <input type="tel" name="mobile" id="mobile" required>
        <br>
        <input type="submit" value="Book Now">
    </form>
</body>
</html>
