<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../db.php"); 

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $about = mysqli_real_escape_string($conn, $_POST['about']);
    $mail = mysqli_real_escape_string($conn, $_POST['mail']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $room_count = mysqli_real_escape_string($conn, $_POST['room']);
    $food_facility = mysqli_real_escape_string($conn, $_POST['food']);

    $uploaded_file_name = basename($_FILES["image"]["name"]);

    // Check if file is an image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Check if file already exists
        if (file_exists($uploaded_file_name)) {
            echo "Sorry, file already exists.";
        } else {
            // Check file size (adjust as needed)
            if ($_FILES["image"]["size"] > 10000000) {
                echo "Sorry, your file is too large.";
            } else {
                // Allow only certain file formats
                $allowed_extensions = array("jpg", "jpeg", "png", "gif");
                $imageFileType = strtolower(pathinfo($uploaded_file_name, PATHINFO_EXTENSION));
                if (in_array($imageFileType, $allowed_extensions)) {
                    // Move the uploaded file to the specified directory
                    $imageData = $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $imageData);
                    $sql = "INSERT INTO hotel (name, about, image, mail, phone, seating_capacity, table_count, menu)
                            VALUES ('$name', '$about', '$uploaded_file_name', '$mail', '$phone', '$seating_capacity', '$table_count', '$menu')";
                    if (mysqli_query($conn, $sql)) {
                        echo "Records inserted successfully.";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                } else {
                    echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
                }
            }
        }
    } else {
        echo "File is not an image.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
