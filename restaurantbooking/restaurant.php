<!doctype html>
<html lang="en">

<head>
    <title>Restaurant Booking</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="book.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <div class="formbold-main-wrapper">
        <div class="formbold-form-wrapper">
            <h1 style="text-align: center;">Restaurant Booking</h1>
            <form action="booking.php" method="POST">
                <div class="formbold-mb-5">
                    <label for="name" class="formbold-form-label">Full Name</label>
                    <input type="text" name="name" id="name" placeholder="Full Name" class="formbold-form-input"
                        required>
                </div>
                <div class="formbold-mb-5">
                    <label for="phone" class="formbold-form-label">Phone Number</label>
                    <input type="text" name="phone" id="phone" placeholder="Enter your phone number"
                        class="formbold-form-input" required>
                </div>
                <div class="formbold-mb-5">
                    <label for="count" class="formbold-form-label">Number of Seats</label>
                    <input type="text" name="count" id="count" placeholder="Enter number of seats"
                        class="formbold-form-input" required>
                </div>
                <?php
                    include '../db.php';

                    $query = "SELECT id, name FROM restaurant where verified = 1";
                    $result = mysqli_query($conn, $query);

                    // Check if query was successful
                    if ($result) {
                        // Start generating the dropdown menu
                        echo '<div style="padding-top: 20px;"></div>';
                        echo '<select name="options" id="options" class="formbold-form-input">';
                        echo '<option value="">Select the Restaurant</option>';

                        // Loop through the results and generate options
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                        }

                        // Close the select tag
                        echo '</select>';
                    } else {
                        // Query failed
                        echo 'Failed to fetch options from the database.';
                    }
                ?>
                <div class="flex flex-wrap formbold--mx-3" style="padding-top: 20px;">
                    <div class="w-full sm:w-half formbold-px-3">
                        <div class="formbold-mb-5 w-full">
                            <label for="date" class="formbold-form-label">Date</label>
                            <input type="date" name="date_in" id="date" class="formbold-form-input" required>
                        </div>
                    </div>
                    <div class="w-full sm:w-half formbold-px-3">
                        <div class="formbold-mb-5">
                            <label for="time" class="formbold-form-label">Check-in Time</label>
                            <input type="time" name="time_in" id="time" placeholder="Time" class="formbold-form-input"
                                required>
                        </div>
                    </div>
                </div>
                <div>
                    <button class="formbold-btn" type="submit">Book Table</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script>
        var seat_count = document.getElementById('count');
        seat_count.addEventListener('input', function(){
            if(seat_count.value <= 0 || seat_count.value == ''){
                alert('Seat count should be greater than 0');
                seat_count.value = '';
            }
            else if(seat_count.value > 4){
                alert('You can only book upto 4 seats at a time');
                seat_count.value = '';
            }
        });
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


</body>

</html>