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
                    alert("There are no materials!")
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
                    alert("There are no skills!")
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
                    row = row.replace(/{Branch}/ig, obj.factory);
                    row = row.replace(/{Department}/ig, obj.area);
                    $('#sites-rows').append(row);
                });

                /* When empty sites */
                if (data === null) {
                    alert("There are no sites!")
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
                    alert("There are no typoloies!")
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
                  let name = obj.name.replace(/;/ig, "<br>");
                  row = row.replace(/{Description}/ig, name);
                  $('#procedures-rows').append(row);
                });
                /* When empty sites */
                if (data === null) {
                    alert("There are no procedures!")
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
                let workspaceNotes = $("#workspace-row-template").html();
                let description = $("intervDescription-row-template");
                let skill = $("skillsNeeded-row-template");

                workspaceNotes = workspaceNotes.replace(/{Workspace Notes}/ig, data.workspaceNotes);
                description = description.replace(/{Intervention Description}/ig, data.description);

                $("numweek").append(data.week);
                $("activityname").append(data.activity);
                $("workspace-rows").append(workspaceNotes);
                $("intervDescription-rows").append(description);

                $.each(data.skills, function(index, obj) {
                  let row = skill;
                  row = row.replace(/{Skill}/ig, obj.name);
                  $('#skillsNeeded-rows').append(row);
                });
                /* When empty sites */
                if (data === null) {
                    alert("Error with activity chosen!")
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to load procedures");
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
                    alert("There are no activities!")
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to load activities");
            }
        }
    });
}
