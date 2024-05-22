<?php
include "connection.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $des = $_POST['des'];
    // Add debugging statements to check if 'um' key exists
    if (isset($_POST['um'])) {
        $um = $_POST['um'];
    } else {
        echo "Error: 'um' key is not set in the POST data.";
        exit; // Exit the script to prevent further execution
    }
    $unit = $_POST['unit'];
    $unitprice = $_POST['unitprice'];
    $ref = $_POST['ref'];

    // Check if a product with the same name (case insensitive) already exists
    $checksql = "SELECT * FROM product WHERE LOWER(name) = LOWER('$name')";
    $result = $conn->query($checksql);

    if ($result->num_rows > 0) {
        echo "Error: Product with the same name already exists!";
    } else {
        // Insert into 'product' table
        $insertsql = "INSERT INTO product(name, des, unit, unitprice ) VALUES ('$name', '$des', '$unit', '$unitprice')";
        if ($conn->query($insertsql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $insertsql . "<br>" . $conn->error;
        }

        // Insert into 'purchase' table
        $insertsql1 = "INSERT INTO purchase(name, des,um ,  unit, unitprice, ref ) VALUES ('$name', '$des','$um', '$unit', '$unitprice', '$ref')";
        if ($conn->query($insertsql1) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $insertsql1 . "<br>" . $conn->error;
        }
        
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase or Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="../css/form_styles.css">
    <!-- Include the header styles -->
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Add your CSS styles here */
        body {
            background-color: white; /* Change background color to light grey */
            color: black;
            font-family: Cambria, sans-serif; /* Set font to Cambria */
            padding-top: 10px; /* Add padding to the top of the body to create space for the fixed header */
        }

        /* Apply consistent styling to form elements */
        .form-control {
            border-radius: 0; /* Remove border radius */
        }

        /* Adjust button style */
        .btn-primary {
            border-radius: 0; /* Remove border radius */
        }
    </style>
</head>
<body>

<?php include "header.php"; ?>

<div class="container">
    <h5 class="mt-4">Purchase or Inventory</h5>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="mb-3">
            <label for="exampleInputName" class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputName">
        </div>
        <div class="mb-3">
            <label for="exampleInputDes" class="form-label">Description</label>
            <input type="text" name="des" class="form-control" id="exampleInputDes">
        </div>
         <div class="mb-3">
            <label for="exampleInputum" class="form-label">Unit of Measurement</label>
            <input type="text" name="um" class="form-control" id="exampleInputum">
        </div>
        <div class="mb-3">
            <label for="exampleInputUnit" class="form-label">Quantity</label>
            <input type="number" name="unit" class="form-control" id="exampleInputUnit">
        </div>
        <div class="mb-3">
            <label for="exampleInputUnitprice" class="form-label">Unit Price</label>
            <input type="number" name="unitprice" class="form-control" id="exampleInputUnitprice">
        </div>
        <div class="mb-4">
            <label for="exampleInputref" class="form-label">Reference</label>
            <input type="text" name="ref" class="form-control" id="exampleInputref">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>

</body>
</html>
