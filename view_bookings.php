<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "project";

$data = mysqli_connect($host, $user, $password, $db);

if ($data == false) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM user_bookings";
$result = mysqli_query($data, $query);

if ($result) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>View Bookings</title>
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
        </style>
    </head>
    <body>
        <h2>View Bookings</h2>
        <table>
            <tr>
                <th>Booking ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>From City</th>
                <th>To City</th>
                <th>Date</th>
                <th>Num Tickets</th>
                <th>Booking Time</th>
            </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['booking_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['age']}</td>
                <td>{$row['email']}</td>
                <td>{$row['mobile']}</td>
                <td>{$row['from_city']}</td>
                <td>{$row['to_city']}</td>
                <td>{$row['date']}</td>
                <td>{$row['num_tickets']}</td>
                <td>{$row['booking_time']}</td>
              </tr>";
    }

    echo "</table></body></html>";
} else {
    echo "Error: " . mysqli_error($data);
}

mysqli_close($data);
?>
