<?php
session_start();
if(session_destroy())
{

}
?>
<?php include "session.php"; 
?>
<html>
<head>
  <link rel="stylesheet" href="loginstyle.css">
</head>	
</html>	
<?php
	
	$Invalid = "";

	if (isset($_POST['submit']) && !empty($_POST['username']) 
               && !empty($_POST['password']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
	

	$username = stripcslashes($username);
	$password = stripcslashes($password);
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	//mysql_select_db("answerskart") or die("Database not found");
	$query = "select * from login_details where admin ='$username' and password = '$password'";
	$result = mysqli_query($connection,$query)
					or die("Failed to query database".mysql_error());
	$row = mysqli_fetch_array($result);
	if ($row['admin'] == $username && $row['password'] == $password){
		$_SESSION['login_user']=$row['user_id'];

		header('Location:main_home.php');
	}
	else
	{
 	$Invalid= "Invalid username or password!"; 
 }
mysqli_close($connection);

	}
?>
<?php include "header.php"; ?>
<?php include "navbar.php"; ?>
		<title>ANSWERSKART- Login Page</title>
		<!--<div id="loginform">
			<p><b>LOGIN: </b></p>-->
	<div style="margin-top:100px;" id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
 
          <h1 class="text-center">Login</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" method="post" action="">
            <div class="form-group">
              <input type="text" class="form-control input-lg" placeholder="Email" name="username" id ="username">
              <p id="usernameerror"></p>
            </div>
            <div class="form-group">
              <input type="password" class="form-control input-lg" name="password" id = "password" placeholder = "password">
              <p id="passworderror"></p>
            </div>
            <div class="form-group">
              <button id="submit" class="btn btn-dinesh btn-lg btn-block" name ="submit">Sign In</button>
              <?php echo $Invalid ?>
            </div>
          </form>
      </div>
      <div class="modal-footer">
         
      </div>
  </div>
  </div>
</div>

			<!-- Latest compiled and minified JavaScript -->
	<?php include "scripts.php"; ?>	
	<script type="text/javascript">

	 $('#submit').click(function(e) {

	 	var user = document.getElementById("username").value;
		var pass = document.getElementById("password").value;
		if (user == '')
		{
	 		e.preventDefault();	
			$('#usernameerror').html("Enter Username");
		}
		else if (pass =='')
		{

	 		e.preventDefault();
			$('#usernameerror').html(""); 		
			$('#passworderror').html("Enter Password")
		}	
	 });

	</script>
<?php include "footer.php"; ?>	