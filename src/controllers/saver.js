function addMaterial() {
    let name = document.getElementById("material-name").value;
    let material = '{"name":' + '"' + name + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/saver.php',
        dataType: 'json',
        data: {functionname: "saveModel", arguments: [material]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                console.log(obj);
                if(obj == true){
                    alert("Successfully saved!")
                }
                else{
                    alert("Error during saving!")
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to save material!");
            }
        }
    });
}

function addSkill() {
    let name = document.getElementById("skill-name").value;
    let skill = '{"name":' + '"' + name + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/saver.php',
        dataType: 'json',
        data: {functionname: "saveModel", arguments: [skill]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                console.log(obj);
                if(obj == true){
                    alert("Successfully saved!")
                }
                else{
                    alert("Error during saving!")
                }
            }
            else {
                console.log(obj.error);
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
                console.log(obj);
                if(obj == true){
                    alert("Successfully saved!")
                }
                else{
                    alert("Error during saving!")
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to save activity!");
            }
        }
    });
}
