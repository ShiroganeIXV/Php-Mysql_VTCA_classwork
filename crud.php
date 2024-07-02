<?php
include 'db.php';

// Create
if(isset($_POST['create'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $home_address = $_POST['home_address'];
    $phone_number = $_POST['phone_number'];

    // Check if email already exists
    $emailCheckSql = "SELECT email FROM Lab05 WHERE email = '$email'";
    $emailCheckResult = $conn->query($emailCheckSql);

    if ($emailCheckResult->num_rows > 0) {
        // Email exists, handle accordingly
        echo "Email already exists. <a href='index.php'>Go back</a>";
        // Optionally, redirect back to the form or handle the error as needed
    } else {
        // Email does not exist, proceed with insertion
        $sql = "INSERT INTO Lab05 (fullname, email, home_address, phone_number) VALUES ('$fullname', '$email', '$home_address', '$phone_number')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            header('Location: index.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Update
if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $home_address = $_POST['home_address'];
    $phone_number = $_POST['phone_number'];

    $sql = "UPDATE Lab05 SET fullname='$fullname', email='$email', home_address='$home_address', phone_number='$phone_number' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header('Location: index.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Delete
if(isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM Lab05 WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header('Location: index.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Delete Selected
if(isset($_POST['deleteSelected'])) {
    $idsToDelete = $_POST['ids'] ?? [];

    if (!empty($idsToDelete)) {
        $idsToDelete = implode(',', array_map('intval', $idsToDelete));
        $sql = "DELETE FROM Lab05 WHERE id IN ($idsToDelete)";
        if ($conn->query($sql) === TRUE) {
            echo "Records deleted successfully";
            header('Location: index.php');
        } else {
            echo "Error deleting records: " . $conn->error;
        }
    }
}
?>

