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


function loadSites() {
    jQuery.ajax({
        type: "POST",
        url: '../models/loader.php',
        dataType: 'json',
        data: {functionname: "loadSites", arguments: []},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                let data = JSON.parse(obj.result);
                let staticHtml = $("#sites-row-template").html();

                $.each(data, function (index, obj) {
                  let row = staticHtml;
                    row = row.replace(/{Id}/ig, obj.id);
                    row = row.replace(/{Branch}/ig, obj.factory);
                    row = row.replace(/{Department}/ig, obj.area);
                    $('#sites-rows').append(row);
                });

                /* When empty sites */
                if (data === null) {
                    let row = staticHtml;
                    row = row.replace(/{Sites}/ig, "There are no sites");
                    $('#sites-rows').append(row);
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to load sites");
            }
        }
    });
}


function loadTypology() {
    jQuery.ajax({
        type: "POST",
        url: '../models/loader.php',
        dataType: 'json',
        data: {functionname: "loadTypologies", arguments: []},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                let data = JSON.parse(obj.result);
                let staticHtml = $("#typology-row-template").html();

                $.each(data, function (index, obj) {
                  let row = staticHtml;
                  row = row.replace(/{Description}/ig, obj.description);
                  $('#typology-rows').append(row);
                });

                /* When empty sites */
                if (data === null) {
                    let row = staticHtml;
                    row = row.replace(/{Typology}/ig, "There are no typology");
                    $('#typology-rows').append(row);
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to load typology");
            }
        }
    });
}

function loadProcedures() {
    jQuery.ajax({
        type: "POST",
        url: '../models/loader.php',
        dataType: 'json',
        data: {functionname: "loadProcedures", arguments: []},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                let data = JSON.parse(obj.result);
                let staticHtml = $("#procedures-row-template").html();

                $.each(data, function (index, obj) {
                  let row = staticHtml;
                  row = row.replace(/{Description}/ig, obj.description);
                  row = row.replace(/{ID}/ig, obj.activity_id);
                  $('#procedures-rows').append(row);
                });

                /* When empty sites */
                if (data === null) {
                    let row = staticHtml;
                    row = row.replace(/{Typology}/ig, "There are no procedures");
                    $('#procedures-rows').append(row);
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to load procedures");
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


function loadPlanned(week) {
    let json = '{ "week":' + week + ', "type": "planned activity"}';
    jQuery.ajax({
        type: "POST",
        url: '../models/loader.php',
        dataType: 'json',
        data: {functionname: "loadPlanned", arguments: [json]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                let data = JSON.parse(obj.result);
                let staticHtml = $("#activities-row-template").html();

                $.each(data, function (index, obj) {
                  let row = staticHtml;
                  row = row.replace(/{ID}/ig, obj.id);
                  row = row.replace(/{Area}/ig, obj.area);
                  row = row.replace(/{Type}/ig, obj.type);
                  row = row.replace(/{EstimatedTime}/ig, obj.estimated_time);
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
