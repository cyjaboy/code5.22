<?php 
session_start();

// Include the file containing the database connection configuration
include "connection.php";

// Check if the user is already authenticated
if(isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
    header("Location: home.php");
    exit();
}

// Check if the login form is submitted
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];

    // Fetch user from the database using either username or email
    $query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $id, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Set the user's access level in the session
            $_SESSION['auth'] = 1;
            $_SESSION['user_level'] = $row['userlevel']; // Assuming the access level column in your database is named 'userlevel'
            header("Location: home.php");
            exit();
        } else {
            $error_message = "Invalid username or password";
        }
    } else {
        $error_message = "Invalid username or password";
    }
}
?><!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <style>
        /* Custom CSS for layout */
        body, html {
            height: 100%;
            margin: 0;
            background-image: url('loginbackground.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            position: relative; /* Added for positioning */
            font-family: Georgia, serif; /* Font family changed to Georgia */
            font-size: 15px; /* Base font size */
        }

        .overlay {
            position: absolute;
            top: 50%; /* Adjust position as needed */
            right: 22%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.6); /* Adjust opacity as needed */
            padding:0px; /* Adjust padding as needed */
            border-radius: 10px; /* Adjust border radius as needed */
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5); /* Adjust shadow as needed */
            width: 60%; /* Adjust width as needed */
            max-width: 400px; /* Adjust max-width as needed */
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80%;
            padding: 0px;
        }

        .form-group {
            margin-bottom: 0px; /* Adjust margin as needed */
        }

        .btn-primary {
            width: 100%; /* Adjust width as needed */
        }

        .text-center {
            text-align: center; /* Center align text */
            margin-bottom: 20px; /* Adjust margin as needed */
            font-size: 24px; /* Adjust font size */
        }

        .bold-text {
            font-weight: bold; /* Make text bold */
        }

        .card-body {
            font-size: 15px; /* Adjust font size */
        }

        .form-control {
            font-size: 15px; /* Adjust font size */
        }
    </style>
</head>
<body>
<div class="overlay">
    <h3 class="text-center bold-text">Supplies Unit Inventory System</h3>
    <div class="container">
        <div class="login-container">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Sign In</h3>
                </div>
                <div class="card-body">
                    <?php if(isset($error_message)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php } ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username or Email" name="id" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn btn-primary" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>
</html>
