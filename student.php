<html>
	<head>
		<title>E-Factor e-learning</title>
		<link rel="icon" type="image/png" href="images/logo.png">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
			body
			{
				font-family:arial;
				padding:3%;
			}
			div
			{
				border:solid grey 1px;
				padding:5%;
			}
			video
			{
				height:auto;
				width:40%;
			}
			a
			{
				float:right;
				margin-top:-3.5%;
			}
		</style>
	</head>
	<body>
		<img src="images/logo.png" style="width:15%;height:auto;margin:auto;display:block;">
		<?php
			$host = "localhost";
			$user = "Daniel Davidraj";
			$password = "password";
			$dbname = "daniel davidraj";
			$con = mysqli_connect($host, $user, $password,$dbname);
			// Check connection
			if (!$con) 
			{
				die("Connection failed: " . mysqli_connect_error());
			}
			session_start();
			echo "<h1>Hi ".$_SESSION['name'].",</h1>";
			echo "<a href='login.php'>Log out</a>";
			echo "<a href='profile.php' style='margin-right:5%;'>Profile</a>";
			echo "<h2>Uploaded Videos</h2>";
			if($_SESSION['approved']==1)
			{
				$sql="SELECT `location` FROM `videos` ORDER BY id DESC";
				$fetchVideos = mysqli_query($con,$sql);
				$rowsnum=mysqli_num_rows($fetchVideos);
				echo "<div>";
				if ($rowsnum > 0) 
				{	
					while($row = mysqli_fetch_assoc($fetchVideos))
					{
						$location = $row['location'];
						echo "<video src='".$location."' controls></video><br><br>";
					}
				}
				else
				{
					echo "No videos uploaded yet!";
				}
				echo "</div>";
			}
			else
			{
				echo "<div><h2>You can view videos only after you are approved</h2></div>";
			}
		?>
	</body>
</html>