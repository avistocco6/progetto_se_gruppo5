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
    	<link rel="stylesheet" type="text/css" href="stylesheet.css"/>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
        <style>
            a{
              text-decoration: none;
              color: black;
            }
            a:visited{
              color: black;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="header" >
                <p>
                  <a href="managedb.php"><img border="0" src="return.png" width="70" height="70"> </a>
                </p>
            </div>
            <div class="header" >
                <h1> Sites Management </h1>
            </div>
            <div class="header">
              <p>
                <a href="index.php"><img border="0" src="exit.png" width="70" height="70"> </a>
              </p>
            </div>
        </div>
        <div class="column" style="text-align: center;">
            <fieldset>
                <legend><h2>Remove site</h2></legend>
                <p>
                    Do you want to delete this site?
                </p>
                <p>
                    <button onclick="removeSite()">Delete</button>
                </p>

            </fieldset>
        </div>
        <div class="footer">
          <h2>Team 5</h2>
        </div>
    </body>
</html>
