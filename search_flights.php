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

function getAirlineName($airlineId) {
    switch ($airlineId) {
        case 1:
            return 'Haloha';
        case 2:
            return 'Fly Intercity';
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = mysqli_real_escape_string($data, $_POST["date"]);
    $fromAirport = mysqli_real_escape_string($data, $_POST["fromAirport"]);
    $toAirport = mysqli_real_escape_string($data, $_POST["toAirport"]);

    $query = "SELECT * FROM flights 
              WHERE departure_time >= '$date' 
              AND departure_airport_id = '$fromAirport' 
              AND arrival_airport_id = '$toAirport'";

    $result = mysqli_query($data, $query);

    if ($result) {
        echo "<table border ='1'>
        <tr>
        <th>From</th>
        <th>To</th>
        </tr>
        <tr>
        <td>" . getCityName($fromAirport) . "</td>
        <td>" . getCityName($toAirport) . "</td>
        </tr></table>";

        echo "<table border='1'>
                <tr>
                    <th>Flight ID</th>
                    <th>Flight Number</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Airline</th>
                    <th>Capacity</th>
                    <th>Date Effective</th>
                    <th>Action</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['flight_id']}</td>
                    <td>{$row['flight_number']}</td>
                    <td>{$row['departure_time']}</td>
                    <td>{$row['arrival_time']}</td>
                    <td>" . getAirlineName($row['airline_id']) . "</td>
                    <td>{$row['capacity']}</td>
                    <td>{$row['date']}</td>
                    <td><a href='book_ticket.php?flight_id={$row['flight_id']}'>Book</a></td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "Error: " . mysqli_error($data);
    }

    mysqli_close($data);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Flights</title>
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
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input, select {
            width: 50%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type='submit'] {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }
    </style>
</head>
<body>
    <h2>Search Flights</h2>
    <form action="" method="post">
        <label for="date">Select Date:</label>
        <input type="date" name="date" id="date" required>
        <br>

        <label for="fromAirport">Departure Airport:</label>
        <select name="fromAirport" id="fromAirport" required>
            <option value="1">Chennai</option>
            <option value="2">Bengaluru</option>
            <option value="3">Coimbatore</option>
        </select>
        <br>

        <label for="toAirport">Arrival Airport:</label>
        <select name="toAirport" id="toAirport" required>
            <option value="1">Chennai</option>
            <option value="2">Bengaluru</option>
            <option value="3">Coimbatore</option>
        </select>
        <br>

        <input type="submit" value="Search">
    </form>
</body>
</html>
