<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "assignment";

//database connection
$connection = new mysqli($servername, $username, $password, $database);

$title = "";
$first_name = "";
$last_name = "";
$contact_no = "";
$district = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $contact_no = $_POST["contact_no"];
    $district = $_POST["district"];

    do {
        if (empty($title) || empty($first_name) || empty($last_name) || empty($contact_no) || empty($district)) {
            $errorMessage = "All the fields are required!";
            break;
        }

        // Add new customer to the database 
        $sql = "INSERT INTO customer (title, first_name, last_name, contact_no, district)" .
               "VALUES ('$title', '$first_name', '$last_name', '$contact_no', '$district')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid Query: " . $connection->error;
            break;
        }

        // Assuming the customer is successfully added:
        $title = "";
        $first_name = "";
        $last_name = "";
        $contact_no = "";
        $district = "";

        $successMessage = "Successfully added the customer!";

        header("location:/assignment/displayCustomer.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Add New Customer</h2>

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
                <label for="title">Title:</label>
                <select class="form-control" id="title" name="title">
                    <option value="Mr" <?php if ($title === 'Mr') echo 'selected'; ?>>Mr</option>
                    <option value="Mrs" <?php if ($title === 'Mrs') echo 'selected'; ?>>Mrs</option>
                    <option value="Miss" <?php if ($title === 'Miss') echo 'selected'; ?>>Miss</option>
                    <option value="Dr" <?php if ($title === 'Dr') echo 'selected'; ?>>Dr</option>
                </select>
            </div>

            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name" value="<?php echo $first_name; ?>">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" value="<?php echo $last_name; ?>">
            </div>
            <div class="form-group">
                <label for="contact_no">Contact Number:</label>
                <input type="number" class="form-control" id="contact_no" placeholder="Enter Contact Number" name="contact_no" value="<?php echo $contact_no; ?>">
            </div>
            <div class="form-group">
                <label for="district">District:</label>
                <select class="form-control" id="district" name="district">
                    <?php
                    $sql = "SELECT id, district FROM district";
                    $result = $connection->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        $districtId = $row['id'];
                        $districtName = $row['district'];
                        $selected = ($district === $districtId) ? 'selected' : '';
                        echo "<option value=\"$districtId\" $selected>$districtName</option>";
                    }
                    ?>
                </select>
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
                <a class="btn btn-primary" href="/assignment/displayCustomer.php" role="button">Back</a>
            </div>
        </form>
    </div>
</body>
</html>
