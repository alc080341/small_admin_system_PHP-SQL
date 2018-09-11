


					<?php

					session_start();
	//connect to database
					include_once("connection.php");

					if(!isset($_SESSION['admin']))
					{
						header("Location: login.php");
						die();
					}
					else
					{
						if(!isset($_GET['pid']))
						{
							header("Location: blog_main.php");
						}	
						else
						{
							echo "Post deleted";
							$pid = htmlspecialchars($_GET['pid']);
							$sql = "DELETE FROM posts WHERE id = $pid";
							mysqli_query($dbconn, $sql);
							header("Location: admin.php");		
						}
					}
					?>

