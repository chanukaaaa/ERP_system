<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "assignment";

//database connection
$connection = new mysqli( $servername, $username, $password, $database);


$item_code = "";
$item_category = "";
$item_subcategory = "";
$item_name = "";
$quantity = "";
$unit_price = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_code = $_POST["item_code"];
    $item_category = $_POST["item_category"];
    $item_subcategory = $_POST["item_subcategory"];
    $item_name = $_POST["item_name"];
    $quantity = $_POST["quantity"];
    $unit_price = $_POST["unit_price"];

    do {
        if (empty($item_code) || empty($item_category) || empty($item_subcategory) || empty($item_name) || empty($quantity) || empty($unit_price)) {
            $errorMessage = "All the fields are required!";
            break;
        }

        // Add new item to the database 
        $sql = "INSERT INTO item (item_code, item_category, item_subcategory, item_name, quantity, unit_price)" .
        "VALUES ('$item_code', '$item_category', '$item_subcategory', '$item_name', '$quantity', '$unit_price')";
        $result = $connection->query($sql);

        if (!$result) {
        $errorMessage = "Invalid Query: " . $connection->error;
        break;
        }

        // Assuming the item is successfully added:
        $item_code = "";
        $item_category = "";
        $item_subcategory = "";
        $item_name = "";
        $quantity = "";
        $unit_price = "";

        $successMessage = "Successfully added the Item!";

        header("location:/assignment/displayItem.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5" >
        <h2>Add New Item</h2>

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
                <button type="submit" class="btn btn-outline-primary">Submit</button>
                <a class="btn btn-primary" href="/assignment/displayItem.php" role="button">Back</a>
            </div>
        </form>
    </div>
</body>
</html>
