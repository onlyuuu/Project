<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "project";

$data = mysqli_connect($host, $user, $password, $db);

if ($data == false) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["approve"])) {
    $checkinId = mysqli_real_escape_string($data, $_POST["checkin_id"]);

    $updateQuery = "UPDATE e_checkin SET status = 'Approved' WHERE checkin_id = '$checkinId'";
    $updateResult = mysqli_query($data, $updateQuery);

    if (!$updateResult) {
        echo "Error updating status: " . mysqli_error($data);
    }
}

$query = "SELECT * FROM e_checkin";
$result = mysqli_query($data, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin E-Checkin</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 50px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            display: inline;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Admin E-Checkin</h2>
    <table>
        <tr>
            <th>Checkin ID</th>
            <th>Booking ID</th>
            <th>Passenger Name</th>
            <th>Age</th>
            <th>Departure</th>
            <th>Arrival</th>
            <th>Baggage Weight</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['checkin_id']}</td>
                    <td>{$row['booking_id']}</td>
                    <td>{$row['passenger_name']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['departure']}</td>
                    <td>{$row['arrival']}</td>
                    <td>{$row['baggage_weight']}</td>
                    <td>{$row['status']}</td>
                    <td>
                        <form method='post'>
                            <input type='hidden' name='checkin_id' value='{$row['checkin_id']}'>
                            <button type='submit' name='approve'>Approve</button>
                        </form>
                    </td>
                </tr>";
        }
        ?>

    </table>
</body>
</html>
