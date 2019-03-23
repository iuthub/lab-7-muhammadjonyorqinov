<?php  

include('connection.php');
register();
update();
$username = $email = $fullname = $pwd = $confirm_pwd = "";
if(logined()){
	$data = myData();
	$username = $data["username"];
	$email = $data["email"];
	$fullname = $data["fullname"];
	$pwd = $data["pwd"];
	$confirm_pwd = $data["confirm_pwd"];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My Blog - Registration Form</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	
	<body>
		<?php include('header.php'); ?>

		<h2>User Details Form</h2>
		<h4>Please, fill below fields correctly</h4>
		<h4><?=show_error()?></h4>
		<form action="register.php" method="post">
				<ul class="form">
					<li>
						<label for="username">Username</label>
						<input type="text" required="true" value="<?=$username?>" name="username" id="username" required/>
					</li>
					<li>
						<label for="fullname">Full Name</label>
						<input type="text" required="true" value="<?=$fullname?>" name="fullname" id="fullname" required/>
					</li>
					<li>
						<label for="email">Email</label>
						<input type="email" required="true" value="<?=$email?>" name="email" id="email" />
					</li>
					<li>
						<label for="pwd">Password</label>
						<input type="password" required="true" value="<?=$pwd?>" name="pwd" id="pwd" required/>
					</li>
					<li>
						<label for="confirm_pwd">Confirm Password</label>
						<input type="password" required="true" value="<?=$confirm_pwd?>" name="confirm_pwd" id="confirm_pwd" required />
					</li>
					<li>
						<input type="submit" name="submit" value="Submit" /> &nbsp; <?php
						if(!logined()){
						?>Already registered? <a href="index.php">Login</a>
					<?php }else{ ?>
						<a href="index.php">Home page</a>
					<?php } ?>
					</li>
				</ul>
		</form>
	</body>
</html>