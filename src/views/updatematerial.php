<!DOCTYPE HTML>
<html>
<head>
 <title> Update Material </title>
        <!-- The system must allow to modify a list of materials,
          to be used during the maintenance activity.  -->
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
              <h1> Materials Management </h1>
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
            <form method="post">
              <fieldset>
                <legend><h2>Update material</h2></legend>
                <p> 
                  <label for="new-material">
                    New Material: <input id = "new-material" type="text" name="material" required/>
                  </label>
                </p>
                <p>
                  <button onclick="updateMaterial()">Update</button>
                </p>
              </fieldset>
            </form>
            <div class="pag">
              <ul class="pagination">
                <li><a href="materials.php">Return</a></li>
              </ul>
            </div>
          </div>
          <div class="footer">
            <h2>Team 5</h2>
          </div>  
        </body>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

        <!-- Custom JS -->
        <script type="text/javascript" src="../controllers/updater.js"></script>

        </html>
