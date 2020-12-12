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
