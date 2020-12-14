<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Choose Maintainer</title>
        <!--Once a specific activity has been verified, the system must allow to assign the scheduled activity
        to a specific Maintainer, according to his availability. To do this, the system must  show the following
         information: week number, activity to assign (activity ID, area,  typology, estimated intervention time),
         competencies required, and the list of  Maintainers with the following information:
        ● Maintainer name
        ● Competencies compliance (number of competencies achieved/required)
        ● Availability percentage (for each day, from Monday to Sunday) -->

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
          <div id="activity">
            <p>Activity to assign</p>
          </div>
          <div id="name">
            <p id="activityName"></p>
          </div>
        </div>
      </div>
      <div class="column">
        <div class="header3" style="margin: 0;">
          <div id= "mainAvail">
            <p> <b>Maintainer AVAILABILITY</b></p>
          </div>
        </div>
      </div>
      <table class="tab">
       <th>Skills Needed</th>
       <thead>
         <template id="skillsNeeded-row-template"><tr>
           <td>{Skill}</td>
         </tr>
       </template>
     </thead>

     <tbody id="skillsNeeded-rows">

     </tbody>

   </table>

   <table id="maint-availab" style=" width:70%; position: absolute; top:320; left: 25.7%" >
    <thead>
      <tr>
        <th>Maintainer</th>
        <th>Skills</th>
        <th>Availab. Mon</th>
        <th>Availab. Tue</th>
        <th>Availab. Wed</th>
        <th>Availab. Thu</th>
        <th>Availab. Fri</th>
        <th>Availab. Sat</th>
        <th>Availab. Sun</th>
      </tr>
      <tr>
        <td>{MainName}</td>
        <td>{NumSkill}</td>
        <td>
          <button type="button" onclick="passId(1)">{Availab. Mon}</button>
        </td>
        <td>
          <button type="button" onclick="passId(2)">{Availab. Tue}</button>
        </td>
        <td>
          <button type="button" onclick="passId(3)">{Availab. Wed}</button>
        </td>
        <td>
          <button type="button" onclick="passId(4)">{Availab. Thu}</button>
        </td>
        <td>
          <button type="button" onclick="passId(5)">{Availab. Fri}</button>
        </td>
        <td>
          <button type="button" onclick="passId(6)">{Availab. Sat}</button>
        </td>
        <td>
          <button type="button" onclick="passId(7)">{Availab. Sun}</button>
        </td>
        <td style="text-align:center;">

        </tr>

        <template id="maint-availab-template">
          <tr>
            <td>{MainName}</td>
            <td>{NumSkill}</td>
            <td>
              <button type="button" onclick="passId('Mon')">{Availab. Mon}</button>
            </td>
            <td>
              <button type="button" onclick="passId('Tue')">{Availab. Tue}</button>
            </td>
            <td>
              <button type="button" onclick="passId('Wed')">{Availab. Wed}</button>
            </td>
            <td>
              <button type="button" onclick="passId('Thu')">{Availab. Thu}</button>
            </td>
            <td>
              <button type="button" onclick="passId('Fri')">{Availab. Fri}</button>
            </td>
            <td>
              <button type="button" onclick="passId('Sat')">{Availab. Sat}</button>
            </td>
            <td>
              <button type="button" onclick="passId('Sun')">{Availab. Sun}</button>
            </td>
            <td style="text-align:center;">

            </tr>
          </template>
        </thead>
        <tbody id="maint-availab-rows">

        </tbody>
      </table>
      <br>
      <br>
      <br>
      <div class="footer">
        <h2>Team 5</h2>
      </div>

      <!-- jQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

      <!-- Custom JS -->
      <script type="text/javascript" src="../controllers/loader.js"></script>
      <script>

       $(document).ready(loadWeekPercentage());
       <!-- Function to get Maintainers' Username -->
       function passId(day) {
         $('#maint-availab').find('tr').click( function(){
           let row = $(this).index();
                   let username = document.getElementById("maint-availab").rows[row].cells[0].innerHTML;//.columns[1].value;
                   console.log(day, username, row);
                   localStorage.setItem("id",$(this).index());

                 });
       };
     </script>

   </body>
   </html>


