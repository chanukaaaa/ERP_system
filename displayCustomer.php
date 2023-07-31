<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container my-5">
    <h2>Customer Data List</h2>
    <br>

    <div>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #d3d3f5;">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active"href="/assignment/displayCustomer.php">Customer List <span class="sr-only"></span></a>
            <a class="nav-item nav-link" href="/assignment/displayItem.php">Item List</a>
            <a class="nav-item nav-link" href="/assignment/displayInvoiceReport.php">Invoice Report</a>
            <a class="nav-item nav-link" href="/assignment/displayInvoiceItemReport.php">Invoice Item Report</a>
            <a class="nav-item nav-link" href="/assignment/displayItemReport.php">Item Report</a>
          </div>
        </div>
      </nav>
    </div>

    <br>

    <a class="btn btn-primary" href="/assignment/createCustomer.php" role="button">Add new Customer</a>

    <br>

    <!-- Refresh Button -->
    <a class="btn btn-secondary my-3" href="/assignment/displayCustomer.php">Refresh</a>

    <!-- Search Form -->
    <form method="get" action="/assignment/displayCustomer.php">
      <div class="input-group my-3">
        <input type="text" class="form-control" placeholder="Search by First Name, Last Name, or District" name="search">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
      </div>
    </form>

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Contact Number</th>
          <th>District</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "assignment";

        //database connection
        $connection = new mysqli($servername, $username, $password, $database);

        //check connection
        if ($connection->connect_error) {
          die("Connection Failed: " . $connection->connect_error);
        }

        // Search functionality
        $searchKeyword = "";
        if (isset($_GET['search']) && !empty($_GET['search'])) {
          $searchKeyword = $_GET['search'];
          $sql = "SELECT c.id, c.title, c.first_name, c.last_name, c.contact_no, d.district 
                  FROM customer c
                  JOIN district d ON c.district = d.id
                  WHERE c.first_name LIKE ? OR c.last_name LIKE ? OR d.district LIKE ?";
          $stmt = $connection->prepare($sql);
          $searchParam = "%$searchKeyword%";
          $stmt->bind_param("sss", $searchParam, $searchParam, $searchParam);
        } else {
          $sql = "SELECT c.id, c.title, c.first_name, c.last_name, c.contact_no, d.district 
                  FROM customer c
                  JOIN district d ON c.district = d.id";
          $stmt = $connection->prepare($sql);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
          echo "
          <tr>
            <td>{$row['id']}</td>
            <td>{$row['title']}</td>
            <td>{$row['first_name']}</td>
            <td>{$row['last_name']}</td>
            <td>{$row['contact_no']}</td>
            <td>{$row['district']}</td>
            <td>
              <a class='btn btn-primary btn-sm' href='/assignment/updateCustomer.php?id={$row['id']}'>Edit</a>
              <a class='btn btn-danger btn-sm' href='/assignment/deleteCustomer.php?id={$row['id']}'>Delete</a>
            </td>
          </tr>
          ";
        }

        ?>

      </tbody>
    </table>
  </div> 
</body>
</html>
