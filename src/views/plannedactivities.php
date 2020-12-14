<!DOCTYPE HTML>
<html>
<head>
 <title> Select Maintenance Activity </title>
        <!--The system must allow viewing the list of scheduled maintenance activities ordered by week.
        For each activity, the following information should be displayed on the screen: activity ID, area,
        typology, estimated intervention time.
        Each activity must be selectable.
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
          <h1> Planned Activities </h1>
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
        <template id="week-template"><option value='{Week}'>{Week}</option></template>
        <label for="week-select">
          Week: <select id="week-select" name="week" onChange="loadPlanned(this.options[this.selectedIndex].value)">
          </select>
        </label>
        <table id="activities">
          <thead>
            <tr>
              <th>ID</th>
              <th>Area</th>
              <th>Type</th>
              <th>Estimated Intervention Time</th>
              <th style="text-align: center;"><h3>Select</h3></th>
              <th style="text-align: center;"><h3>Edit</h3></th>
              <th style="text-align: center;"><h3>Delete</h3></th>
            </tr>
            <template id="activities-row-template">
              <tr>
                <td>{ID}</td>
                <td>{Area}</td>
                <td>{Type}</td>
                <td>{EstimatedTime}</td>
                <td style="text-align:center;">
                  <a href="selected.php" > <input type="button" onclick="passId();" value="select" name="select" style="margin: 10px; width: 100px; height: 50px;"></a>
                </td>
                <td style="text-align:center;">
                  <a href="updateactivity.php" onclick="passId();" class="btn btn-success btn-lg">
                    <span class="glyphicon glyphicon-edit"></span>  
                  </a>
                </td>
                <td style="text-align:center;">
                  <a href="removeactivity.php" onclick="passId();" class="btn btn-success btn-lg">
                    <span class="glyphicon glyphicon-edit"></span>
                  </a>
                </td>

              </tr>
            </template>
          </thead>
          <tbody id="activities-rows">

          </tbody>
        </table>
        <br>
        <a href="addactivity.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-plus-sign"></span> Add
        </a>
        <div class="pag">
          <ul class="pagination">
            <li><a href="plannerview.php">Return</a></li>
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
        $(document).ready(function() {
          loadWeeks();
        });

        function passId() {
          $('#activities').find('tr').click( function(){
            let id = document.getElementById("activities").rows[$(this).index()+1].cells[0].innerHTML;
            localStorage.setItem("id", id);
            localStorage.setItem("week", document.getElementById('week-select').value)
          });
        };

        
      </script>
    </body>
    </html>
