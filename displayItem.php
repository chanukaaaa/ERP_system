<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Item List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container my-5">
    <h2>Item Data List</h2>
    <br>
    <div>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #d3d3f5;">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link "href="/assignment/displayCustomer.php">Customer List </a>
            <a class="nav-item nav-link active" href="/assignment/displayItem.php">Item List <span class="sr-only"></span></a>
            <a class="nav-item nav-link" href="/assignment/displayInvoiceReport.php">Invoice Report</a>
            <a class="nav-item nav-link" href="/assignment/displayInvoiceItemReport.php">Invoice Item Report</a>
            <a class="nav-item nav-link" href="/assignment/displayItemReport.php">Item Report</a>
          </div>
        </div>
      </nav>
    </div>

    <br>
    <a class="btn btn-primary" href="/assignment/createItem.php" role="button">Add new Item</a>

    <br>

    <!-- Refresh Button -->
    <a class="btn btn-secondary my-3" href="/assignment/displayItem.php">Refresh</a>

    <!-- Search Form -->
    <form method="get" action="/assignment/displayItem.php">
      <div class="input-group my-3">
        <input type="text" class="form-control" placeholder="Search by Item Code" name="search">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
      </div>
    </form>

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Item Code</th>
          <th>Item Category</th>
          <th>Item Sub-Category</th>
          <th>Item Name</th>
          <th>Quantity</th>
          <th>Unit Price($)</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "assignment";

        //database connection
        $connection = new mysqli( $servername, $username, $password, $database);
        
        //check connection
        if ($connection -> connect_error){
          die("Connection Failed: ". $connection->connect_error);
        }

        // Search functionality
        $searchKeyword = "";
        if (isset($_GET['search']) && !empty($_GET['search'])) {
          $searchKeyword = $_GET['search'];
          $sql = "SELECT id, item_code, item_category, item_subcategory, item_name, quantity, unit_price FROM item WHERE item_code LIKE ?";
          $stmt = $connection->prepare($sql);
          $searchParam = "%$searchKeyword%";
          $stmt->bind_param("s", $searchParam); 
        } else {
          $sql = "SELECT id, item_code, item_category, item_subcategory, item_name, quantity, unit_price FROM item";
          $stmt = $connection->prepare($sql);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
          echo "
          <tr>
          <td>{$row['id']}</td>
          <td>{$row['item_code']}</td>
          <td>{$row['item_category']}</td>
          <td>{$row['item_subcategory']}</td>
          <td>{$row['item_name']}</td>
          <td>{$row['quantity']}</td>
          <td>{$row['unit_price']}</td>
          <td>
          <a class='btn btn-primary btn-sm' href='/assignment/updateItem.php?id={$row['id']}'>Edit</a>
          <a class='btn btn-danger btn-sm' href='/assignment/deleteItem.php?id={$row['id']}'>Delete</a>
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
