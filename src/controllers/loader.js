function loadMaterials() {
    jQuery.ajax({
        type: "POST",
        url: '../models/loader.php',
        dataType: 'json',
        data: {functionname: "loadMaterials", arguments: []},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                let data = JSON.parse(obj.result);
                let staticHtml = $("#materials-row-template").html();

                $.each(data, function (index, obj) {
                  let row = staticHtml;
                  row = row.replace(/{Material}/ig, obj.name);
                  $('#materials-rows').append(row);
                });

                /* When empty material */
                if (data === null) {
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

function loadSkills() {
    jQuery.ajax({
        type: "POST",
        url: '../models/loader.php',
        dataType: 'json',
        data: {functionname: "loadSkills", arguments: []},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                let data = JSON.parse(obj.result);
                let staticHtml = $("#skills-row-template").html();

                $.each(data, function (index, obj) {
                  let row = staticHtml;
                  row = row.replace(/{Skill}/ig, obj.name);
                  $('#skills-rows').append(row);
                });

                /* When empty skill */
                if (data === null) {
                    let row = staticHtml;
                    row = row.replace(/{Skill}/ig, "There are no skills");
                    $('#skills-rows').append(row);
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to load skills");
            }
        }
    });
}

