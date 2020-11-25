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

function loadSelected() {
    jQuery.ajax({
        type: "POST",
        url: '../models/loader.php',
        dataType: 'json',
        data: {functionname: "loadSelected", arguments: []},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                let data = JSON.parse(obj.result);
                let staticHtml1 = $("#workspace-row-template").html();
                let staticHtml2 = $("#intervDescription-row-template").html();
                let staticHtml3 = $("#skillsNeeded-row-template").html();

                $.each(data, function (index, obj) {
                /* Workspace notes */
                    let row1 = staticHtml1;
                    row1 = row1.replace(/{Workspace Notes}/ig, obj.name);
                    $('#workspace-rows').append(row1);

                /* Intervention Description */
                    let row2 = staticHtml2;
                    row2 = row2.replace(/{Intervention Description}/ig, obj.name);
                    $('#intervDescription-rows').append(row2);

                /* Skills Needed */
                    let row3 = staticHtml3;
                    row3 = row3.replace(/{Skills Needed}/ig, obj.name);
                    $('#skillsNeeded-rows').append(row3);
                });

                /* When empty workspace notes, intervention description or  */
                if (data === null) {
                    let row1 = staticHtml1;
                    row1 = row1.replace(/{Workspace Notes}/ig, "There are no workspace notes");
                    $('#workspace-rows').append(row1);

                    let row2 = staticHtml2;
                    row2 = row2.replace(/{Intervention Description}/ig, "There are no Intervention Description");
                    $('#intervDescription-rows').append(row2);

                    let row3 = staticHtml3;
                    row3 = row3.replace(/{Skills Needed}/ig, "There are no Skills Needed");
                    $('#skillsNeeded-rows').append(row3);
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to load the tables");
            }

        }
    });
}


function loadActivities() {
    jQuery.ajax({
        type: "POST",
        url: '../models/loader.php',
        dataType: 'json',
        data: {functionname: "loadActivities", arguments: []},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                let data = JSON.parse(obj.result);
                let staticHtml = $("#activities-row-template").html();

                $.each(data, function (index, obj) {
                  let row = staticHtml;
                  row = row.replace(/{Activity}/ig, obj.name);
                  $('#activities-rows').append(row);
                });

                /* When empty activity */
                if (data === null) {
                    let row = staticHtml;
                    row = row.replace(/{Activity}/ig, "There are no activities");
                    $('#activities-rows').append(row);
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to load activities");
            }
        }
    });
}
