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
    echo "<html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>User Bookings</title>
    </head>
    <body>
        <h2>User Bookings</h2>
        <table border='1'>
            <tr>
                <th>Booking ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>From City</th>
                <th>To City</th>
                <th>Date</th>
                <th>Number of Tickets</th>
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

    echo "</table>
    </body>
    </html>";
} else {
    echo "Error: " . mysqli_error($data);
}

mysqli_close($data);
?>
