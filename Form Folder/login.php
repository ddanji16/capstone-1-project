<?php
session_start();



?>






<!doctype html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css" />
    <link rel="icon" href="banana_minion.jpg" type="image/x-icon">


  </head>
  <body>
    <div class="container">
        <div class="logo">
    <img src="banana_minion.jpg" alt="Logo">
</div>

      <h2>Welcome Back</h2>
      <p class="subtitle">Login to your account</p>

      <form>
        <div class="input-group">
          <input type="email" id="email" required />
          <label for="email">Email</label>
        </div>

        <div class="input-group">
          <input type="password" id="password" required />
          <label for="password">Password</label>
        </div>

        <button class="btn">Login</button>
      </form>

      <a href="#" class="forgot">Forgot Password?</a>

      <p class="signup">
        Don't have an account? <a href="signup.php">Sign Up</a>
      </p>
    
      
    </div>
  </body>
</html>
