<!DOCTYPE HTML>
<html>
    <head>
    	<title> Typologies Management </title>
        <!--The system must allow to view maintenance typologies as Electrical, electronic, hydraulic, mechanical. -->

    	<meta charset="utf-8"/>
    	<meta name="author" content="Team 5"/>
    	<meta name="description" content="Web application for maintenance activies."/>
      <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
          <p>
            <a href="managedb.php"><img border="0" src="return.png" width="70" height="70"> </a>
          </p>
        </div>
        <div class="header">
            <h1> Typologies Management </h1>
        </div> 
        <div class="header">
          <p>
            <a href="index.php"><img border="0" src="exit.png" width="70" height="70"> </a>
          </p> 
        </div> 
      </div>  
      <div class="column" style="text-align: center;">
            <table id="type">
              <tr>
                <th style="text-align: center;"><h3>ID</h3></th>
                <th style="text-align: center;"><h3>Typologies</h3></th>
                <th style="text-align: center;"><h3>Edit</h3></th>
                  <th style="text-align: center;"><h3>Delete</h3></th>
              </tr>

              <template id="typology-row-template">
                <tr>
                  <td>{ID}</td>
                  <td>{Description}</td>
                  <td style="text-align:center;">
                    <a href="updatetypology.php" onclick="passId();" class="btn btn-success btn-lg">
                      <span class="glyphicon glyphicon-edit"></span>  
                    </a>
                  </td>
                    <td style="text-align:center;">
                    <a href="removetypology.php" onclick="passId();" class="btn btn-success btn-lg">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                  </td>
                </tr>
              </template>
              </thead>
              <tbody id="typology-rows">

              </tbody>
            </table>
            <br>
            <a href="addtypology.php" class="btn btn-info btn-lg">
                <span class="glyphicon glyphicon-plus-sign"></span> Add
            </a>
        </div>
        <div class="footer">
          <h2>Team 5</h2>
        </div>

      <!-- jQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

      <!-- Custom JS -->
      <script type="text/javascript" src="../controllers/loader.js"></script>

      <script type="application/javascript">
      $(document).ready(loadTypology());

      function passId() {
          $('#typology-rows').find('tr').click( function(){
              let row = $(this).index()+1;
              let id = document.getElementById('skills').rows[row].cells[0].innerHTML;
              localStorage.setItem("id", id);
          });
      };
    </script>

    </body>
</html>
