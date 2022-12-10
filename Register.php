<?php
require_once "config.php";



$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";


if(isset($_POST['admin']))
{
if ($_SERVER['REQUEST_METHOD'] == "POST")
  {
    // Check if username is empty
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Username cannot be blank";
        echo "<script> alert('$username_err') </script>" ;
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                    echo "<script> alert('$username_err') </script>" ;
                    
                }
                else
                {
                    $username = trim($_POST['username']);
                }
            }
            else
            {
      
                echo "<script> alert('Something went wrong') </script>" ;
            }
        }
        
    mysqli_stmt_close($stmt);
        }

// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
    echo "<script> alert('$password_err') </script>" ;
   
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
    echo "<script> alert('$password_err') </script>" ;
    
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
    echo "<script> alert('$password_err') </script>" ;
    
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else
        {
          echo "<script> alert('Something went wrong... cannot redirect!') </script>" ;
          
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}
}

if(isset($_POST['student'])){
  if ($_SERVER['REQUEST_METHOD'] == "POST")
  {
    // Check if username is empty
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Username cannot be blank";
        echo "<script> alert('$username_err') </script>" ;
    }
    else{
        $sql = "SELECT id FROM student WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                    echo "<script> alert('$username_err') </script>" ;
                    
                }
                else
                {
                    $username = trim($_POST['username']);
                }
            }
            else
            {
              echo "<script> alert('Something went wrong') </script>" ;
                
            }
        }
        
    mysqli_stmt_close($stmt);
        }

// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
    echo "<script> alert('$password_err') </script>" ;
   
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
    echo "<script> alert('$password_err') </script>" ;
    
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
    echo "<script> alert('$password_err) </script>" ;
    
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO student (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else
        {
          echo "<script> alert('Something went wrong... cannot redirect!') </script>" ;
           
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
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
    <link rel="stylesheet" href="style.css" >
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script> 
    <title>REGISTRATION PAGE</title>
  </head>
  <body>
    <div class="bg">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="main.html">Home </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="register.php">Register <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      

      
     
    </ul>
  </div>
</nav>

<div class="container">
    <div class="forms-container">
      <div class="signin-signup">
      <form action="#" class="sign-in-form" method="POST">
          <h2 class="title1">Admin</h2>
          <br><br>  
            <h2 class="title2"> Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name ="password" /> 
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password"  placeholder="Confirm Password" name ="confirm_password" />
            </div>
            <input type="submit" name="admin" value="sign up" id="ad" class="btn solid" /> 
            </div>
        </form>
      


      <div class="container">
    <div class="forms-container">
      <div class="signin-signup2">
      <form action="" class="sign-in-form" method="POST">
          <h2 class="title1">Student</h2>
          <br><br>  
            <h2 class="title2"> Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name ="password" /> 
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password"  placeholder="Confirm Password" name ="confirm_password" />
            </div>
            <input type="submit" value="sign up" name="student" id="st" class="btn solid" /> 
            </div>
        </form>
        
      
           
           

            

  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</div>
</body>

</html>



