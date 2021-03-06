  <!DOCTYPE HTML>
  <html>
  <head>
   <title> Sites Management </title>
        <!-- The system must allow to view sites,
         which are composed of factory site (branch offices) and area (or department) inside the factory. -->
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
          <table id="site">
            <thead>
              <tr>
                <th colspan="5"style="text-align: center;"><h3>Sites</h3></th>

              </tr>
              <tr>
                <th style="background-color: #7A858C; text-align: center;">ID</th>
                <th style="background-color: #7A858C; text-align: center;">Factory</th>
                <th style="background-color: #7A858C; text-align: center;">Area</th>
                <th style="text-align: center; background-color: #7A858C">Edit</th>
                <th style="text-align: center; background-color: #7A858C">Delete</th>
              </tr>
              <template id="sites-row-template">
                <tr>
                  <td>{ID}</td>
                  <td>{Branch}</td>
                  <td>{Department}</td>
                  <td style="text-align:center;">
                    <a href="updatesite.php" onclick="passId();" class="btn btn-success btn-lg">
                      <span class="glyphicon glyphicon-edit"></span>  
                    </a>
                  </td>
                  <td style="text-align:center;">
                    <a href="removesite.php" onclick="passId();" class="btn btn-success btn-lg">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                  </td>
                </tr>
              </template>
            </thead>
            <tbody id="sites-rows">

            </tbody>
          </table>
          <br>
          <a href="addsite.php" class="btn btn-info btn-lg">
            <span class="glyphicon glyphicon-plus-sign"></span> Add
          </a>
          <div class="pag">
            <ul class="pagination">
              <li><a href="managedb.php">Return</a></li>
            </ul>
          </div>
        </div> 

        <div class="footer">
          <h2>Team 5</h2>
        </div>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

        <!-- Custom JS -->
        <script type="text/javascript" src="../controllers/loader.js"></script>

        <script type="application/javascript">
          $(document).ready(loadSites());

          function passId() {
            $('#sites-rows').find('tr').click( function(){
              let row = $(this).index()+2;
              let id = document.getElementById('site').rows[row].cells[0].innerHTML;
              localStorage.setItem("id", id);
            });
          };
        </script>

      </body>
      </html>
