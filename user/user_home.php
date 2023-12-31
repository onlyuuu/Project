<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Home</title>
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
<h2>Welcome to Your User Dashboard</h2>

<ul>
    <li>
        <a href="search_flights.php">
            Search Flights
        </a>
    </li>
    <li>
        <a href="booking.php">
            Book Tickets
        </a>
    </li>
    <li>
        <a href="e_checkin_request.php">
            E-CheckIn
        </a>
    </li>
</ul>
</body>
</html>
