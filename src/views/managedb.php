<!DOCTYPE HTML>
<html>
<head>
 <title> Management Area </title>
 <meta charset="utf-8"/>
 <meta name="author" content="Team 5"/>
 <meta name="description" content="Web application for maintenance activies."/>
 <link rel="preconnect" href="https://fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <link rel="stylesheet" type="text/css" href="stylesheet.css"/>

 <style type="text/css">

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
    <h1> Management Area </h1>
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
<div class="topnav">
  <a href="skills.php">Skills</a>
  <a href="sites.php">Sites</a>
  <a href="typology.php">Maintenance Typology</a>
  <a href="materials.php">Materials</a>
  <a href="procedures.php">Procedures</a>
  <a style="float: right;" href="usermanagement.php">Users Management</a>
</div>
<div class="column">
  <h1>Select from the top navigation bar.</h1>
</div>
<div class="footer" style="position: absolute;">
  <h2>Team 5</h2>
</div>
</body>
</html>