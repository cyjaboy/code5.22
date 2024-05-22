<?php include('header.php'); ?>
<?php include('connection.php'); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $userlevel = $_POST["userlevel"];
    $email = $_POST["email"];
    
    // Check if username already exists
    $stmt_check_username = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmt_check_username->bind_param("s", $username);
    $stmt_check_username->execute();
    $stmt_check_username->store_result();
    
    if ($stmt_check_username->num_rows > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        if (empty($username) || empty($password) || empty($userlevel) || empty($email)) {
            echo "All fields are required.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt_insert_user = $conn->prepare("INSERT INTO users (username, password, userlevel, email) VALUES (?, ?, ?, ?)");
            $stmt_insert_user->bind_param("ssis", $username, $hashedPassword, $userlevel, $email);
            
            if ($stmt_insert_user->execute()) {
                echo "User created successfully.";
            } else {
                echo "Error creating user: " . $stmt_insert_user->error;
            }
            
            $stmt_insert_user->close();
        }
    }
    $stmt_check_username->close();
}
?>

<div class="container">
    <h2>Create User</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        
        <label for="userlevel">User Level:</label><br>
        <select id="userlevel" name="userlevel">
            <option value="1">View</option>
            <option value="2">Adder</option>
            <option value="3">Admin</option>
        </select><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        
        <input type="submit" value="Create User">
    </form>
</div>

<style>
.container {
    max-width: 300px;
    margin: 0 auto; /* Center the container horizontally */
    padding: 20px;
    background-color: #f8f8f8;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-top: 50px;
}

.container h2 {
    margin-top: 0;
    font-size: 24px;
    color: #333;
}

.container form {
    margin-top: 0px;
}

.container label {
    font-weight: bold;
}

.container input[type="text"],
.container input[type="password"],
.container input[type="email"],
.container select {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.container input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin-top: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
}

.container input[type="submit"]:hover {
    background-color: #45a049;
}
</style>
