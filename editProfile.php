<?php 
session_start();
// var_dump($_SESSION['Name']);die;
$oldP ="";
$newP = "";
$confirmP ="";
$error1 = "";// this will be use for displaying error (Username or password is incorrect)
$error = "";// this will be use for displaying sql connect errors



if(isset($_POST['oldP'])){ /* this if checks is form is submitted by checking that $_POST['username'] is set or exists */
    $newP = $_POST['newP'];
	$confirmP = $_POST['confirmP'];
    $oldP = $_POST['oldP'];
	if($newP == $confirmP){
        include 'connection.php'; /* this file contains variables used for connecting to database ($server,$username,$password,$dbname)*/
        $conn = new mysqli($server, $username, $password,$dbname);// this create connection
        if ($conn->connect_error) { //  this checks if there error connecting to server
	        $error = die("Connection failed: " . $conn->connect_error); // saves error  in $error
        } 
        // $user =  trim(htmlspecialchars($_POST['username']));/* this will trim(remove extra spaces) and remove html tags from username*/
        // $pass = trim(htmlspecialchars($_POST['password']));/* this will trim(remove extra spaces) and remove html tags from password*/
        $sql = "SELECT * FROM `users` WHERE username ='".$_SESSION['Name']."'";
        $result= $conn->query($sql);
        if($result->num_rows < 0){
            $error = "your pass is wrong";
        }
        else {
           
            $sql = "SELECT * from users where username='".$_SESSION['Name']."'";
            $result=$conn->query($sql);
                // var_dump($result);die;
			$row = $result->fetch_assoc();
				
		        
      $id= $row['Id'];
      $sql = "UPDATE users SET password='". $newP."' WHERE id='".$id."'";
			// $sql = "DELETE FROM ".$dbname.".`users` WHERE id='".$id."'";
			// $conn->query($sql);
			// $sql = "INSERT INTO ".$dbname.".`users`(`id`, `username`, `password`) VALUES ('".$id."','".$_SESSION['Name']."','". $newP."')";
            $conn->query($sql);
            header("Location:profile.php"); /* Redirect browser */

}
	}
	else {
		$error = "Passwords not matched!";
		}
	
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">    
    <title>Document</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/stylesheet.css" rel="stylesheet">

</head>
<body style="background:url(images/bgpageonline.png);">

<nav class="navbar navbar-default">
  <div class="container-fluid"> 

  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
  <a href="profile.php" > <button class="btn btn-default"> Back </button></a>

	<a class="navbar-brand"><img style="width: 65px; height: auto; margin-left: 25px; margin-top: 5px;"
          class="img-fluid" src="images/logo.png" alt="TOETICTAC"></a>

	<a><img style="width: 50px; height: auto; margin-top: 10px;" src="images/toetictac.svg"</a>

    <h6 style= "color:#ecf3fb"> CHANGE YOUR PASSWORD </h6>

    <div class="container text-center" style="text-align:center;">
    <div class="row justify-content-center">

<form action="" method= "post">
<div class="mb-3 center-block text-center">
    <label class="form-label">old Password</label> <br>
    <input name="oldP" type="password" class="form-control form-control2 align-self-center" >
  </div>
<div class="mb-3 center-block text-center">
    <label class="form-label"> new Password</label> <br>
    <input name="newP"  type="password" class="form-control form-control2 align-self-center" >
  </div>

  <div class="mb-3 center-block text-center">
    <label class="form-label text-center">confirm Password</label> <br>
    <input name="confirmP" type="password" class="form-control form-control2" >
  </div class="submit-btn">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>    
</div></div></div>
</body>
</html>









