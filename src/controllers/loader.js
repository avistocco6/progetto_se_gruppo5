function loadMaterials() {
    jQuery.ajax({
        type: "POST",
        url: '../models/loader.php',
        dataType: 'json',
        data: {functionname: "loadModels", arguments: []},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                let data = JSON.parse(obj.result);
                let staticHtml = $("#materials-row-template").html();

                $.each(data, function (index, obj) {
                  let row = staticHtml;
                  console.log(obj.name);
                  row = row.replace(/{Material}/ig, obj.name);
                  $('#materials-rows').append(row);
                });

                /* When empty material */
                if (data.length === 0) {
                    $("tfoot :first-child").hide();
                    $("tfoot").html('<tr><th>No records</th></tr>');
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to load materials");
            }
        }
    });
}