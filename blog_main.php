<?php
session_start();


include_once("connection.php");


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
  <title>Kev's Decorating Admin</title>
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



          <?php

          $sql = "SELECT * FROM posts ORDER BY id DESC";
          $result = mysqli_query($dbconn, $sql) or die(mysqli_error());
          $posts = "";

          if(mysqli_num_rows($result) > 0)
          {
            while($row = mysqli_fetch_assoc($result))
            {
              $id = $row['id'];
              $title = $row['title'];
              $content = $row['content'];
              $date = $row['date'];
              $trimmedContent = "";
				if (strlen($content) >= 20) 
				{
    				$trimmedContent = substr($content, 0, 120). " ... ";
				}
				else 
				{
    				$trimmedContent = $content;
				}
              $posts .="<div><hr><div style='max-height: 450px;'><h2><a class='blog_links' href='view_post.php?pid=$id'>$title</a></h2><br/>$trimmedContent</div><div><a class='blog_links' style='width: 100%; font-size: 12px;' href='view_post.php?pid=$id'>Read more</a></div><hr></div>";


            }
            echo $posts;
          }

          else 
          {
            echo "There are no posts to display";
          }


          if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
          {
            echo "<a class='blog_links'href='admin.php'> Admin</a><a class='blog_links' href='logout.php'> Logout</a>";
          }

         
          ?>

          
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
        <p>
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

