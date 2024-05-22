<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplies Inventory System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Your custom CSS -->
    <style>
        /* Custom styles */
        body {
            background: rgb(0, 181, 255);
            background: linear-gradient(90deg, rgba(0, 181, 255, 1) 0%, rgba(255, 125, 125, 1) 0%, rgba(116, 168, 255, 0.9808298319327731) 53%);
            min-height: 100vh; /* Ensure the content fills the viewport */
            font-family: Optima, sans-serif; /* Change font to Optima */
        }

        /* Fixed header styles */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000; /* Ensure the header stays on top of other elements */
        }

        .card {
            margin-top: 150px; /* Adjust margin-top to give space for the fixed header */
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card" style="background-color: rgba(255, 255, 255, 0.8);">
                <div class="card-body text-center">
                    <h1>Welcome to the Supplies Inventory System</h1>
                    <p>The objective of this system is to provide an easier way of supplies ordering and create an efficient inventory system for day-to-day use.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
