<?php
include "connection.php";

$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase or Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .container {
            margin-top: 60px; /* Adjust the margin-top as needed */
        }
    </style>
</head>
<body>
    <?php include "header.php"; ?>

    <div class="container">
        <h5>Release Orders</h5>
        <input type="text" id="filterInput" onkeyup="filterTable()" placeholder="Search for product names..." class="form-control mb-3">
        <table id="productTable" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Released number of units</th>
                    <th scope="col">Description</th>
                    <th scope="col">Office</th>
                    <th scope="col">Reference</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <form id="form<?php echo $row['id']; ?>" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            <tr>
                                <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['des'];?></td>
                                <td><?php echo $row['unit'];?></td>
                                <td><?php echo $row['unitprice'];?></td>
                            
                                <td>
                                    <div class="mb-3">
                                        <input type="number" name="unitsale" class="form-control" id="exampleInputUnit" required>
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-3">
                                        <input type="text" name="description" class="form-control" id="exampleInputDescription">
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-3">
                                        <input type="text" name="office" class="form-control" id="exampleInputOffice">
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-3">
                                        <input type="text" name="refr" class="form-control" id="exampleInputDescription">
                                    </div>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary" name="submit">Release</button>
                                </td>
                            </tr>
                        </form>
                    <?php }
                } else {
                    echo "0 results";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7a6b6abeb9d292b5c0b2d98df77ab8a1fcd808d8955eaf53a5c3296a9c6bd03c" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-DEHvuQAGHTFwbIoWudSfFJMKZtN5q6jP9r0poJWVRaCg1CwkfoM3+0RUoKoDZOC9" crossorigin="anonymous"></script>
</body>
</html>
