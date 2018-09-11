<?php
session_start();


include_once("connection.php");

if(!isset($_SESSION['admin']))
{
  header("Location: login.php");
  die();
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
    <script>
    function delPost(id)
    {
        if (confirm("Are you sure you want to delete this post? Don't be a plonker!"))
        {
            window.location.href = "del_post.php?pid=" + id;
        }
    }

    </script>

          <?php
          $sql = "SELECT * FROM posts ORDER BY id DESC";
          $result = mysqli_query($dbconn, $sql) or die(mysqli_error());
          $posts = "";
          echo "<a class='blog_links' href='post.php'>Create a post</a><br /><hr>";
          if(mysqli_num_rows($result) > 0)
          {
            while($row = mysqli_fetch_assoc($result))
            {
              $id = $row['id'];
              $title = htmlspecialchars($row['title']);
              $date = $row['date'];

              $admin = "<div><a class='blog_links' onclick='delPost($id);'>Delete</a>&nbsp;<a class='blog_links' href='edit_post.php?pid=$id'>edit</a></div>";
              $posts .="<div><h2><a class='blog_links' href='view_post.php?pid=$id' target='_blank'>$title</a></h2><h3>$date</h3>$admin</div>";

            }
            echo $posts;
            echo "<hr>";
          }

          else 
          {
            echo "<p>There are no posts to display</p><br>";
          }

          ?>

          <br />
          <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
          {
            echo "<a class='blog_links'href='admin.php'> Admin</a><a class='blog_links' href='logout.php'> Logout</a>";
          } ?>
          
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

