<?php
// Include database connection
include('../db.php');

// Check if ID parameter is set and valid
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Escape user input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // SQL query to delete the record with the given ID
    $sql = "DELETE FROM hotel WHERE id = $id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the page with success message
        header("Location: admin_panel.php?delete_success=true");
        exit();
    } else {
        // Redirect back to the page with error message
        header("Location: admin_panel.php?delete_error=true");
        exit();
    }
} else {
    // Redirect back to the page with error message
    header("Location: admin_panel.php?delete_error=true");
    exit();
}

// Close database connection
$conn->close();
?>
