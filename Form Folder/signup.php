<?php
session_start();

$name = $email = $password = $confirmpassword = $usertype = "";
$errors = [
    "name" => "",
    "email" => "",
    "password" => "",
    "confirmpassword" => "",
    "usertype" => ""
];

if (isset($_POST["register"])) {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $usertype = $_POST["usertype"] ?? "";

    // Validation
    if (empty($name)) {
        $errors["name"] = "Name is required";
    }

    if (empty($email)) {
        $errors["email"] = "Email is required";
    }

    if (empty($password)) {
        $errors["password"] = "Password is required";
    }

    if ($password !== $confirmpassword) {
        $errors["confirmpassword"] = "Passwords do not match";
    }

    if (empty($usertype)) {
        $errors["usertype"] = "Please select a role";
    }

    // check if no errors
    $hasError = false;
    foreach ($errors as $err) {
        if (!empty($err)) {
            $hasError = true;
            break;
        }
    }

    if (!$hasError) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $con = mysqli_connect("localhost", "root", "", "schooldb");

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $stmt = mysqli_prepare($con,
            "INSERT INTO catba (names, email, password, usertype) VALUES (?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashedPassword, $usertype);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: Could not register.";
        }
    }
}
?>




<!doctype html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup Page</title>
    <link rel="stylesheet" href="signup.css" />
    <link rel="icon" href="banana_minion.jpg" type="image/x-icon">
  </head>
  <body>
    <div class="container">
      <div class="logo">
        <img src="banana_minion.jpg" alt="Logo" />
      </div>
      <h2>Create Account</h2>
      <p class="subtitle">Sign up to get started</p>

      <form method="POST" action="">
    
<div class="input-group">
    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">
    <label>Full Name</label>
    <span class="error"><?= $errors["name"] ?></span>
</div>
<div class="input-group">
    <input type="email" name="email" value="<?= htmlspecialchars($email) ?>">
    <label>Email</label>
    <span class="error"><?= $errors["email"] ?></span>
</div>
 <div class="input-group">
    <input type="password" name="password">
    <label>Password</label>
    <span class="error"><?= $errors["password"] ?></span>
</div>

  <div class="input-group">
    <input type="password" name="confirmpassword">
    <label>Confirm Password</label>
    <span class="error"><?= $errors["confirmpassword"] ?></span>
</div>
    <div class="role-group">
    <p>Select Role</p>

    <label class="role-option">
        <input type="radio" name="usertype" value="user">
        <span>User</span>
    </label>

    <label class="role-option">
        <input type="radio" name="usertype" value="admin">
        <span>Admin</span>
    </label>

    <span class="error"><?= $errors["usertype"] ?></span>
</div>

    <button type="submit" name="register" class="btn">
        Create Account
    </button>

</form>

      <p class="login-link">
        Already have an account? <a href="login.php">Login</a>
      </p>
    </div>
  </body>
</html>
