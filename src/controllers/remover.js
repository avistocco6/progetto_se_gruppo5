function removeMaterial() {
    let id =localStorage.getItem('id');
    console.log(id);
    id = '{"id": ' + id + '}';
    jQuery.ajax({
        type: "POST",
        url: '../models/remover.php',
        dataType: 'json',
        data: {functionname: "removeMaterial", arguments: [id]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully deleted!");
                }
                else{
                    alert("Error during deletion!");
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to delete material!");
            }
        }
    });

}

function removeProcedure() {
    let id =localStorage.getItem('id');
    console.log(id);
    id = '{"id": ' + id + '}';
    jQuery.ajax({
        type: "POST",
        url: '../models/remover.php',
        dataType: 'json',
        data: {functionname: "removeProcedure", arguments: [id]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully deleted!");
                }
                else{
                    alert("Error during deletion!");
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to delete procedure!");
            }
        }
    });

}

function removeSite() {
    let id =localStorage.getItem('id');
    console.log(id);
    id = '{"id": ' + id + '}';
    jQuery.ajax({
        type: "POST",
        url: '../models/remover.php',
        dataType: 'json',
        data: {functionname: "removeSite", arguments: [id]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully deleted!");
                }
                else{
                    alert("Error during deletion!");
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to delete site!");
            }
        }
    });

}

function removeSkill() {
    let id =localStorage.getItem('id');
    console.log(id);
    id = '{"id": ' + id + '}';
    jQuery.ajax({
        type: "POST",
        url: '../models/remover.php',
        dataType: 'json',
        data: {functionname: "removeSkill", arguments: [id]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully deleted!");
                }
                else{
                    alert("Error during deletion!");
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to delete skill!");
            }
        }
    });

}

function removeTypology() {
    let id =localStorage.getItem('id');
    console.log(id);
    id = '{"id": ' + id + '}';
    jQuery.ajax({
        type: "POST",
        url: '../models/remover.php',
        dataType: 'json',
        data: {functionname: "removeTypology", arguments: [id]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully deleted!");
                }
                else{
                    alert("Error during deletion!");
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to delete typology!");
            }
        }
    });

}
function removeActivity() {
    let id =localStorage.getItem('id');
    console.log(id);
    id = '{"id": ' + id + '}';
    jQuery.ajax({
        type: "POST",
        url: '../models/remover.php',
        dataType: 'json',
        data: {functionname: "removeActivity", arguments: [id]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully deleted!");
                }
                else{
                    alert("Error during deletion!");
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to delete activity!");
            }
        }
    });

}
function removeUser() {
    let username =localStorage.getItem('username');
    console.log(user);
    user = '{"username": ' + username + '}';
    jQuery.ajax({
        type: "POST",
        url: '../models/remover.php',
        dataType: 'json',
        data: {functionname: "removeUser", arguments: [user]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                if(obj['result']){
                    alert("Successfully deleted!");
                }
                else{
                    alert("Error during deletion!");
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to delete user!");
            }
        }
    });

}
