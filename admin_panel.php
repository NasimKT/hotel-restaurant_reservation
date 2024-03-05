<?php
include("db.php");
session_start();
if (!isset($_SESSION["admin"])) {
    echo "
    <script>
        window.location.href = 'admin_login.html';
    </script>
    ";
}

$sqlHotel = "SELECT * FROM hotel";
$hotel = $conn->query($sqlHotel);
$sqlRestaurant = "SELECT * FROM restaurant";
$restaurant = $conn->query($sqlRestaurant);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#hotelRegistrations">Hotel Registrations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#restaurantRegistrations">Restaurant Registrations</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div id="hotelRegistrations" class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">Hotel Registrations</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>About</th>
                                        <th>Image</th>
                                        <th>E-Mail</th>
                                        <th>Phone</th>
                                        <th>Room Count</th>
                                        <th>Food Facility</th>
                                        <th>Verified</th>
                                        <th>Action</th> <!-- New column for Delete button -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Display hotel registrations
                                    if ($hotel->num_rows > 0) {
                                        while ($row = $hotel->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["id"] . "</td>";
                                            echo "<td>" . $row["name"] . "</td>";
                                            echo "<td>" . $row["about"] . "</td>";
                                            echo "<td><img src='uploads/" . $row["image"] . "' width='100%' height='100%'></td>";
                                            echo "<td>" . $row["mail"] . "</td>";
                                            echo "<td>" . $row["phone"] . "</td>";
                                            echo "<td>" . $row["room"] . "</td>";
                                            echo "<td>" . ($row["food"] ? "Yes" : "No") . "</td>"; // Assuming 'food' column is boolean (1 or 0)
                                            echo "<td>" . ($row["verified"] ? "Yes" : "No") . "</td>"; // Assuming 'verified' column is boolean (1 or 0)
                                            echo "<td><button class='btn btn-success btn-sm' onclick='verifyHotelRow(" . $row["id"] . ")'>" . ($row["verified"] ? "Unverify" : "Verify") . "</button><button class='btn btn-danger btn-sm' onclick='deleteHotelRow(" . $row["id"] . ")'>Delete</button></td>"; // Delete button
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='10'>No hotel registrations found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="restaurantRegistrations" class="row d-none">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">Restaurant Registrations</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>About</th>
                                        <th>Image</th>
                                        <th>E-Mail</th>
                                        <th>Phone</th>
                                        <th>Seating Capacity</th>
                                        <th>Table Count</th>
                                        <th>Menu</th>
                                        <th>Verified</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Display restaurant registrations
                                    if ($restaurant->num_rows > 0) {
                                        while ($row = $restaurant->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["id"] . "</td>";
                                            echo "<td>" . $row["name"] . "</td>";
                                            echo "<td>" . $row["about"] . "</td>";
                                            echo "<td><img src='uploads/" . $row["image"] . "' width='100%' height='100%'></td>";
                                            echo "<td>" . $row["mail"] . "</td>";
                                            echo "<td>" . $row["phone"] . "</td>";
                                            echo "<td>" . $row["seating_capacity"] . "</td>";
                                            echo "<td>" . $row["table_count"] . "</td>";
                                            echo "<td>" . $row["menu"] . "</td>";
                                            echo "<td>" . ($row["verified"] ? "Yes" : "No") . "</td>"; // Assuming 'verified' column is boolean (1 or 0)
                                            echo "<td><button class='btn btn-success btn-sm' onclick='verifyRow(" . $row["id"] . ")'>" . ($row["verified"] ? "Unverify" : "Verify") . "</button><button class='btn btn-danger btn-sm' onclick='deleteRow(" . $row["id"] . ")'>Delete</button></td>"; // Delete button
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='11'>No restaurant registrations found</td></tr>";
                                    }
                                    ?>

                                    <script>
                                        // Function to handle deletion of row
                                        function deleteRow(id) {
                                            if (confirm('Are you sure you want to delete this record?')) {
                                                // Send AJAX request to delete the row
                                                var xhttp = new XMLHttpRequest();
                                                xhttp.onreadystatechange = function() {
                                                    if (this.readyState == 4 && this.status == 200) {
                                                        // Reload the page after deletion
                                                        location.reload();
                                                    }
                                                };
                                                xhttp.open("GET", "delete_restaurant.php?id=" + id, true); // Assuming delete_restaurant.php handles the deletion
                                                xhttp.send();
                                            }
                                        }
                                    </script>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Function to handle verification of hotel row
        function verifyHotelRow(id) {
            // Send AJAX request to toggle the verification status for hotel
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Reload the page after toggling verification
                    location.reload();
                }
            };
            xhttp.open("GET", "verify_hotel.php?id=" + id, true); // Assuming verify_hotel.php handles the verification for hotel
            xhttp.send();
        }
    </script>
    <script>
        // Function to handle verification of row
        function verifyRow(id) {
            // Send AJAX request to toggle the verification status
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Reload the page after toggling verification
                    location.reload();
                }
            };
            xhttp.open("GET", "verify_restaurant.php?id=" + id, true); // Assuming verify_restaurant.php handles the verification
            xhttp.send();
        }
    </script>


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to handle deletion of row
        function deleteHotelRow(id) {
            if (confirm('Are you sure you want to delete this record?')) {
                // Send AJAX request to delete the row
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Reload the page after deletion
                        location.reload();
                    }
                };
                xhttp.open("GET", "./hotelregistration/delete.php?id=" + id, true); // Assuming delete.php handles the deletion
                xhttp.send();
            }
        }
    </script>
    <script>
        // Toggle between sections
        document.querySelectorAll('.navbar-nav .nav-link').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.row').forEach(function(row) {
                    row.classList.add('d-none');
                });
                document.querySelector(element.getAttribute('href')).classList.remove('d-none');
            });
        });
    </script>
</body>

</html>

<?php
// Close connection
$conn->close();
?>