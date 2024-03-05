<?php
include '../db.php'; // Include your database connection file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $count = $_POST['count'];
    $restaurant_id = $_POST['options']; // Assuming you named your hotel selection dropdown 'options'
    $date_in = $_POST['date_in'];
    $time_in = $_POST['time_in'];
    
    function generateUniqueBookingId($conn)
    {
        $booking_id = '';

        // Check if the number already exists in the database
        $query = "SELECT MAX(booking_id) as max_id FROM restaurant_bookings";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $max_id = $row['max_id'];

        // Generate a 10-digit random number
        do {
            $random_number = mt_rand(1,10000);
        } while ($random_number == $max_id);

        $booking_id = $random_number;

        return $booking_id;
    }



    function generateUniqueTableNo($conn, $restaurant_id)
    {
        $unique = false;
        $room_no = '';

        $query = "SELECT table_count FROM restaurant WHERE id = $restaurant_id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $max_room_count = $row['table_count'];

            // Check if the number already exists in the database
            $query = "SELECT table_no FROM restaurant_bookings WHERE id = $restaurant_id";
            $result = mysqli_query($conn, $query);

            while (!$unique) {
                $random_number = mt_rand(1, $max_room_count);

                if (!$result || mysqli_num_rows($result) == 0) {
                    // If no bookings yet, return the random number
                    $unique = true;
                    $room_no = $random_number;
                } else {
                    // Check if the random number already exists in the database
                    $exists = false;
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['table_no'] == $random_number) {
                            $exists = true;
                            break;
                        }
                    }

                    if (!$exists) {
                        // If the random number doesn't exist, return it
                        $unique = true;
                        $room_no = $random_number;
                    }
                }
            }
        } else {
            // Error getting the maximum room count
            echo "Error: Unable to retrieve maximum room count for the hotel.";
        }

        return $room_no;
    }

    for($i=0;$i<10;$i++){
        $id = generateUniqueBookingId($conn);
    }
    $table = generateUniqueTableNo($conn, $restaurant_id);

    // SQL to insert data into the table
    $sql = "INSERT INTO restaurant_bookings (booking_id, name, phone, table_no, checkin, id, seat_count, date)
            VALUES ('$id', '$name', '$phone', '$table', '$time_in', '$restaurant_id', $count, '$date_in')";

    // Execute SQL query
    if (mysqli_query($conn, $sql)) {
        $sql = "select name from restaurant where id=$restaurant_id";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        echo '<head>
        <style>
            .home-btn {
                background-color: #4CAF50;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
                border-radius: 10px;
                transition: background-color 0.3s ease;
            }

            .home-btn:hover {
                background-color: #ffa049;
            }
        </style>
        </head>';
        echo '<div style="background: linear-gradient(to right, #ff7e5f, #feb47b); padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">';
        echo '<h2 style="color: #fff; text-align: center; font-size: 24px; margin-bottom: 20px;">Thanks for booking with us!</h2>';
        echo "<p style='color: #fff; text-align: center; font-size: 18px;'>We've reserved your booking at ".$row["name"].", table number: $table for $count people. Your booking id is $id. Please show this id at the reception to get your table.</p>";
        echo '<div style="text-align: center; margin-top: 20px;">';
        echo '<a href="../index.php" class="btn btn-primary home-btn">Home</a>';
        echo '</div>';
        echo '</div>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>