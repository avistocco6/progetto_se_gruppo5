function addMaterial() {
    let name = document.getElementById("material-name").value;
    let material = '{"name":' + '"' + name + '"}';
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
}

function addActivity() {
    let name = document.getElementById("activity-name").value;
    let activity = '{"name":' + '"' + name + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/saver.php',
        dataType: 'json',
        data: {functionname: "saveModel", arguments: [activity]},

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
                alert("Impossible to save activity!");
            }
        }
    });
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
}

function addProcedure() {
    let name = document.getElementById("procedure-name").value;
    let procedure = '{"name":' + '"' + name + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/saver.php',
        dataType: 'json',
        data: {functionname: "saveModel", arguments: [procedure]},

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
}

function addTypology() {
    let name = document.getElementById("typology-name").value;
    let typology = '{"name":' + '"' + name + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/saver.php',
        dataType: 'json',
        data: {functionname: "saveModel", arguments: [typology]},

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
}