<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: Login.php");
}
require_once "config.php";

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="admin.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <title>welcome page</title>
  </head>
  <body>
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
        <a class="nav-link" href="#"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"> <?php echo "Welcome ". $_SESSION['username']?></a>
      </li>
  </ul>
  </div>


  </div>
</nav>
</div>

<script>
  
</script>

<div class="dropdown">
  <div class="lb">
   <label class="label" for="dropdown">Select the Academic year to get the information of students </label>
   <hr>
  </div>
   <div class="drop">
     <form  method="POST">
   <input class="btn" type="submit" name="FE" id="FE" value="FE">
   <input class="btn" type="submit" name="SE" id="SE" value="SE">
   <input class="btn" type="submit" name="TE" id="TE" value="TE">
   <input class="btn" type="submit" name="BE" id="BE" value="BE">
</form>
  </div>
</div>


<section class="info">
<div> 
   <h2 id="trip" class="a "> IV TRIP </h2>
 </div>
<div id="tab" class='table '>
  <table>
  <tr>
     <th>ID</th>
    <th>Name </th>
    <th>Gender</th>
    <th>Branch</th>
    <th>Roll No</th>
    <th>Phone No</th>
    <th>Email Id </th>
</tr> 

<?php


  if(isset($_POST['FE']))
{
  $sql = "SELECT id, name, gender , branch , roll_no ,phone_no, email_id FROM studentform WHERE year ='FE'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td> " . $row["gender"]. "</td><td>". $row["branch"]. "</td><td>". $row["roll_no"]. "</td><td> " . $row["phone_no"]. "</td><td> " . $row["email_id"]."</td></tr>";
    }
    echo " </table> ";
  }
    else{
      echo "0 results";
    }
  
   mysqli_close($conn);
}

   elseif(isset($_POST['SE'])){
  $sql = "SELECT id, name, gender , branch , roll_no ,phone_no, email_id FROM studentform WHERE year ='SE'";
  $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td> " . $row["gender"]. "</td><td>". $row["branch"]. "</td><td>". $row["roll_no"]. "</td><td> " . $row["phone_no"]. "</td><td> " . $row["email_id"]."</td></tr>";
  }
  echo " </table> ";
}
  else{
    echo "0 results";
  }
mysqli_close($conn);
}

   elseif(isset($_POST['TE'])){
  $sql = "SELECT id, name, gender , branch , roll_no ,phone_no, email_id FROM studentform WHERE year ='TE'";
  $result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td> " . $row["gender"]. "</td><td>". $row["branch"]. "</td><td>". $row["roll_no"]. "</td><td> " . $row["phone_no"]. "</td><td> " . $row["email_id"]."</td></tr>";
  }
  echo " </table> ";
}
  else{
    echo "0 results";
  }

mysqli_close($conn);
}   

   elseif(isset($_POST['BE']))
{
  $sql = "SELECT id, name, gender , branch , roll_no ,phone_no, email_id FROM studentform WHERE year ='BE'";
  $result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td> " . $row["gender"]. "</td><td>". $row["branch"]. "</td><td>". $row["roll_no"]. "</td><td> " . $row["phone_no"]. "</td><td> " . $row["email_id"]."</td></tr>";
  }
  echo " </table> ";
}
  else{
    echo "0 results";
  }

mysqli_close($conn);

}
?>
</div>
<section>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
