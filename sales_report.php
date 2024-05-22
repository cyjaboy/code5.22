<?php include "header.php"; ?>
<?php
include "connection.php";
$t = 0;

// Initialize variables to hold filter values
$starttime = $endtime = "";
$res = null;

if (isset($_POST['submit'])) {
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];

    // Check if both start and end dates are set
    if (!empty($starttime) && !empty($endtime)) {
        // Modify the SQL query to include the date range filter
        $sql = "SELECT *, DATE_FORMAT(created_at, '%d/%m/%y') AS purchase_date FROM sales WHERE created_at >= '$starttime' AND created_at < '$endtime'";
        $res = $conn->query($sql);
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
        <h5>Release Report</h5>
        <!-- Filter input -->
        <input type="text" id="filterInput" onkeyup="filterTable()" placeholder="Search for product names..." class="form-control mb-2">
   <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Product name</th>
            <th scope="col">Unit</th>
            <th scope="col">Description</th> <!-- Added Description column -->
            <th scope="col">Total Unit Price</th>
            <th scope="col">Release date</th> <!-- Added Date column -->
        </tr>
        </thead>
        <tbody>
        <?php
        // Check if the result set is not empty
        if ($res && mysqli_num_rows($res) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($res)) {
                $t += $row['totalprice'];
        ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['sellunit']; ?></td>
                    <td><?php echo isset($row['description']) ? $row['description'] : ''; ?></td> <!-- Display description if available -->
                    <td><?php echo "P " . number_format($row['totalprice'], 2); ?></td> <!-- Format total price -->
                    <td><?php echo $row['purchase_date']; ?></td> <!-- Display purchase date -->
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='5'>No results found</td></tr>";
        }
        ?>
        </tbody>
    </table>
    <?php echo "Total= P " . number_format($t, 2); ?> <!-- Format total amount -->
</div>
<script>
    function printPdf() {
        var printContents = document.querySelector(".table").outerHTML; // Get only the table HTML
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
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
