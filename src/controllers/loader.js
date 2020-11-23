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
                if (data === null) {
                    console.log("THERE")
                    let row = staticHtml;
                    row = row.replace(/{Material}/ig, "There are no materials");
                    $('#materials-rows').append(row);
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to load materials");
            }
        }
    });
}