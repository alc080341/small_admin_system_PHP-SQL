<?php
session_start();
if(isset($_POST['login']))
{
	include_once("connection.php");
	$username = mysqli_real_escape_string($dbconn, $_POST['username']);
	$password = mysqli_real_escape_string($dbconn, $_POST['password']);
	if(empty($username) || empty($password))
	{
		echo "Please enter both a username and password";
		exit();			
	}	

	else
	{
		//$hashedPassword =  password_hash($password, PASSWORD_DEFAULT);
		$sql = "SELECT * FROM users WHERE username ='$username' LIMIT 1";
		$result = mysqli_query($dbconn, $sql);
		$resultCheck = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);
		$id = $row['id'];
		$admin = $row['admin'];
		

		if($resultCheck < 1)
		{
			echo "Sorry, username or password is not correct";
			exit();
		}
		else
		{
			$hashedPasswordCheck = PASSWORD_VERIFY($password,$row['password']);

			if($hashedPasswordCheck == false)
			{
				echo "Sorry, username or password is not correct";
			}
			elseif($hashedPasswordCheck == true)
			{
				if($admin == 1)
				{
					$_SESSION['admin'] = 1;
				}

				$_SESSION['username'] = $username;
				$_SESSION['id'] = $id;
				echo "success!";
				header("Location: admin.php"); 
			}
			else
			{
				echo "Sorry, username or password is not correct";
			}
		}
		
	}

}

?>




<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="Kevs decorating, Oxford decorator, painter, estimate for decorating, contact oxford decorator"/>
	<meta name="description" content="Kevin is a decorator in Oxford who prides himself on delivering a professional painting and decorating service to a high standard."/>
	<meta name="author" content="Kevs Decorating"/>    
	<title>Kev's Decorating Admin Login</title>
	<link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/stylesheet.css">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 
</head>


<body>
	<div class="grid-container full">

		<header>
			<div class="grid-x">
				<div class="cell hide-for-small-only medium-4 large-3" data-sticky-container>
					<nav class="nav_bar">
						<img src="images/LOGO.png" alt="Kevs decorating - Oxford based decorating - logo"/>
						<a href="index.html">HOME</a>
						<a href="decorating.html">DECORATING</a>			
						<a href="other_services.html">OTHER SERVICES</a>			
						<a href="contact.php">CONTACT</a>
						<a href="blog_main.php">BLOG</a>
					</nav>
				</div>
			</div>
			<div class="cell small-12 show-for-small-only">
				<div class="nav_bar_mobile">
					<div class="mobile_logo_section">
						<img src="images/LOGO.png" alt="Kevs decorating - Oxford based decorating - logo"/>
					</div>
					<div class="title-bar">
						<div class="title-bar-left">
							<button class="menu-icon" data-toggle="offCanvasLeft" type="button"></button>		
						</div>
					</div>	
					<div class="off-canvas-wrapper">
						<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
							<div class="off-canvas position-left" id="offCanvasLeft" data-off-canvas>
								<!-- left off-canvas markup -->
								<div class="side_menu">	 
									<ul class="vertical menu" data-accordion-menu>
										<li><a href="index.html">HOME</a></li>
										<li><a href="decorating.html">DECORATING</a></li>		
										<li><a href="other_services.html">OTHER SERVICES</a></li>			
										<li><a href="contact.php">CONTACT</a></li>
										<li><a href="blog_main.php">BLOG</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<main>
		<div class="content_container">
	            <div class="form_container">
		              <h2 class="large_font_coloured">Login to Admin</h2>
						<form class="contact_form" action="login.php" method="post" enctype="multipart/form-data">
						<input type="text" name="username" value="" placeholder="username">
						<input type="password" name="password" value="" placeholder="password">
						<button type="submit" name="login">Login</button>
					</form>
				</div>
			</div>
		</main>
				


	<footer>
		<div class="footer">

			<div class="footer_section">
				<h2>SITE MAP</h2>	
				<p>
          			<a href="index.html">Home</a> |
          			<a href="decorating.html">Decorating</a> |
          			<a href="blog_main.php">Blog</a>
		        </p>				
        		<p>
					<a href="other_services.html">Other Services</a> |
					<a href="contact.php">Contact me</a>
				</p>
			</div>


			<div class="footer_section">
				<h2>LEGAL</h2>	
				<p>
					<p>
						<a href="privacy.html">Privacy Policy</a>
					</p>
					<br>
				</div>




				<div class="footer_section">
					<h2>COPYRIGHT</h2>	
					<p>&copy; Kev's decorating 2018.</p>
					<p>Hand coded by <a href="http://www.chamberscreative.co.uk/">Chambers Creative</a></p>
				</div>
			</div>
		</footer>


	</div>	

	<script src="js/vendor/jquery.js"></script>
	<script src="js/vendor/what-input.js"></script>
	<script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
</body>
</html>
