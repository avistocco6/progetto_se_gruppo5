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

function updateSkill(id, name) {
    let json_string = '{"id": ' + id + '"name":' + '"' + name + '"}';
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
}

function updateSite(id, name) {
    let json_string = '{"id": ' + id + '"name":' + '"' + name + '"}';
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
}

function updateTypology(id, name) {
    let json_string = '{"id": ' + id + '"name":' + '"' + name + '"}';
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
}

function updateProcedure(id, name) {
    let json_string = '{"id": ' + id + '"name":' + '"' + name + '"}';
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
}

