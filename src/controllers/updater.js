function updateMaterial(id, name) {
    let json_string = '{"id": ' + id + '"name":' + '"' + name + '"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/updater.php',
        dataType: 'json',
        data: {functionname: "updateMaterial", arguments: [json_string]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                console.log(obj);
                if(obj == true){
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
}