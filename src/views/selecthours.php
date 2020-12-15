<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Choose Maintainer</title>
        <!--The system must allow selecting among the days of the week that the Maintainer has  availability and show
         the following information: week number, date (selected day), activity to assign (activity ID, area, typology,
          estimated intervention time), workspace  notes, maintainer name, maintainer availability percentage,
          maintainer competencies  compliance, availability (in minutes for each hour of his workday, e.g. 8:00-9:00,
          9:00- 10:00).
          At this point, the system must allow to select the slot of availability time (to assign the schedule in
          minutes) in which the maintenance activity will be assigned and program the activity. -->

          <meta charset="utf-8"/>
          <meta name="author" content="Team 5"/>
          <meta name="description" content="Web application for maintenance activies."/>
          <link rel="preconnect" href="https://fonts.gstatic.com">
          <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
          <link rel="stylesheet" type="text/css" href="showstyle.css"/>
          <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
        </head>
        <body>
         <div class="row">
          <div class="header">
          </div>
          <div class="header" >
            <h1> Choose Maintainer </h1>
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
            <div id= "day">
              <p> Day </p>
            </div>
            <div id= "dayavail">
              <p id="dayName">  </p>
            </div>
            <div id="activity">
              <p>Activity to assign</p>
            </div>
            <div id="name">
              <p id="activityName"></p>
            </div>
            
          </div>
        </div>
        <table class="tab">
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
        <div id="column" class="column">
          <div class="header3" style="margin: 0;">
            <div id= "mainAvail">
              <p> <b>MAINTAINER AVAILABILITY</b></p>
            </div>
          </div>
        </div>
        

        <table id="maint-availab" style=" width:70%; position: absolute; top:320; left: 25.7%" >
          <thead>

            <tr>
              <th>Maintainer</th>
              <th>Availab. 8:00-9:00</th>
              <th>Availab. 9:00-10:00</th>
              <th>Availab. 10:00-11:00</th>
              <th>Availab. 11:00-12:00</th>
              <th>Availab. 14:00-15:00</th>
              <th>Availab. 15:00-16:00</th>
              <th>Availab. 16:00-17:00</th>
            </tr>
            <template id="maint-availab-template">
              <tr>
                <td style="text-align:center;">{MainName}</td>
                <td style="text-align:center;">
                  <button type="button">{Availab8}</button>
                </td>
                <td style="text-align:center;">
                  <button type="button">{Availab9}</button>
                </td>
                <td style="text-align:center;">
                  <button type="button">{Availab10}</button>
                </td>
                <td style="text-align:center;">
                  <button type="button">{Availab11}</button>
                </td>
                <td style="text-align:center;">
                  <button type="button">{Availab14}</button>
                </td >
                <td style="text-align:center;">
                  <button type="button">{Availab15}</button>
                </td>
                <td style="text-align:center;">
                  <button type="button">{Availab16}</button>
                </td>

                </tr>
              </template>
            </thead>
            <tbody id="maint-availab-rows">

            </tbody>
          </table>
          <br>
          <br>
          <br>
          <a href="#"a><input type="button" value="confirm" onclick="review();" id="confirm" name="confirm" style="margin: 10px; width: 100px;
          height: 50px;top: 0; ">
          </a>
          <br>
          <a href="#"a><input type="button" value="send" id="send" name="send" style="display:none; float:right;margin: 10px; width: 100px;
          height: 50px;top: 0;">
          </a>
        <div class="footer" style="position: fixed;">
          <h2>Team 5</h2>
        </div>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

        <!-- Custom JS -->
        <script type="text/javascript" src="../controllers/loader.js"></script>
        <script type="application/javascript">
            $(document).ready(function () {
                loadDailyAvail();
                document.getElementById("numWeek").innerHTML = localStorage.getItem("week");
                document.getElementById("activityName").innerHTML = localStorage.getItem("name");
            })
          function review(){
            var button = document.getElementById('confirm');
            button.style.display='none';
            var tab = document.getElementById('column');
            tab.style.display='none';
            var x = document.getElementById('send');
            x.style.display="block";
          }
        </script>

      </body>
      </html>



