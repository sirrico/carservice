<?php 
require_once('config.php');
require_once('core/controller.Class.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<?php
		if(isset($_COOKIE["ID"]) && isset($_COOKIE["sess"])){
			$Controller = new Controller;
			if($Controller -> checkUserStatus($_COOKIE["ID"], $_COOKIE["sess"])){
				echo '<div class="tlog"><a href="logout.php">Logout</a></div>';
				include("form.html");
				include 'getservice.php';
			}
			else{
				echo "Error.  Are you trying to hack?  Clear your cookies.";
			}
		}
		else{
			echo "<div class=\"lbutt\"><a href='$login_url'>Login with Google </a></div>";
		}
	?>

</body>
</html>