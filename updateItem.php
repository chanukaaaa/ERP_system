<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "assignment";

// Database connection
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$item_code = "";
$item_category = "";
$item_subcategory = "";
$item_name = "";
$quantity = "";
$unit_price = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && !empty($_POST["id"]) && is_numeric($_POST["id"])) {
        $id = $_POST["id"];
    } else {
        header("location: /assignment/displayItem.php");
        exit;
    }

    // Ensure the required form fields are set
    if (
        isset($_POST["item_code"]) &&
        isset($_POST["item_category"]) &&
        isset($_POST["item_subcategory"]) &&
        isset($_POST["item_name"]) &&
        isset($_POST["quantity"])&&
        isset($_POST["unit_price"])
    ) {
        $item_code = $_POST["item_code"];
        $item_category = $_POST["item_category"];
        $item_subcategory = $_POST["item_subcategory"];
        $item_name = $_POST["item_name"];
        $quantity = $_POST["quantity"];
        $unit_price = $_POST["unit_price"];

        

        // Prepare the update query using prepared statements
        $sql = "UPDATE item " .
            "SET item_code = ?, item_category = ?, item_subcategory = ?, item_name = ?, quantity = ?, unit_price = ? " .
            "WHERE id = ?";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssiii", $item_code, $item_category, $item_subcategory, $item_name, $quantity, $unit_price, $id);

        if ($stmt->execute()) {
            $successMessage = "Successfully updated the Item!";
            // Redirect to the index page after successful update
            header("location: /assignment/displayItem.php");
            exit;
        } else {
            $errorMessage = "Failed to update the Item: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        $errorMessage = "All the fields are required!";
    }
}

// Read data
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM item WHERE id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /assignment/displayItem.php");
        exit;
    }

    $item_code = $row["item_code"];
    $item_category = $row["item_category"];
    $item_subcategory = $row["item_subcategory"];
    $item_name = $row["item_name"];
    $quantity = $row["quantity"];
    $unit_price = $row["unit_price"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Update Item</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong> $errorMessage </strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        

        <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
                <label for="item_code">Item Code:</label>
                <input type="text" class="form-control" id="item_code" placeholder="Enter Item Code" name="item_code" value="<?php echo $item_code; ?>">
            </div>
            <div class="form-group">
                <label for="item_category">Item Category:</label>
                <input type="text" class="form-control" id="item_category" placeholder="Enter Item Category" name="item_category" value="<?php echo $item_category; ?>">
            </div>
            <div class="form-group">
                <label for="item_subcategory">Item Sub-Category:</label>
                <input type="text" class="form-control" id="item_subcategory" placeholder="Enter Item Sub-Category" name="item_subcategory" value="<?php echo $item_subcategory; ?>">
            </div>
            <div class="form-group">
                <label for="item_name">Item Name:</label>
                <input type="text" class="form-control" id="item_name" placeholder="Enter Item Name" name="item_name" value="<?php echo $item_name; ?>">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" placeholder="Enter Quantity" name="quantity" value="<?php echo $quantity; ?>">
            </div>
            <div class="form-group">
                <label for="unit_price">Unit Price ($):</label>
                <input type="number" class="form-control" id="unit_price" placeholder="Enter Unit Price($)" name="unit_price" value="<?php echo $unit_price; ?>">
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong> $successMessage </strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
            ?>

            <div class="form-group">
                <button type="submit" class="btn btn-outline-primary">Update</button>
            </div>
        </form>
    </div>
</body>
</html>

