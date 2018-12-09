<?php
session_start();
include("../db/db.php");
include("../db/admin.php");
//Database connection selection
$db=new db();
$db->db_connect();
$db->db_select();

if(isset($_POST['username']) && isset($_POST['password']))
{
	$admin=new admin();
	$val=$admin->loginagent($_POST['username'],$_POST['password']);
	if($val>0)
	{
		echo "<script>self.location='agent-profile.php'</script>";
	}
	else
	{
		echo "Failed to login";
	}
}
?>
<!DOCTYPE html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
	<div class="form-box">
		<h3>Login Here</h3>
		<form action="agent-login.php" method="POST">
		<div>
			<label>Username</label><input type="text" name="username">
		</div>
		<div>
			<label>Password</label><input type="password" name="password">
		</div>
		<div>
			<input type="submit" name="submit" value="Login">
		</div>
		</form>
	</div>
</div>
</body>
</html>