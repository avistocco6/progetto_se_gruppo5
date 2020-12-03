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
    let id =localStorage.getItem('id');
    id = '{"id":' + id + "}";
    jQuery.ajax({
        type: "POST",
        url: '../models/loader.php',
        dataType: 'json',
        data: {functionname: "loadSelected", arguments: [id]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                let data = JSON.parse(obj.result);

                let workspaceNotes = $("#workspace-row-template").html();
                let desc = $("#intervDescription-row-template").html();
                let skill = $("#skillsNeeded-row-template").html();

                workspaceNotes = workspaceNotes.replace(/{Workspace Notes}/ig, data.workspaceNotes);
                desc = desc.replace(/{Intervention Description}/ig, data.description);

                document.getElementById("numWeek").innerHTML = data.week;
                document.getElementById("activityName").innerHTML  = data.id +
                    " - " + data.site + " - " + data.typology + " - " + data.time;
                $("#workspace-rows").append(workspaceNotes);
                $("#intervDescription-rows").append(desc);

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
            if (!('error' in obj)) {
                let data = JSON.parse(obj.result);
                let staticHtml = $("#activities-row-template").html();

                $('#activities-rows').children().remove();

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
            } else {
                console.log(obj.error);
                alert("Impossible to load activities");
            }
        }
    });
}
    function loadWeeks() {
        jQuery.ajax({
            type: "POST",
            url: '../models/loader.php',
            dataType: 'json',
            data: {functionname: "loadWeeks", arguments: []},

            success: function (obj, textstatus) {
                if( !('error' in obj) ) {
                    let data = JSON.parse(obj.result);
                    let staticHtml = $("#week-template").html();

                    $.each(data, function (index, obj) {
                        let option = staticHtml;
                        option = option.replace(/{Week}/ig, obj.week);
                        $('#week-select').append(option);
                    });
                    let week = document.getElementById('week-select').options[0].text;
                    loadPlanned(week);
                    /* When empty sites */
                    if (data === null) {
                        alert("There are no activities planned!");
                    }
                }
                else {
                    console.log(obj.error);
                    alert("Impossible to load weeks!");
                }
            }
        });
}