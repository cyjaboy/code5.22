<?php
ob_start(); // Start output buffering

include "header.php"; 

include "connection.php"; // Include database connection file
$t=0;
// Initialize variables to hold filter values
$starttime = $endtime = "";
$res = null;

if (isset($_POST['submit'])) {
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];

    // Check if both start and end dates are set
    if (!empty($starttime) && !empty($endtime)) {
        // Modify the SQL query to include the date range filter
        $sql = "SELECT *, DATE_FORMAT(created_at, '%d/%m/%y') AS purchase_date FROM product WHERE created_at >= '$starttime' AND created_at < '$endtime'";
        $result = $conn->query($sql);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Reports</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <!-- Design Styles -->
    <style>
        body {
            font-family: Cambria, sans-serif; /* Set font to Cambria */
            font-size: 15px; /* Set font size */
        }

        .container {
            margin-top: 60px;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <?php include "header.php"; ?>

    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="starttime">Start (date and time):</label>
            <input type="datetime-local" id="starttime" name="starttime" value="<?php echo $starttime; ?>">

            <label for="endtime"> End (date and time):</label>
            <input type="datetime-local" id="endtime" name="endtime" value="<?php echo $endtime; ?>">
           <input type="submit" name="submit" class="btn btn-primary">
        </form>
        <button type="button" onclick="printPdf();" class="btn btn-primary">Pdf Report</button>
        <h5>Purchase Report</h5>
        <!-- Filter input -->
        <input type="text" id="filterInput" onkeyup="filterTable()" placeholder="Search for product names..." class="form-control mb-2">
   <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Description</th>
                <th scope="col">Unit</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Purchase Date</th>
                <th scope="col">Arrival Date</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($result) && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $total_amount = $row['unit'] * $row['unitprice'];
                    ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['des']; ?></td>
                        <td><?php echo $row['unit']; ?></td>
                        <td><?php echo number_format($row['unitprice'], 2); ?></td>
                        <td><?php echo number_format($total_amount, 2); ?></td>
                        <td><?php echo date('d/m/y', strtotime($row['created_at'])); ?></td>
                        <td><?php echo $row['arrived_at'] ? date('d/m/y', strtotime($row['arrived_at'])) : ''; ?></td>
                    </tr>
                <?php }
            } else {
                echo "<tr><td colspan='7'>No results found</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <script>
        function printPdf() {
            var tableContent = document.querySelector('.table').outerHTML; // Target only the table content
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Print Table</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(tableContent); // Print the table content
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }

        function filterTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("filterInput");
            filter = input.value.toUpperCase();
            table = document.querySelector(".table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>
