<?php
//This script will handle login
session_start();

// check if the user is already logged in

require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if(isset($_POST['admin'])){
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
     
        $err = "Please enter username and password";
        echo "<script> alert('$err') </script>" ;
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: admin.php");   
                        }
                    }

                }

    }
}    
}
}

if(isset($_POST['student'])){
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username1'])) || empty(trim($_POST['password1'])))
    {
      
        $err = "Please enter username and password";
    
        echo "<script> alert('$err') </script>" ;
      
    }
    else{
        $username = trim($_POST['username1']);
        $password = trim($_POST['password1']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password FROM student WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username1"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: student.php");   
                        }
                    }

                }

    }
}    
}
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    
      <script src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script> 
    <title>Login page</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="main.html">Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="login.php">Login<span class="sr-only">(current)</span></a>
      </li>
    
    </ul>
  </div>
</nav>


<section>
<div class="box">
  <div class="form">
   <h1>Admin</h1>
   <br>
   <h2>Login</h2>
   <form method="POST">
     <div class="inputbx">
        <input type="text" placeholder="username" name="username">
        <i class="fas fa-user"></i>
     </div>
     <div class="inputbx">
        <input type="password" placeholder="password" name="password">
        <i class="fas fa-lock"></i>
     </div>
     <div class="inputbx">
        <input type="submit" name="admin" value="sign in">
        
     </div>
</form> 
  </div>
</div>
</section>


<div class="student">
<div class="box1">
  <div class="form1">
   <h1>Student</h1>
   <br>
   <h2>Login</h2>
   <form  method="POST">
     <div class="inputbx1">
        <input type="text" placeholder="username" name="username1">
        <i class="fas fa-user"></i>
     </div>
     <div class="inputbx1">
        <input type="password" placeholder="password" name="password1">
        <i class="fas fa-lock"></i>
     </div>
     <div class="inputbx1">
        <input type="submit" name="student" value="sign in">
        
     </div>
</form> 
  </div>
</div>
</div>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
  </body>
</html>
