<?php
// Start the session to manage user login status
session_start();

// Include necessary files
include "connection.php";

// Check if the user is not authenticated
if (!isset($_SESSION['auth']) || $_SESSION['auth'] != 1) {
    header("Location: login.php");
    exit();
}

$search = '';
if(isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT *, DATE_FORMAT(created_at, '%d/%m/%y') AS purchase_date FROM product WHERE name LIKE '%$search%' OR des LIKE '%$search%'";
} else {
    $sql = "SELECT *, DATE_FORMAT(created_at, '%d/%m/%y') AS purchase_date FROM product";
}

// Execute the SQL query
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    echo "Error: " . $conn->error;
    exit(); // Exit the script
}

if (isset($_POST['update_btn'])) {
    // Get the values from the form
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_des = $_POST['update_des'];
    $update_unit = $_POST['update_unit'];
    $update_unitprice = $_POST['update_unitprice'];
    $update_purchase_date = $_POST['update_purchase_date'];
    $update_arrival_date = $_POST['update_arrival_date'];

    // Update query
    $update_query = "UPDATE product SET name='$update_name', des='$update_des', unit='$update_unit', unitprice='$update_unitprice', created_at='$update_purchase_date', arrived_at='$update_arrival_date' WHERE id='$update_id'";
    
    // Execute the update query
    if ($conn->query($update_query) === TRUE) {
        // Redirect back to the same page to refresh the UI
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $delete_query = "DELETE FROM product WHERE id='$remove_id'";
    if ($conn->query($delete_query) === TRUE) {
        // No need to echo "Record deleted successfully" here
        // Redirect back to the same page to refresh the UI
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        /* Add your CSS styles here */
        body {
            background-color: white; /* Change background color to light grey */
            color: black;
            font-family: Cambria, sans-serif; /* Set font to Cambria */
            margin: 0;
            padding-top: 60px; /* Add padding to the top of the body to create space for the fixed header */
        }

        /* Hide header when printing */
        @media print {
            header {
                display: none !important;
            }
        }

        /* Navbar styles */
        .navbar {
            height: 70px; /* Set fixed height for the navbar */
            border: 2px solid black; /* Add a 2px solid black border around the navbar */
            border-radius: 10px; /* Add border-radius for rounded corners */
            background-color: #95B0B1 !important; /* Change the background color to #95B0B1 */
            padding: 10px; /* Add padding to the navbar */
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            font-family: 'Oswald', sans-serif;
            font-size: 15px; /* Adjust the font size for header links */
            text-align: center; /* Center align the text */
            color: black; /* Set text color */
            border-right: 2px solid black; /* Add a border to separate tabs */
            padding: 10px 20px; /* Adjust padding as needed */
            height: 50px; /* Set fixed height for navbar items */
            line-height: 50px; /* Center vertically */
        }

        .navbar-nav .nav-item:first-child .nav-link {
            border-left: 2px solid black; /* Add left border to the first tab */
        }

        .navbar-nav .nav-item:last-child .nav-link {
            border-right: none; /* Remove right border from the last tab */
        }

        /* Adjust logout button style */
        .btn-logout {
            margin-left: auto;
            color: white; /* Set text color */
        }

        /* Add a class for static input fields */
        .static-input {
            background-color: #f8f9fa; /* Set background color for static input fields */
        }
    </style>
</head>
<body>

<?php include "header.php"; ?>

<div class="container">
    <h5>Stock Status</h5>
    <form class="mb-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search...">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Purchase Date</th> <!-- Purchase Date column -->
                    <th scope="col">Arrival Date</th> <!-- Arrival Date column -->
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $total_amount = $row['unit'] * $row['unitprice'];
                    ?>
                    <tr>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="original_arrival_date" value="<?php echo $row['arrived_at']; ?>">
                            <td><input type="text" class="form-control <?php echo ($_SESSION['user_level'] == 1) ? 'static-input' : ''; ?>" name="update_name" value="<?php echo $row['name']; ?>" <?php echo ($_SESSION['user_level'] == 1) ? 'readonly' : ''; ?> maxlength="100"></td>
                            <td><input type="text" class="form-control <?php echo ($_SESSION['user_level'] == 1) ? 'static-input' : ''; ?>" name="update_des" value="<?php echo $row['des']; ?>" <?php echo ($_SESSION['user_level'] == 1) ? 'readonly' : ''; ?>></td>
                            <td><input type="text" class="form-control <?php echo ($_SESSION['user_level'] == 1) ? 'static-input' : ''; ?>" name="update_unit" value="<?php echo $row['unit']; ?>" <?php echo ($_SESSION['user_level'] == 1) ? 'readonly' : ''; ?>></td>
                            <td><input type="text" class="form-control <?php echo ($_SESSION['user_level'] == 1) ? 'static-input' : ''; ?>" name="update_unitprice" value="<?php echo number_format($row['unitprice'], 2); ?>" <?php echo ($_SESSION['user_level'] == 1) ? 'readonly' : ''; ?>></td>
                            <td><?php echo number_format($total_amount, 2); ?></td>
                            <td><input type="date" class="form-control <?php echo ($_SESSION['user_level'] == 1) ? 'static-input' : ''; ?>" name="update_purchase_date" value="<?php echo date('Y-m-d', strtotime($row['created_at'])); ?>" <?php echo ($_SESSION['user_level'] == 1) ? 'readonly' : ''; ?>></td>
                            <td>
                                <?php
                                if (!empty($row['arrived_at'])) {
                                    echo '<input type="date" class="form-control '. ($_SESSION['user_level'] == 1 ? 'static-input' : '') .'" name="update_arrival_date" value="' . date('Y-m-d', strtotime($row['arrived_at'])) . '" '. ($_SESSION['user_level'] == 1 ? 'readonly' : '') .'>';
                                } else {
                                    echo '<input type="date" class="form-control '. ($_SESSION['user_level'] == 1 ? 'static-input' : '') .'" name="update_arrival_date" value="" '. ($_SESSION['user_level'] == 1 ? 'readonly' : '') .'>'; // Set to blank initially
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                // Check user level and display appropriate buttons
                                if ($_SESSION['user_level'] > 1) {
                                    // Display update and delete buttons for users with access level higher than 1
                                    echo '<button type="submit" class="btn btn-primary" name="update_btn">Update</button>';
                                    echo '<a class="btn btn-danger" href="index.php?remove=' . $row['id'] . '">Delete</a>';
                                } else {
                                    // Hide update and delete buttons for users with access level 1
                                    echo '<span class="text-muted">View Only</span>';
                                }
                                ?>
                            </td>
                        </form>
                    </tr>
                <?php }
            } else {
                echo "<tr><td colspan='8'>0 results</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
