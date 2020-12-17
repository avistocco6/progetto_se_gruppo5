<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Choose Maintainer</title>
    <!--When a maintenance activity is assigned, the system must send a notification to the selected
      Maintainer profile with a copy by e-mail to the Production manager.
      This page gives a final summary of the maintainer availability   -->

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
        <p style="text-align: center;"><a href="logout.php"> Logout </a></p>
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

 <tbody id="workspace-rows" >

 </tbody>
</table>
<table class="tab2" style="float: left;">
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
<table id="maint-availab" >
  <thead>
    <tr>
      <th>Maintainer </th>
      <th>Skills</th>
    </tr>
  </thead>
  <tbody>
    <form id="form">
      <tr>
        <td id="maintainer" name="username" style="text-align:center;"></td>
        <td id="skills" style="text-align:center;"></td>
      </tr>
    </form>
  </tbody>
</table>
<table class="tab3" style="float: left;">
  <th id="hour">Availability</th>
  <tr>
    <td id="min"></td>
  </tr>
</table>

<br>
</div>
<br>
<br>
<br>
<?php
include 'prova.php';
?>
</div>
<a href="mailto:<?php echo $email = getemailmain();?>?cc=<?php echo $email = getemailproman();?>&subject= New Assignment&body= Hello, there is a job for you! According to your availability, I have assigned to you a new planned maintenance activity. Please check your profile to obtain more information. Bye."> 
  <input  type="submit" onclick="passuser()" value="send" id="send" name="send" style="float:right;width: 100px;
  height: 50px;">
</a>

<div class="footer" >
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
    document.getElementById("maintainer").innerHTML = localStorage.getItem("username");
    document.getElementById("skills").innerHTML = localStorage.getItem("skills");
    document.getElementById("activityName").innerHTML = localStorage.getItem("name");
    var day = localStorage.getItem("day");
    switch (day) {
     case '1':
     day = 'Monday';
     break;
     case '2':
     day = 'Tuesday';
     break;
     case '3':
     day = 'Wednesday';
     break;
     case '4':
     day = 'Thursday';
     break;
     case '5':
     day = 'Friday';
     break;
     case '6':
     day = 'Saturday';
     break;
     case '7':
     day = 'Sunday';
     break;
   }
   document.getElementById("dayName").innerHTML = day;
   var min = localStorage.getItem("min");
   document.getElementById("min").innerHTML = min;


   var hour = localStorage.getItem("hour");
   switch (hour) {
    case '8':
    hour = 'Availability time slot: 8:00-9:00';
    break;
    case '9':
    hour = 'Availability time slot: 9:00-10:00';
    break;
    case '10':
    hour = 'Availability time slot: 10:00-11:00';
    break;
    case '11':
    hour = 'Availability time slot: 11:00-12:00';
    break;
    case '14':
    hour = 'Availability time slot: 14:00-15:00';
    break;
    case '15':
    hour = 'Availability time slot: 15:00-16:00';
    break;
    case '16':
    hour = 'Availability time slot: 16:00-17:00';
    break;
  }
  document.getElementById("hour").innerHTML = hour;
})
</script>
<script>
  function passuser(){
    var username = localStorage.getItem("username");

    jQuery.ajax({
      type: "POST",
      url: 'prova.php',
      dataType: 'json',
      data: {user: username},

      success: function (obj, textstatus) {
        alert ("ok");
      }
    });
  }
</script>

</body>
</html>



