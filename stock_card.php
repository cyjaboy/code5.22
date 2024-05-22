<?php
include "header.php";
include "connection.php";

// Define variables to hold description and unit of measurement
$description = "";
$unitOfMeasurement = "";

if (isset($_POST['submit'])) {
    // Retrieve the search input
    $searchInput = $_POST['searchInput'];

    // Query to fetch description and unit of measurement based on the searched item name
    $query = "SELECT des, um FROM purchase WHERE name = '$searchInput'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // If there is a match, fetch the values
        $row = $result->fetch_assoc();
        $description = $row['des'];
        $unitOfMeasurement = $row['um'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Card</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <style>
        .container {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .table-container {
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }
        .additional-info {
            margin-top: 20px;
            margin-left: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Stock Card</h2>
    <div class="table-container">
        <div class="title">STOCK CARD</div> <!-- Moved title here -->
        <div class="additional-info">
            <div id="itemName">Item:</div> <!-- Added an ID for JavaScript to update -->
            <div>Description: <?php echo $description; ?></div> <!-- Display description -->
            <div>Unit of Measurement: <?php echo $unitOfMeasurement; ?></div> <!-- Display unit of measurement -->
        </div>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="searchInput" placeholder="Search...">
                </div>
                <div class="col-md-6 text-end">
                    <button class="btn btn-primary" type="submit" name="submit">Search</button> <!-- Changed to submit button -->
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2">Date</th>
                        <th rowspan="2">Reference</th>
                        <th>Receipt</th>
                        <th colspan="2">Issuance</th>
                        <th rowspan="2">Balance</th>
                        <th rowspan="2">Number of Days</th>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <th>Quantity</th>
                        <th>Office</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Your table body content here -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
