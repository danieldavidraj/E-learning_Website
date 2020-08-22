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
				margin-top:1%;
				padding:5%;
			}
			a
			{
				float:right;
			}
		</style>
	</head>
	<body>
		<img src="images/logo.png" style="width:15%;height:auto;margin:auto;display:block;">
		<a href='login.php'>Log out</a>
		<?php
			session_start();
			if(strcmp($_SESSION['name'],"teacher")==0)
			{
				echo "<a href='teacher.php' style='margin-right:1%;'>Back</a><br>";
				echo "<div><h1>TEACHER PROFILE</h1>";
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
				$sql="SELECT `location` FROM `videos`";
				$fetchVideos = mysqli_query($con,$sql);
				$rowsnum=mysqli_num_rows($fetchVideos);
				echo "Number of videos uploaded : ".$rowsnum."</div>";
			}
			else
			{
				echo "<a href='student.php' style='margin-right:1%;'>Back</a><br>";
				echo "<div><h1>STUDENT PROFILE</h1><h2>Username : ".$_SESSION['name']."</h2>";
				if($_SESSION['approved']==1)
				{
					echo "Approval Status : Approved";
				}
				else
				{
					echo "Approval Status : Not Approved";
				}
				echo "</div>";
			}
		?>
	</body>
</html>