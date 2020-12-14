<!DOCTYPE HTML>
<html>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<!-- Custom JS -->
<script type="text/javascript" src="../controllers/remover.js"></script>

<head>
 <title> Remove Site </title>
        <!-- The system must allow to delete sites, which are composed of factory site
          (branch offices) and area (or department) inside the factory. -->
          <meta charset="utf-8"/>
          <meta name="author" content="Team 5"/>
          <meta name="description" content="Web application for maintenance activies."/>
          <link rel="preconnect" href="https://fonts.gstatic.com">
          <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
          <style>
            a{
              text-decoration: none;
              color: black;
            }
            a:visited{
              color: black;
            }
            .btn{
              background-color: #3bb0bb;
              border-color:white; 
            }
            .row{
              margin-left: 0px; 
              margin-right: 0px;
            }
          </style>
        </head>
        <body>
          <div class="row">
           <div class="header">
           </div>
           <div class="header" >
            <h1> Sites Management </h1>
          </div> 
          <div class="header">
            <!--Script per cambiare lo stile della pagina in caso di accesso di un utente-->
            <?php
            session_start();
            if(!empty($_SESSION["username"])){
              $username = $_SESSION["username"];
              $html = <<< HTML
              <p style="text-align: center;"> $username </p>
              <hr>
              <p style="text-align: center;"><a href="logout.php"> Logout </a><p>
              HTML;
              echo $html;
            }
            ?>  
          </div> 
        </div>
        <div class="column" style="text-align: center;">
          <fieldset>
            <legend><h2>Remove site</h2></legend>
            <p>
              Are you sure you want to delete this site?
            </p>
            <p>
              <button onclick="removeSite()">Delete</button>
            </p>
            <p>
              <button><a href="sites.php">Return</a></button>
            </p>

          </fieldset>
        </div>
        <div class="footer">
          <h2>Team 5</h2>
        </div>
      </body>
      </html>
