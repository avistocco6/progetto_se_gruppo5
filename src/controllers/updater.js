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
                    alert("Successfully updated!")
                }
                else{
                    alert("Error during update!")
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
                    alert("Successfully updated!")
                }
                else{
                    alert("Error during update!")
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
                    alert("Successfully updated!")
                }
                else{
                    alert("Error during update!")
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
                    alert("Successfully updated!")
                }
                else{
                    alert("Error during update!")
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
                console.log(obj);
                if(obj['result']){
                    alert("Successfully updated!")
                }
                else{
                    alert("Error during update!")
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

function updateActivity() {
    let id =localStorage.getItem('id');
    let site= document.getElementById('site').value;
    let typology= document.getElementById('typology').value;
    let description= document.getElementById('description').value;
    let estimatedtime= document.getElementById('estimatedtime').value;
    let interruptible= document.getElementById('interruptible').value;
    let week= document.getElementById('week').value;
    let json_string = '{"id": ' + id + ', "idsite":' + '"' + site + '", "idtypology":'
        + '"' + typology + '", "description":' + '"' + description + '", "estimatedtime":' + '"' 
        + estimatedtime + '", "interruptible":' + interruptible + '", "week":' + week + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/updater.php',
        dataType: 'json',
        data: {functionname: "updateActivity", arguments: [json_string]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                console.log(obj);
                if(obj['result']){
                    alert("Successfully updated!")
                }
                else{
                    alert("Error during update!")
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
    document.getElementById('site').value = "";
    document.getElementById('typology').value = "";
    document.getElementById('description').value = "";
    document.getElementById('estimatedtime').value = "";
    document.getElementById('interruptible').value = "";
    document.getElementById('week').value = "";
}
