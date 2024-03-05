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
        background-color: #45a049;
    }
</style>

<?php
include '../db.php'; // Include your database connection file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $hotel_id = $_POST['options']; // Assuming you named your hotel selection dropdown 'options'
    $date_in = $_POST['date_in'];
    $date_out = $_POST['date_out'];
    $time_in = $_POST['time_in'];
    $time_out = $_POST['time_out'];

    function generateUniqueBookingId($conn)
    {
        $booking_id = '';

        // Check if the number already exists in the database
        $query = "SELECT MAX(booking_id) as max_id FROM hotel_bookings";
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



    function generateUniqueRoomNo($conn, $hotel_id)
    {
        $unique = false;
        $room_no = '';

        // Get the maximum room count for the given hotel_id from the hotel table
        $query = "SELECT room FROM hotel WHERE id = $hotel_id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $max_room_count = $row['room'];

            // Check if the number already exists in the database
            $query = "SELECT room FROM hotel_bookings WHERE id = $hotel_id";
            $result = mysqli_query($conn, $query);

            // Generate a random room number within the maximum room count range
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
                        if ($row['room'] == $random_number) {
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
    $room = generateUniqueRoomNo($conn, $hotel_id);

    // SQL to insert data into the table
    $sql = "INSERT INTO hotel_bookings (booking_id, name, phone, room, checkin, checkout, id, date_in, date_out)
            VALUES ('$id', '$name', '$phone', '$room', '$time_in', '$time_out', '$hotel_id', '$date_in', '$date_out')";

    // Execute SQL query
    if (mysqli_query($conn, $sql)) {
        $sql = "select name from hotel where id=$hotel_id";
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
        echo "<p style='color: #fff; text-align: center; font-size: 18px;'>We've reserved a room at ".$row["name"].", room number: $room. Your booking id is $id. Please show this id at the reception to get your room.</p>";
        echo '<div style="text-align: center; margin-top: 20px;">';
        echo '<a href="../index.php" class="btn btn-primary home-btn">Home</a>';
        echo '</div>';
        echo '</div>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>