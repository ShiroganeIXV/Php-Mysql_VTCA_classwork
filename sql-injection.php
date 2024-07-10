<?php
include('db.php');

// execute query 
$user_input = $_GET['id'];

$sql = "SELECT * FROM users WHERE id = '$user_input'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();


?>