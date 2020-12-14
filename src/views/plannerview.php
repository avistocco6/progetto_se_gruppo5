<!DOCTYPE HTML>
<html>
<head>
  <title> Maintenance Activities </title>
      <!--A Planner must be able to manage (create, view, modify or delete) maintenance activities.
      A maintenance activity can be performed on a line or on an offline machine and can be:
      - Planned activity
      - Un-planned activity (EWO)
      - Extra activity (an unplanned activity type) -->

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
          <h1> Maintenance Activities </h1>
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
        <table>
          <tr>
            <th><h3>Maintenance Activities</h3></th>
          </tr>
          <tr>
            <td><a href="plannedactivities.php">Planned Activities</a></td>
          </tr>
          <tr>
            <td><a href="#">Un-Planned Activities</a></td>
          </tr>
          <tr>
            <td><a href="#">Extra Activities</a></td>
          </tr>
        </table>
      </div>  
      <div class="footer" style="position: absolute;">
        <h2>Team 5</h2>
      </div>
    </body>
    </html>      
