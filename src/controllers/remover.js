
//removeMaterial can remove a specific material from the database, calling removeMaterial in models package, according to the MVC architecture 

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

//removeProcedure can remove a specific procedure from the database, calling removeProcedure in models package, according to the MVC architecture 
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
//removeSite can remove a specific site from the database, calling removeSite in models package, according to the MVC architecture 
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

//removeSkill can remove a specific skill from the database, calling removeSkill in models package, according to the MVC architecture 
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

//removeTypology can remove a specific typology from the database, calling removeTypology in models package, according to the MVC architecture 
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

//removeActivity can remove a specific planned activity from the database, calling removeActivity in models package, according to the MVC architecture 
function removeActivity() {
    var id =localStorage.getItem('id');
    id = '{"id": ' + id + '}';
    console.log(id);
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

//removeUser can remove a specific user from the database, calling removeUser in models package, according to the MVC architecture 
function removeUser() {
    let username =localStorage.getItem('username');
    console.log(username);
    user = '{"username": ' + '"' + username + '"}';
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
