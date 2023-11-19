<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
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

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            display: inline-block;
            margin: 10px;
        }

        a {
            text-decoration: none;
            color: #555;
            font-size: 18px;
            display: block;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #ddd;
        }

    </style>
</head>
<body>
    <h2>Welcome, Admin!</h2>

    <h3>Services</h3>
    <ul>
        <li>
            <a href="admin/add_flight.php">Add Flights</a>
        </li>
        <li>
            <a href="admin/view_bookings.php">View Booking Details</a>
        </li>
        <li>
            <a href="admin/admin_e_checkin.php">E-CheckIn</a>
        </li>
    </ul>
</body>
</html>
