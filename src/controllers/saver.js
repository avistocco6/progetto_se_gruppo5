//addMaterial takes data from view and calls saveMaterial function in models package to store information 
//in the database, according to the MVC architecture 

function addMaterial() {
    let name = document.getElementById("new-material").value;
    let material = '{"name":' + '"' + name + '", "activity": null}';
    jQuery.ajax({
        type: "POST",
        url: '../models/saver.php',
        dataType: 'json',
        data: {functionname: "saveMaterial", arguments: [material]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully saved!")
                }
                else{
                    alert("Error during saving!")
                }
            }
            else {
                alert("Impossible to save material!");
            }
        }
    });
    document.getElementById("new-material").value = "";
}

//addSkill takes data from view and calls saveSkill function in models package to store information 
//in the database, according to the MVC architecture 
function addSkill() {
    let name = document.getElementById("new-skill").value;
    let skill = '{"name":' + '"' + name + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/saver.php',
        dataType: 'json',
        data: {functionname: "saveSkill", arguments: [skill]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully saved!")
                }
                else{
                    alert("Error during saving!")
                }
            }
            else {
                alert("Impossible to save skill!");
            }
        }
    });
    document.getElementById("new-skill").value = "";
}


//addSite takes data from view and calls saveSite function in models package to store information 
//in the database, according to the MVC architecture 
function addSite() {
    let factory = document.getElementById("factory").value;
    let area = document.getElementById("area").value;
    let site = '{"branch":' + '"' + factory + '", "department":' + '"'+
                area + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/saver.php',
        dataType: 'json',
        data: {functionname: "saveSite", arguments: [site]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully saved!")
                }
                else{
                    alert("Error during saving!")
                }
            }
            else {
                alert("Impossible to save site!");
            }
        }
    });
    document.getElementById("factory").value = "";
    document.getElementById("area").value = "";
}

//addProcedure takes data from view and calls saveProcedure function in models package to store information
//in the database, according to the MVC architecture 
function addProcedure() {
    let desc = document.getElementById("new-procedure").value;
    let procedure = '{"description":' + '"' + desc + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/saver.php',
        dataType: 'json',
        data: {functionname: "saveProcedure", arguments: [procedure]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully saved!")
                }
                else{
                    alert("Error during saving!")
                }
            }
            else {
                alert("Impossible to save procedure!");
            }
        }
    });
    document.getElementById("new-procedure").value = "";
}

//addTypology takes data from view and calls saveTypology function in models package to store information
//in the database, according to the MVC architecture 
function addTypology() {
    let name = document.getElementById("new-typology").value;
    let typology = '{"description":' + '"' + name + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/saver.php',
        dataType: 'json',
        data: {functionname: "saveTypology", arguments: [typology]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully saved!")
                }
                else{
                    alert("Error during saving!")
                }
            }
            else {
                alert("Impossible to save typology!");
            }
        }
    });
    document.getElementById("new-typology").value = "";
}

//addActivity takes data from view and calls saveActivity function in models package to store information
//in the database, according to the MVC architecture 

function addActivity(){

   let typology = document.getElementById("typology-rows").selectedIndex+1;
   typology = 0 ? typology == -1 : typology;
   let description = document.getElementById("description").value;
   let time = document.getElementById("time").value;
   //var material = document.getElementById("materials-rows").value;
   //material = material.options[selectedIndex].value;
   let week = document.getElementById("week").selectedIndex+1;
   week = 0 ? week == -1 : week;
   let idsite = document.getElementById("sites-rows").selectedIndex+1;
   idsite = 0 ? idsite == -1 : idsite;
   var isInterrupt = $("input[name=yes_no]:checked").val()
   isInterrupt = false ? isInterrupt == "No" : true;

   let activity = '{"site_id":' + idsite + ', "description":' + '"' + description +
                    '", "estimatedTime":' + '"' + time +
                    '", "interruptible": ' + isInterrupt +
                    ', "typology_id":' + typology +
                    ', "week":' + week +
                    ',"mtype": "planned activity"}';
    console.log(activity);
   jQuery.ajax({
        type: "POST",
        url: '../models/saver.php',
        dataType: 'json',
        data: {functionname: "saveActivity", arguments: [activity]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully added!")
                }
                else{
                    alert("Error during add!")
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to add activity!");
            }
        }
    });

    document.getElementById('description').value = "";
    document.getElementById('time').value = "";
}

//addUser takes data from view and calls saveUser function in models package to store information
//in the database, according to the MVC architecture 

function addUser() {
    let username = document.getElementById("username").value;
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let psw = document.getElementById("password").value;
    let role = document.getElementById("role").value;
    let user = '{"username":' + '"' + username + '"' + ', "name":' + '"'
        + name + '"' + ', "email":' + '"' + email + '"' + ', "psw":' + '"' + psw + '"'
        + ', "role":' + '"' + role + '"' + '}';
    jQuery.ajax({
        type: "POST",
        url: '../models/saver.php',
        dataType: 'json',
        data: {functionname: "saveUser", arguments: [user]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully saved!")
                }
                else{
                    alert("Error during saving!")
                }
            }
            else {
                alert("Impossible to save user!");
            }
        }
    });
    document.getElementsByName("username").value = "";
    document.getElementsByName("name").value = "";
    document.getElementsByName("email").value = "";
    document.getElementsByName("psw").value = "";
}

//assignSkill allow to assign a particular skill to a maintainer, calling assignSkill in models package according to the MVC architecture 

function assignSkill() {
    let username = localStorage.getItem('username');
    let skill = document.getElementsByName("skill").value;
    let skillAssign = '{"username": ' + '"' + username + '"' + ',"skillname":' + '"' + skill + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/saver.php',
        dataType: 'json',
        data: {functionname: "assignSkill", arguments: [skillAssign]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully saved!")
                }
                else{
                    alert("Error during saving!")
                }
            }
            else {
                alert("Impossible to assign skill!");
            }
        }
    });

}