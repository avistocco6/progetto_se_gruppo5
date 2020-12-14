<!DOCTYPE HTML>
<html>
<head>
 <title> User Management </title>
       <!-- A System Administrator must be able to view system users,
        assign them username, password, and a specific role. The role can be:
        - Planner (maintenance manager)
        - Maintainer -->

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
        <label for="role-select">
          Role: <select onchange="showbutton()" id="role" name="role">
            <option value="-">Choose a role</option>
            <option value="planner">Planner</option>
            <option value="maintainer">Maintainer</option>
          </select>
        </label>
        <table id="users">
          <thead>
            <tr>
              <th style="text-align: center;"><h3>Username</h3></th>
              <th style="text-align: center;"><h3>Name</h3></th>
              <th style="text-align: center;"><h3>E-mail</h3></th>
              <th style="text-align: center;"><h3>Password</h3></th>
              <th style="text-align: center;"><h3>Edit</h3></th>
              <th style="text-align: center;"><h3>Delete</h3></th>
            </tr>
            <template id="users-row-template">
              <tr>
                <td>{Username}</td>
                <td>{Name}</td>
                <td>{Email}</td>
                <td>{Password}</td>
                <td style="text-align:center;">
                  <a href="updateuser.php" onclick="passUsername();" class="btn btn-success btn-lg">
                    <span class="glyphicon glyphicon-edit"></span>
                  </a>
                </td>
                <td style="text-align:center;">
                  <a href="removeuser.php" onclick="passUsername();" class="btn btn-success btn-lg">
                    <span class="glyphicon glyphicon-edit"></span>
                  </a>
                </td>
              </tr>
            </template>
          </thead>
          <tbody id="users-rows">

          </tbody>
        </table>
        <br>
        <a href="adduser.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-plus-sign"></span> Add
        </a>
        <p id="buttonskill" style="display: none;">
          <a href="skillassignment.php" class="btn btn-info btn-lg">
            <span id="buttonskill" class="glyphicon glyphicon-plus-sign"> </span>Skills Assignment
          </a>
        </p>
        <div class="pag">
          <ul class="pagination">
            <li><a href="managedb.php">Return</a></li>
          </ul>
        </div>
      </div>	
      <div class="footer" style="position: absolute;">
        <h2>Team 5</h2>
      </div>

      <!-- jQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

      <!-- Custom JS -->
      <script type="text/javascript" src="../controllers/loader.js"></script>

      <script type="application/javascript">
        $(document).ready(function(){
          loadUsers();
        });

        function passUsername() {
          $('#users').find('tr').click( function(){
            let username = document.getElementById("users").rows[$(this).index()+1].cells[0].innerHTML;
            localStorage.setItem("username", username); 
          });
        };

        function showbutton(){
          $("#users").find("tr:gt(0)").remove();
          loadUsers();
          var x = document.getElementById("role").selectedIndex;
          var y = document.getElementsByTagName("option")[x].value;
          if(y=='maintainer'){
            document.getElementById('buttonskill').style.display="inline";
          }
          else{
            document.getElementById('buttonskill').style.display="none";
          }
        };
      </script>
    </body>
    </html>    
