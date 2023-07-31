<?php
// Error reporting 
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "assignment";

    // Database connection
    $connection = new mysqli($servername, $username, $password, $database);

    // Check if the provided ID is a valid integer
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        header("location: /assignment/displayCustomer.php");
        exit;
    }

    // Prepare DELETE query using a prepared statement
    $sql = "DELETE FROM customer WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Successful deletion
        $stmt->close();
        $connection->close();
        header("location: /assignment/displayCustomer.php");
        exit;
    } else {
        // Failed to delete the customer
        $stmt->close();
        $connection->close();
        header("location: /assignment/displayCustomer.php?error=delete_failed");
        exit;
    }
} else {
    header("location: /assignment/displayCustomer.php");
    exit;
}
?>
