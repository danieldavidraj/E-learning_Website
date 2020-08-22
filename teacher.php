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
			div,form
			{
				border:solid grey 1px;
				padding:5%;
			}
			video
			{
				height:auto;
				width:40%;
			}
			input[type=submit],button
			{
				border:1px solid #3498DB ;
				padding:0.8% 1.5%;
				border-radius:5%;
				font-weight:bold;
				color:white;
				background-color:#3498DB ;
				cursor:pointer;
			}
			button
			{
				margin-left:10%;
			}
			input[type=submit]:hover,button:hover
			{
				background-color:#2E86C1;
				transition:0.3s;
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
	<h1>Nice to have you,</h1>
	<a href='login.php'>Log out</a>
	<a href='profile.php' style='margin-right:5%;'>Profile</a>
	<h2>Upload Videos</h2>
    <form method="post" enctype='multipart/form-data'>
      Lesson Name:<br>
	  <input type="text" name="lesson_name"><br><br>
	  <input type='file' name='file'><br><br>
      <input type='submit' value='Upload' name='but_upload'>
    </form>
	<script>
		function Approve(name)
		{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					location.reload();
				}
			};
			xmlhttp.open("GET","approve.php?name="+name,true);
			xmlhttp.send();
		}
	</script>
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
		if(isset($_POST['but_upload']))
		{
			$name = $_FILES['file']['name'];
			$target_dir = "videos/";
			$target_file = $target_dir . $_FILES["file"]["name"];
			$lesson_name=$_POST["lesson_name"];
			// Select file type
			$videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
			// Valid file extensions
			$extensions_arr = array("mp4","avi","3gp","mov","mpeg");
	
			// Check extension
			if( in_array($videoFileType,$extensions_arr) )
			{
				// Upload
				if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file))
				{
					// Insert record
					$query = "INSERT INTO videos(LessonName,name,location) VALUES('".$lesson_name."','".$name."','".$target_file."')";
					mysqli_query($con,$query);
					echo "Upload successfully.";
				}
			}
			else
			{
				echo "Invalid file extension.";
			}
		}
		echo "<h1>Uploaded Videos</h1>";
		$sql="SELECT `LessonName`,`location` FROM `videos` ORDER BY id DESC";
		$fetchVideos = mysqli_query($con,$sql);
		$rowsnum=mysqli_num_rows($fetchVideos);
		echo "<div>";
		if ($rowsnum > 0) 
		{	
			while($row = mysqli_fetch_assoc($fetchVideos))
			{
				$location = $row['location'];
				echo "<video src='".$location."' controls></video>";
				echo "<div style='border:none;width:39%;padding:0;'><h3 align='center'>".$row['LessonName']."</h3></div>";
			}
		}
		else
		{
			echo "No videos uploaded yet!";
		}
		echo "</div>";
		echo "<h1>Students waiting to be approved</h1>";
		$sql="SELECT `Name`,`approved` FROM `accounts` WHERE `approved`='0'";
		$result=mysqli_query($con,$sql);
		$rowsnum=mysqli_num_rows($result);
		echo "<div>";
		if($rowsnum > 0) 
		{
			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "Name: ".$row["Name"]."<button onclick='Approve(".'"'.$row["Name"].'"'.")'>Approve</button><hr width='30%' align='left'>";
			}
		}
		else 
		{
			echo "Currently no students";
		}
		?>
		</body>
</html>