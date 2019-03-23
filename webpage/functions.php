<?php 
function query($sorov){
    global $connection;

    return mysqli_query($connection, $sorov);
}

//query checking
function checkQuery($sorov)
{
    global $connection;
    if(!$sorov){
        die("Query failed - ".mysql_error($connection)." ".$connection->error);

    }
}


//register user
function register(){
	if(isset($_POST['submit']) and !logined()){
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$confirm_pwd = $_POST['confirm_pwd'];

		if($pwd != $confirm_pwd){
			set_error("Password does not match");
		}

		if(!$_SESSION['error']){
			$sql = query("INSERT INTO `users` (`username`, `email`, `password`, `fullname`, `dob`) VALUES ( '{$username}', '{$email}', '{$pwd}', '{$fullname}', NOW());");
			checkQuery($sql);

			header("Location: index.php");
		}

	}
}

//set some errors to session
function set_error($err){
	$_SESSION['error'] = $err;
}

//set success message
function set_success($mes){
	$_SESSION['success'] = $mes;
}

//display errors
function show_error(){
	echo $_SESSION['error'];
	unset($_SESSION['error']);
}

//display success message
function show_success(){
	echo $_SESSION['success'];
	unset($_SESSION['success']);
}

//check whether user is logined
function logined(){
	if(isset($_SESSION['id']) and isset($_SESSION['username'])){
		return true;
	}
	else
		return false;
}

//login user action 
function login(){
	if(isset($_POST['submit'])){
		$rem = $_POST['remember'];
		$username = $_POST['username'];
		$pwd = $_POST['pwd'];

		//remember me action
		if(!empty($rem)){
			setcookie("username", $username, time()+60*60*24*365);
			setcookie("pwd", $pwd, time()+60*60*24*365);
		}
		else
		{
			setcookie("username", "", time()-1);
			setcookie("pwd", "", time()-1);
		}

		$sql = query("SELECT * FROM `users` WHERE `username` = '{$username}' and `password` = '{$pwd}'");
			checkQuery($sql);
		if(mysqli_num_rows($sql) == 0){
			set_error("Username or password is incorrect");
		}else
		{
			$row = mysqli_fetch_array($sql);
			$_SESSION['username'] = $row['username'];
			$_SESSION['id'] = $row['id'];
		}
	}
}

function logout(){
	session_destroy();
	session_start();
	set_success("You have logged out");
	header("Location: index.php");
}

//get posts
function get_posts(){
	$id = $_SESSION['id'];
	$sql = query("SELECT * FROM `posts` WHERE `userId` = {$id} ORDER BY `id` DESC");
	checkQuery($sql);
	while($row = mysqli_fetch_array($sql))
		 $data[] = $row;
    return $data;
	
}

//add post
function add_post(){
	if(isset($_POST['submitPost'])){

		$title = $_POST['title'];
		$body = $_POST['body'];
		$myId = $_SESSION['id'];
		$sql = query("INSERT INTO `posts` ( `title`, `body`, `publishDate`, `userId`) VALUES ('{$title}', '{$body}', NOW(), {$myId});");
		checkQuery($sql);
		set_success("Post has been added");
		header("Location: index.php");
	}
}


function update(){
	if(isset($_POST['submit']) and logined()){
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$confirm_pwd = $_POST['confirm_pwd'];
		$myId = $_SESSION['id'];

		if($pwd != $confirm_pwd){
			set_error("Password does not match");
		}

		if(!$_SESSION['error']){
			$sql = query("UPDATE `users` SET 
				`username` = '{$username}', 
				`email` = '{$email}', 
				`password` = '{$pwd}', 
				`fullname` = '{$fullname}' 
				WHERE `id` = {$myId};");
			checkQuery($sql);
			header("Location: index.php");
		}
	}

}

function myData(){
	$id = $_SESSION['id'];
	$sql = query("SELECT * FROM `users` WHERE `id` = {$id}");
	checkQuery($sql);
	$row = mysqli_fetch_array($sql);
    return $row;
}


?>