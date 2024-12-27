<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "prado";

// Establish the database connection
$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$alert = false;
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["c-password"];
    $exists = false;

    if (($cpassword == $password) && $exists == false) {
        // Use a prepared statement to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO `vigo` (`email`, `password`, `dt`) VALUES (?, ?, current_timestamp())");
        $stmt->bind_param("ss", $email, $password);

        if ($stmt->execute()) {
            $alert = true;
        }
        $stmt->close();
    }else 
    $error ="Password don't match";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">PHP login System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/php/welcome.php">Home<span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/php/login1.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/php/singup.php">Sign Up</a>
      </li>
     
    </ul>
    
  </div>
</nav>
        <?php
        if($alert){
 echo 
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>';
}
if($error){
    echo 
               '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>Error!</strong> '. $error .'
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
           </div>';
   }
?>
        <div class="container">
            <h1 class="text-center my-5">Sign Up </h1>
            <form method="POST">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
   
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="c-password">Confirm Password</label>
    <input type="password" class="form-control" id="c-password" name="c-password" placeholder="Password">
    <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Stay logged in</label>
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
        </div>







        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
