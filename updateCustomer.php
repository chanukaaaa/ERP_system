<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "assignment";

// Database connection
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$title = "";
$first_name = "";
$last_name = "";
$contact_no = "";
$district = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && !empty($_POST["id"]) && is_numeric($_POST["id"])) {
        $id = $_POST["id"];
    } else {
        header("location: /assignment/displayCustomer.php");
        exit;
    }

    // Ensure the required form fields are set
    if (
        isset($_POST["title"]) &&
        isset($_POST["first_name"]) &&
        isset($_POST["last_name"]) &&
        isset($_POST["contact_no"]) &&
        isset($_POST["district"])
    ) {
        $title = $_POST["title"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $contact_no = $_POST["contact_no"];
        $district = $_POST["district"];

        

        // Prepare the update query using prepared statements
        $sql = "UPDATE customer " .
            "SET title = ?, first_name = ?, last_name = ?, contact_no = ?, district = ? " .
            "WHERE id = ?";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssssi", $title, $first_name, $last_name, $contact_no, $district, $id);

        if ($stmt->execute()) {
            $successMessage = "Successfully updated the customer!";
            // Redirect to the index page after successful update
            header("location: /assignment/displayCustomer.php");
            exit;
        } else {
            $errorMessage = "Failed to update the customer: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        $errorMessage = "All the fields are required!";
    }
}

// Read data
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM customer WHERE id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /assignment/displayCustomer.php");
        exit;
    }

    $title = $row["title"];
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $contact_no = $row["contact_no"];
    $district = $row["district"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Update Customer</h2>

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
                <label for="title">Title:</label>
                <select class="form-control" id="title" name="title" value="<?php echo $title; ?>">
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
            <label for="district">District:</label>
                <select class="form-control" id="district" name="district" value="<?php echo $contact_no; ?>">
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
                <button type="submit" class="btn btn-outline-primary">Update</button>
            </div>
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

            
        </form>
    </div>
</body>
</html>

