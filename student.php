<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}

require_once "config.php";

$name = $roll = $email = $phone = $gender = $branch = $food = $year ="";
$name_err = $roll_err = $email_err = $phone_err = $gender_err = $branch_err = $food_err = $year_err ="";

$insert = false;
if(isset($_POST['btn']))
{
 if ($_SERVER['REQUEST_METHOD'] == "POST")
  {
     if (empty($_POST["name"])) {
      $name_err = "Name is required";
      echo "<script> alert('$name_err') </script>" ;
     }// check if name only contains letters and whitespace
     elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["name"])) 
    {
       $name_err = "Only letters and white space allowed";
       echo "<script> alert('$name_err') </script>" ;
      }else{
      $name = test_input($_POST["name"]);
      }


      if (empty($_POST["roll_no"])) {
        $roll_err = "roll no is required";
        echo "<script> alert(' $roll_err') </script>" ;
       } elseif (strlen(trim($_POST['roll_no'])) > 3){
         $roll_err =" aaa invalid roll number";
         echo "<script> alert('$roll_err') </script>" ;
       } elseif ( preg_match("/^[0-9]$/",$_POST["roll_no"]))
       {
                $roll_err=" bbb invalid roll number";
                echo "<script> alert('$roll_err') </script>" ;
        }else{
        $roll = test_input($_POST["roll_no"]);
        }

      if (empty($_POST["email"])) {
        $email_err = "Email is required";
        echo "<script> alert('$email_err') </script>";
      }    // check if e-mail address is well-formed
        elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
         {
          $email_err = "Invalid email format";
          echo "<script> alert('$email_err') </script>" ;
          }else{
                $email = test_input($_POST["email"]);
               }
       
        if (empty($_POST["phone"])) {
          $phone_err = "phone no is required";
          echo "<script> alert('$phone_err') </script>" ;
         } elseif (strlen(trim($_POST['phone'])) > 10){
          $phone_err=" enter a 10 digit phone number";
           echo "<script> alert('$phone_err') </script>" ;
         } elseif ( preg_match("/^[0-9]$/", $_POST['phone']))
         {
                  $phone_err=" enter a valid ph no";
                  echo "<script> alert('$phone_err') </script>" ;
         }else{
          $phone = test_input($_POST['phone']);
              }
    

         if (empty($_POST["gender"])) {
            $gender_err = "Gender is required";
            echo "<script> alert('$gender_err') </script>" ;
             }
             else{
              $gender = test_input($_POST["gender"]);
             }
              
        if (empty($_POST["branch"])) {
              $branch_err = "Branch is required";
              echo "<script> alert('$branch_err') </script>" ;
               }
               else{
                $branch = test_input($_POST["branch"]);
              
               }


         if (empty($_POST["year"])) {
                $year_err = "year is required";
                echo "<script> alert('$year_err') </script>" ;
                 }
                 else{
                  $year = test_input($_POST["year"]);
                 
                 }

        if (empty($_POST["food"])) {
                  $food_err = "food type is required";
                  echo "<script> alert('$food_err') </script>" ;
                   }
                   else{
                    $food = test_input($_POST["food"]);
                   }

  
  $sql = "INSERT INTO studentform ( name , year, phone_no , roll_no , email_id , food , gender , branch)
  VALUES ( '$name', '$year' , '$phone', '$roll' , '$email' , '$food' , '$gender' , '$branch' )";
 


if (mysqli_query($conn, $sql)) {
$insert = true;


$to_email = $email;
$subject = "IV TRIP: FORM SUBMISSION";
$body = "Hi, thank you $name for submitting the form. Hope you enjoy your trip. Safe Journey.";
$headers = "From: ATHARVA COLLEGE OF ENGINEERING";

if (mail( $to_email , $subject , $body, $headers)) {
  echo "<script> alert('Email successfully sent to $to_email...') </script>" ;
  
} else {
  echo "<script> alert('Email sending failed...') </script>" ; 
}

}




mysqli_close($conn);
  }
}


  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
    <link rel="stylesheet" href="student.css">
    <title>welcome page</title>
  </head>
  <body>
    <div class="bg">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
     
     
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
            </li>
    </ul>
  <div class="navbar-collapse collapse">
  <ul class="navbar-nav ml-auto">
  <li class="nav-item active">
        <a class="nav-link" href="#"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"> <?php echo "Welcome ". $_SESSION['username1']?></a>
      </li>
  </ul>
  </div>
  </div>
</nav>


<div class="container mt-4">
<h3><?php echo "Welcome ". $_SESSION['username1']?>! You can now use this website</h3>
<hr>
<section>
<div class="box">
<form method="POST" class="form1">
<h1 class="a"> Application Form </h1>
<h3 class="b"> IV Trip </h3>

  <div class="input1">
    
    <input class="inbox" type="text" name="name" placeholder="Name">
    </div><br><br>
    <div class="input2">
   
    <input type="text" class="inbox" name="roll_no" placeholder="Roll No">
    </div><br><br>
    <div class="input3">
  
    <input class="inbox" type="email" name="email" placeholder="Email Id ">
    </div><br><br>
    <div class="input4">
   
    <input class="inbox" type="text" name="phone" placeholder="Contact No ">
    </div><br><br>
    <div class="input5">
    Gender :<br>
    
    <input type="radio" name="gender" value="female"> Female &nbsp;&nbsp;&nbsp;
    <input type="radio" name="gender" value="male"> Male &nbsp;&nbsp;&nbsp;
    <input type="radio" name="gender" value="other"> Other &nbsp;&nbsp;&nbsp;
    
    </div><br>

    <div class="input5">
    Year :<br> 
    <input type="radio" name="year" value="FE"> FE &nbsp;&nbsp;&nbsp;
    <input type="radio" name="year" value="SE"> SE &nbsp;&nbsp;&nbsp;
    <input type="radio" name="year" value="TE"> TE &nbsp;&nbsp;&nbsp;
    <input type="radio" name="year" value="BE"> BE  &nbsp;&nbsp;&nbsp;
    </div><br>

    <div class="input5">
    Branch :<br> 
    <input type="radio" name="branch" value="ELEC"> ELEC &nbsp;&nbsp;&nbsp;
    <input type="radio" name="branch" value="EXTC"> EXTC &nbsp;&nbsp;&nbsp;
    <input type="radio" name="branch" value="IT"> IT &nbsp;&nbsp;&nbsp;
    <input type="radio" name="branch" value="CMPN"> CMPN  &nbsp;&nbsp;&nbsp;
    </div><br>
    <div class="input5">
    Food : <br>
    <input type="radio" name="food" value="Veg"> Veg &nbsp;&nbsp;&nbsp;
    <input type="radio" name="food" value="Non-Veg"> Non-Veg &nbsp;&nbsp;&nbsp;
    <input type="radio" name="food" value="Jain"> Jain  &nbsp;&nbsp;&nbsp;
    </div><br>
    
    <div class="input6">
    <input class="btn" type="submit" name="btn" value="submit">
    </div><br>
    
</form>
</div>
</section>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
