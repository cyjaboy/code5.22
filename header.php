<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in and their access level is set in the session
if(isset($_SESSION['user_level'])) {
    $user_level = $_SESSION['user_level'];
} else {
    // If user level is not set, assume level 1 (guest)
    $user_level = 1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <style>
        /* Basic styling for the header */
        .header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed; /* Fix the header position */
            width: 100%; /* Make the header full width */
            top: 0; /* Position it at the top */
            z-index: 1000; /* Ensure it's above other elements */
            font-family: Cambria, serif; /* Change font to Cambria */
            font-size: 20px; /* Increase font size */
        }
        .header a {
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
            font-family: Cambria, serif; /* Same font style for all links */
            border-right: 1px solid #777; /* Add border between tabs */
            padding-right: 10px; /* Add padding to separate tabs */
        }
        .header a:last-child {
            border-right: none; /* Remove border from the last tab */
            padding-right: 0; /* Remove padding from the last tab */
        }
        .header a:hover {
            color: #ccc; /* Change color on hover */
        }
        .logout {
            float: right;
            margin-right: 10px;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 160px;
            z-index: 1;
        }
        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #777;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        body {
            margin-top: 40px; /* Adjust body margin to make space for the fixed header */
            font-family: Verdana, sans-serif; /* Same font style for the body */
        }
    </style>
</head>
<body>
    <div class="header">
        <?php
        // Display links based on user access level
        if ($user_level >= 1) {
            echo '<a href="home.php">Home</a>';
            echo '<a href="index.php">Stocks</a>';
        }
        if ($user_level >= 2) {
             echo '<a href="purchase.php">Purchase/Inventory</a>';
            echo '<a href="sales.php">Release</a>';
            echo '<div class="dropdown">';
            echo '<a href="javascript:void(0);" class="dropbtn">Reports</a>';
            echo '<div class="dropdown-content">';
            echo '<a href="purchase_report.php">Purchase Report</a>';
            echo '<a href="sales_report.php">Release Report</a>';
            echo '<a href="arrival_report.php">Arrival Report</a>';
            echo '<a href="stock_card.php">Stock Card</a>';
            echo '</div>';
            echo '</div>';
           
        }
        if ($user_level >= 3) {
            echo '<a href="user_creation.php">Create User</a>';
        }
        ?>
        
        <!-- Logout button -->
        <form action="logout.php" method="post" class="logout">
            <input type="submit" value="Logout">
        </form>
    </div>
</body>
</html>
