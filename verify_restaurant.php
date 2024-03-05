<?php
// Include database connection
include("db.php");

// Check if ID parameter is set and valid
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Escape user input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch the current verification status of the restaurant
    $sql = "SELECT verified FROM restaurant WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Toggle the verification status
        $newVerificationStatus = $row['verified'] ? 0 : 1;

        // Update the verification status in the database
        $updateSql = "UPDATE restaurant SET verified = $newVerificationStatus WHERE id = $id";
        if ($conn->query($updateSql) === TRUE) {
            // Return success response
            echo "Verification toggled successfully";
            exit();
        } else {
            // Return error response
            echo "Error toggling verification: " . $conn->error;
            exit();
        }
    } else {
        // Return error response if no row found
        echo "Restaurant not found";
        exit();
    }
} else {
    // Return error response if ID is not set or invalid
    echo "Invalid ID";
    exit();
}

// Close database connection
$conn->close();
?>
