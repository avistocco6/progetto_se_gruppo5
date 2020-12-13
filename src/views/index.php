<!DOCTYPE HTML>
<html>
    <head>
    	<title> Home Page </title>
    	<meta charset="utf-8"/>
    	<meta name="author" content="Team 5"/>
    	<meta name="description" content="Web application for maintenance activies."/>
    	<link rel="stylesheet" type="text/css" href="stylesheet.css"/>
    	<link rel="stylesheet" type="text/css" href="login.css"/>
    	<link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
    </head>
    <body>
    	<div class="row">
	    	<div class="header">
	        </div> 
	    	<div class="header">
	    		<h1> Home Page </h1>
	        </div> 
	        <div class="header">
	        </div> 
	    </div>    
    	<div class="column" style="text-align: center;">
    			<img onclick="document.getElementById('id01').style.display='block'" style="width:auto; margin-top:80px;" src="icon1.png" width="150" height="150">
    			<h1>Click on the icon to login as a <a href="managedb.php">System Administrator</a> or as a <a href="plannerview.php">Planner</a>.</h1>
    	</div>	
    	<div id="id01" class="modal">
  
		  <form class="modal-content animate" method="post">
			<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		    <div class="container">
		    	<p>
		    	<label for="role" style="text-align: center;"><b>Role: </b></label>
                  <select onchange="showbutton()" name="role" id="role">
                  	<option value="-" selected="selected">-</option>
                    <option value="systemadmin">System Admnistrator</option>
                    <option value="planner">Planner</option>
                </select>
            	</p>
                <br>
			    <label for="email"><b>E-mail</b></label>
			    <input type="email" placeholder="Enter E-mail" name="email" >

			    <label for="psw"><b>Password</b></label>
			    <input type="password" placeholder="Enter Password" name="psw" >
			        
			    <button type="submit">Login</button>
   		     
		  </form>
		  <button id="sysadmin" style="display: none;"><a href="addsystemadmin.php">New System Administrator</a></button>
		  </div>
		</div>

    	<div class="footer" style="position: absolute;">
                <h2>Team 5</h2>
        </div>
    </body>
    <script>
		function showbutton(){

			var x = document.getElementById("role").selectedIndex;
  			var y = document.getElementsByTagName("option")[x].value;
  			if(y=='systemadmin'){
				document.getElementById('sysadmin').style.display="block";
			}
			else{
				document.getElementById('sysadmin').style.display="none";
			}
		}

	</script>
</html>    