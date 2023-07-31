<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice Item Report</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container my-5">
    <h2>Invoice Item Report</h2>
    <br>
    <div>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #d3d3f5;">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link "href="/assignment/displayCustomer.php">Customer List </a>
            <a class="nav-item nav-link" href="/assignment/displayItem.php">Item List</a>
            <a class="nav-item nav-link" href="/assignment/displayInvoiceReport.php">Invoice Report</a>
            <a class="nav-item nav-link active" href="/assignment/displayInvoiceItemReport.php">Invoice Item Report <span class="sr-only"></span></a>
            <a class="nav-item nav-link" href="/assignment/displayItemReport.php">Item Report</a>
          </div>
        </div>
      </nav>
    </div>

    <br>

    <!-- Refresh Button -->
    <a class="btn btn-secondary my-3" href="/assignment/displayInvoiceItemReport.php">Refresh</a>

    <!-- Search Form -->
    <form method="get" action="/assignment/displayInvoiceItemReport.php">
      <div class="input-group my-3">
        <!-- <input type="text" class="form-control" placeholder="Search by Invoice Number" name="search"> -->
        <input type="date" class="form-control" name="start_date" placeholder="Start Date">
        <input type="date" class="form-control" name="end_date" placeholder="End Date">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
      </div>
    </form>

    <table class="table">
      <thead>
        <tr>
          <th>Invoice Number</th>
          <th>Date</th>
          <th>Customer Name</th>
          <th>Item Name</th>
          <th>Item Code</th>
          <th>Item Category</th>
          <th>Unit Price ($)</th>
          <!-- <th>Action</th> -->
        </tr>
      </thead>
      <tbody>

        <?php
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
        $startDate = "";
        $endDate = "";

        if (isset($_GET['search']) && !empty($_GET['search'])) {
          $searchKeyword = $_GET['search'];
          $searchParam = "%$searchKeyword%";
          $sql = "SELECT i.invoice_no, i.date, c.first_name, c.last_name, t.item_name, t.item_code, t.item_category, t.unit_price 
                  FROM invoice i
                  JOIN customer c ON i.customer = c.id
                  JOIN item t ON i.item_count = t.id
                  WHERE i.invoice_no LIKE ? ";
          $stmtParams = array("s", &$searchParam);
        } else {
          $sql = "SELECT i.invoice_no, i.date, c.first_name, c.last_name, t.item_name, t.item_code, t.item_category, t.unit_price 
                  FROM invoice i
                  JOIN customer c ON i.customer = c.id
                  JOIN item t ON i.item_count = t.id";
          $stmtParams = array();
        }

        if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
          $startDate = $_GET['start_date'];
          $sql .= " AND i.date >= ? ";
          $stmtParams[] = &$startDate;
        }

        if (isset($_GET['end_date']) && !empty($_GET['end_date'])) {
          $endDate = $_GET['end_date'];
          $sql .= " AND i.date <= ? ";
          $stmtParams[] = &$endDate;
        }

        $stmt = $connection->prepare($sql);
        if (!empty($stmtParams)) {
          $paramTypes = str_repeat('s', count($stmtParams));
          $stmt->bind_param($paramTypes, ...$stmtParams);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
          echo "
          <tr>
            <td>{$row['invoice_no']}</td>
            <td>{$row['date']}</td>
            <td>{$row['first_name']} {$row['last_name']}</td>
            <td>{$row['item_name']}</td>
            <td>{$row['item_code']}</td>
            <td>{$row['item_category']}</td>
            <td>{$row['unit_price']}</td>
          </tr>
          ";
        }

        ?>

      </tbody>
    </table>
  </div> 
</body>
</html>

