//updateMaterial allows to modify material, calling updateMaterial from models package, according to MVC Architecture
function updateMaterial() {
    let id =localStorage.getItem('id');
    let name = document.getElementById('new-material').value;
    let json_string = '{"id": ' + id + ',"name":' + '"' + name + '"}';
    console.log(json_string);
    jQuery.ajax({
        type: "POST",
        url: '../models/updater.php',
        dataType: 'json',
        data: {functionname: "updateMaterial", arguments: [json_string]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully updated!");
                }
                else{
                    alert("Error during update!");
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to update material!");
            }
        }
    });
    document.getElementById("new-material").value = "";
}
//updateSkill allows to modify a skill, calling updateSkill from models package, according to MVC Architecture

function updateSkill() {
    let id =localStorage.getItem('id');
    let name = document.getElementById('new-skill').value;
    let json_string = '{"id": ' + id + ',"name":' + '"' + name + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/updater.php',
        dataType: 'json',
        data: {functionname: "updateSkill", arguments: [json_string]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                console.log(obj);
                if(obj['result']){
                    alert("Successfully updated!");
                }
                else{
                    alert("Error during update!");
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to update skills!");
            }
        }
    });
    document.getElementById("new-skill").value = "";
}
//updateSite allows to modify factory and area, calling updateSite from models package, according to MVC Architecture
function updateSite() {
    let id =localStorage.getItem('id');
    let factory= document.getElementById('factory').value;
    let area= document.getElementById('area').value;
    let json_string = '{"id": ' + id + ', "factory":' + '"' + factory + '", "area":'
        + '"' + area + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/updater.php',
        dataType: 'json',
        data: {functionname: "updateSite", arguments: [json_string]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                console.log(obj);
                if(obj['result']){
                    alert("Successfully updated!");
                }
                else{
                    alert("Error during update!");
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to update sites!");
            }
        }
    });
    document.getElementById("area").value = "";
    document.getElementById("factory").value = "";
}
//updateTypology allows to modify typology of an activity, calling updateTypology from models package, according to MVC Architecture
function updateTypology() {
    let id =localStorage.getItem('id');
    let description= document.getElementById('new-typology').value;
    let json_string = '{"id": ' + id + ', "description":' + '"' + description + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/updater.php',
        dataType: 'json',
        data: {functionname: "updateTypology", arguments: [json_string]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                console.log(obj);
                if(obj['result']){
                    alert("Successfully updated!");
                }
                else{
                    alert("Error during update!");
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to update typology!");
            }
        }
    });
    document.getElementById("new-typology").value = "";
}
//updateProcedure allows to modify description of a procedure, calling updateProcedure from models package, according to MVC Architecture
function updateProcedure() {
    let id =localStorage.getItem('id');
    let description= document.getElementById('new-procedure').value;
    let json_string = '{"id": ' + id + ',"description":' + '"' + description + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/updater.php',
        dataType: 'json',
        data: {functionname: "updateProcedure", arguments: [json_string]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully updated!");
                }
                else{
                    alert("Error during update!");
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to update procedure!");
            }
        }
    });
    document.getElementById("new-procedure").value = "";
}

//updateActivity can modify all the information about a planned activity, calling updateActivity from models package, according to MVC Architecture
function updateActivity() {
    let id =localStorage.getItem('id');
    let typology = document.getElementById("typology-rows").selectedIndex+1;
    typology = 0 ? typology == -1 : typology;
    let description = document.getElementById("description").value;
    let time = document.getElementById("estimatedtime").value;
    //var material = document.getElementById("materials-rows").value;
    //material = material.options[selectedIndex].value;
    let week = document.getElementById("week").selectedIndex+1;
    week = 0 ? week == -1 : week;
    let idsite = document.getElementById("sites-rows").selectedIndex+1;
    idsite = 0 ? idsite == -1 : idsite;
    var isInterrupt = $("input[name=yes_no]:checked").val()
    isInterrupt = false ? isInterrupt == "No" : true;

    let activity = '{"maid":' + id + ', "site_id":' + idsite + ', "description":' + '"' + description +
                    '", "estimated_time":' + '"' + time +
                    '", "interruptible": ' + isInterrupt +
                    ', "typology_id":' + typology +
                    ', "week":' + week +
                    ',"mtype": "planned activity"}';

    console.log(activity);

    jQuery.ajax({
        type: "POST",
        url: '../models/updater.php',
        dataType: 'json',
        data: {functionname: "updateActivity", arguments: [activity]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully updated!");
                }
                else{
                    alert("Error during update!");
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to update activity!");
            }
        }
    });

    document.getElementById('description').value = "";
    document.getElementById('estimatedtime').value = "";
}
//updateUser allows to modify email and/or password of the user, calling updateEmail/updatePassword from models package, according to MVC Architecture
function updateUser() {
    let username =localStorage.getItem('username');
    let email = document.getElementById("email").value;
    let psw = document.getElementById("psw").value;
    let json_email = '{"username": ' + '"' + username + '"' + ',"email":' + '"' + email + '"}';
    let json_psw = '{"username": ' + '"' + username + '"' + ',"password":' + '"' + psw + '"}';

    if(email != "")
        jQuery.ajax({
            type: "POST",
            url: '../models/updater.php',
            dataType: 'json',
            data: {functionname: "updateEmail", arguments: [json_email]},

            success: function (obj, textstatus) {
                if( !('error' in obj) ) {
                    console.log(obj);
                    if(obj['result']){
                        alert("Successfully updated!");
                    }
                    else{
                        alert("Error during update!");
                    }
                }
                else {
                    console.log(obj.error);
                    alert("Impossible to update email!");
                }
            }
        });
    document.getElementsByName("email").value = "";
    if(psw != "")
        jQuery.ajax({
            type: "POST",
            url: '../models/updater.php',
            dataType: 'json',
            data: {functionname: "updatePassword", arguments: [json_psw]},

            success: function (obj, textstatus) {
                if( !('error' in obj) ) {
                    console.log(obj);
                    if(obj['result']){
                        alert("Successfully updated!");
                    }
                    else{
                        alert("Error during update!");
                    }
                }
                else {
                    console.log(obj.error);
                    alert("Impossible to update password!");
                }
            }
        });
    document.getElementsByName("psw").value = "";
}