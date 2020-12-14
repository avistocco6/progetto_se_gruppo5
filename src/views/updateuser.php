<!DOCTYPE HTML>
<html>
<head>
 <title> User Management </title>
        <!-- A System Administrator must be able to  modify system users,
         assign them username, password, and a specific role. The role can be:
        - Planner (maintenance manager)
        - Maintainer
      -->
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
      <h1> User Management </h1>
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
    <form class="modal-content" >
      <h1>Update user</h1>
      <fieldset>
        <div class="container">
          <p>
            <label for="email"><b>Change Email: </b></label>
            <input id="email" type="text" placeholder="Enter Email" name="email" required>
          </p>
          <p>
            <label for="psw"> <b>Change Password: </b> </label>
            <input id="psw" type="password" placeholder="Enter Password" name="psw" required>
          </p>
          <button onclick="updateUser()">Save</button>
        </div>
        <br>
      </fieldset>
    </form>
    <div class="pag">
      <ul class="pagination">
        <li><a href="usermanagement.php">Return</a></li>
      </ul>
    </div>
  </div>	
  <div class="footer" style="position: absolute;">
    <h2>Team 5</h2>
  </div>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <!-- Custom JS -->
  <script type="text/javascript" src="../controllers/updater.js"></script>


  <script type="text/javascript">
    function reload(){
      window.location.replace('usermanagement.html');
    }    
  </script>
</body>
</html>    
