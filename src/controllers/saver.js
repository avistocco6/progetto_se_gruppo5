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

function addActivity(){

   let typology = document.getElementById("typology").value;
   let description = document.getElementById("description").value;
   let time = document.getElementById("time").value;
   let material = document.getElementById("material").value;
   let intAct = document.getElementById("interruption").value;
   let week = document.getElementById("week").value;

   let activity = '{"description":' + '"' + description +
                    '", "estimatedTime":' + '"' + time +
                    '", "interruptible": '+ '"' + intAct +
                    '", "idtypology":' + '"' + type +
                    '", "week":' + '"' + week +
                    '"}';

   jQuery.ajax({
        type: "POST",
        url: '../models/updater.php',
        dataType: 'json',
        data: {functionname: "saveActivity", arguments: [activity]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                console.log(obj);
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


    document.getElementById('typology').value = "";
    document.getElementById('description').value = "";
    document.getElementById('estimatedtime').value = "";
    document.getElementById('interruptible').value = "";
    document.getElementById('week').value = "";
}
