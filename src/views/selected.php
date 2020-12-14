<!DOCTYPE HTML>
<html>
<head>
 <title> Management Area </title>
        <!--When a Planner role select a specific activity, the system must allow to verify the next  information:
         week number, activity to assign (activity ID, area, typology, estimated  intervention time), workspace notes,
         intervention description (activity description) and competencies (those required to perform the intervention). -->
         <meta charset="utf-8"/>
         <meta name="author" content="Team 5"/>
         <meta name="description" content="Web application for maintenance activies."/>
         <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
         <link rel="preconnect" href="https://fonts.gstatic.com">
         <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
         <link rel="stylesheet" type="text/css" href="showstyle.css"/>
       </head>
       <body>
        <div class="row">
          <div class="header">
          </div>
          <div class="header" >
            <h1> Selected Activity </h1>
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
        <div class="column">
          <div class="header2" style="margin: 0;">
            <div id= "week">
              <p> Week n° </p>
            </div>
            <div id="number">
              <p id="numWeek"></p>
            </div>
            <div id="activity">
              <p>Activity to assign</p>
            </div>
            <div id="name">
              <p id="activityName"></p>
            </div>
            <a href="choosemaintainer.php"a><input onclick="passInfo()" type="button" value="forward" name="forward" style="margin: 10px; width: 100px;
            height: 50px;"></a>
          </div>
          <div class="content">
            <table class="tab1">
              <tr>
                <th>Workspace Notes</th>
              </tr>
              <thead>
                <template id="workspace-row-template">
                  <tr>
                    <td>{Workspace Notes}</td>
                  </tr>
                </template>
              </thead>

              <tbody id="workspace-rows">

              </tbody>
            </table>

            <table class="tab2">
              <tr>
                <th>Intervention Description</th>
              </tr>
              <thead>
                <template id="intervDescription-row-template">
                  <tr>
                    <td>{Intervention Description}</td>
                  </tr>
                </template>
              </thead>

              <tbody id="intervDescription-rows">

              </tbody>
            </table>
            <table class="tab3">
              <th>Skills Needed</th>
              <thead>
                <template id="skillsNeeded-row-template">
                  <tr>
                    <td>{Skill}</td>
                  </tr>
                </template>
              </thead>

              <tbody id="skillsNeeded-rows">

              </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="footer" >
      <h2>Team 5</h2>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- Custom JS -->
    <script type="text/javascript" src="../controllers/loader.js"></script>
    <script type="application/javascript">
      $(document).ready(loadSelected());

      function passInfo() {
        let week = document.getElementById("number").innerHTML.value;
        let id = document.getElementById('name').innerHTML.value[0];
        localStorage.setItem("week", week);
        localStorage.setItem("id", id);
      }
    </script>


  </body>
  </html>
