<!DOCTYPE HTML>
<html>
<head>
  <title> Update Activity </title>
      <!-- A Planner must be able to  modify maintenance activities.
      A maintenance activity can be performed on a line or on an offline machine and can be:
      - Planned activity
      - Un-planned activity (EWO)
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
      input{
        width: 200px;
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
        <h1> Activity Management </h1>
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
      <form method="post" name="addsite" >
        <fieldset>
          <legend><h2>Update Activity</h2></legend>
          <fieldset>
            <template id="sites-row-template">
              <option value="{Branch} - {Department}">{Branch} - {Department}</option>
            </template>
            <p>
              <label for="sites-rows">
                Area: <select  name="type" id="sites-rows">

                </select>
              </label>

            </p>
          </fieldset>
          <br>
          <p> 
            <template id="typology-row-template"><option value="{Description}">{Description}</option></template>
            <label for="typology-rows">
             Type: <select name="type" id="typology-rows">
             </select>
           </label>
         </p>
         <br>
         <p> 
          <label for="description">
            Description: <textarea id="description"></textarea>
          </label>
        </p>
        <br>
        <p> 
          <label for="estimatedtime">
            Estimated Intervention Time: <input placeholder="hh:mm:ss"id="estimatedtime" type="text" name="time" required/>
          </label>
        </p>
        <br>
        <p> 
          <template id="materials-row-template"><option value="{Material}">{Material}</option></template>
          <label for="materials-rows">
           Material: <select multiple name="type" id="materials-rows">
           </select>
         </label>
       </p>
       <br>
       <p> 
        <label for="interruption">
          <p id="interruption">
            Interruptible Activity: 
            <input type="radio" id="interruptible" name="yes_no" checked>Yes</input>
            <input type="radio" id="interruptible" name="yes_no">No</input>
          </p>
        </label>
      </p>
      <br>
      <p> 
        <label for="week">
          Week: <select name="week" id="week">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
            <option value="32">32</option>
            <option value="33">33</option>
            <option value="34">34</option>
            <option value="35">35</option>
            <option value="36">36</option>
            <option value="37">37</option>
            <option value="38">38</option>
            <option value="39">39</option>
            <option value="40">40</option>
            <option value="41">41</option>
            <option value="42">42</option>
            <option value="43">43</option>
            <option value="44">44</option>
            <option value="45">45</option>
            <option value="46">46</option>
            <option value="47">47</option>
            <option value="48">48</option>
            <option value="49">49</option>
            <option value="50">50</option>
            <option value="51">51</option>
            <option value="52">52</option>
          </select>
        </label>
      </p>
      <br>
    </fieldset>
    <p>
      <button onclick="updateActivity()">Update</button>
    </p>
  </form>  
  <div class="pag">
    <ul class="pagination">
      <li><a href="plannedactivities.php">Return</a></li>
    </ul>
  </div>  
</div>
<div class="footer">
  <h2>Team 5</h2>
</div>  
</body>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<!-- Custom JS -->
<script type="text/javascript" src="../controllers/loader.js"></script>
<script type="text/javascript" src="../controllers/updater.js"></script>

<script type="application/javascript">
  $(document).ready(function(){
    loadMaterials();
    loadSites();
    loadTypology();
  });
</script>

</html>
