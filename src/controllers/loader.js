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
                  let name = obj.name.replace(/;/ig, "<br>");
                  row = row.replace(/{Description}/ig, name);
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
                let staticHtml = $("#intervDescription-row-template").html();

                $.each(data, function (index, obj) {
                  let row = staticHtml;
                  row = row.replace(/{intdescription}/ig, obj.intdescription);
                  $('#intervDescription-rows').append(row);
                });

                /* When empty description*/
                if (data === null) {
                    let row = staticHtml;
                    row = row.replace(/{intdescription}/ig, "There is not a description ");
                    $('#intervDescription-rows').append(row);
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to load description");
            }

            if( !('error' in obj) ) {
                let data = JSON.parse(obj.result);
                let staticHtml = $("#workspace-row-template").html();

                $.each(data, function (index, obj) {
                  let row = staticHtml;
                  row = row.replace(/{workspacenotes}/ig, obj.workspacenotes);
                  $('#workspace-rows').append(row);
                });

                /* When empty notes*/
                if (data === null) {
                    let row = staticHtml;
                    row = row.replace(/{workspacenotes}/ig, "There are not notes ");
                    $('#workspace-rows').append(row);
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to load workspace notes");
            }
             if( !('error' in obj) ) {
                let data = JSON.parse(obj.result);
                let staticHtml = $("#skillsNeeded-row-template").html();

                $.each(data, function (index, obj) {
                  let row = staticHtml;
                  row = row.replace(/{skill}/ig, obj.skill);
                  $('#skillsNeeded-rows').append(row);
                });

                /* When empty skills*/
                if (data === null) {
                    let row = staticHtml;
                    row = row.replace(/{skill}/ig, "There are not skills ");
                    $('#skillsNeeded-rows').append(row);
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to load skills");
            }
            if( !('error' in obj) ) {
                let data = JSON.parse(obj.result);
                let staticHtml = $("#number").html();

                $.each(data, function (index, obj) {
                  let row = staticHtml;
                  row = row.replace(/{week}/ig, obj.week);
                  $('#numweek').append(row);
                });

                /* When empty week*/
                if (data === null) {
                    let row = staticHtml;
                    row = row.replace(/{week}/ig, "There is not a week ");
                    $('#numweek').append(row);
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to load week");
            }
            if( !('error' in obj) ) {
                let data = JSON.parse(obj.result);
                let staticHtml = $("#name").html();

                $.each(data, function (index, obj) {
                  let row = staticHtml;
                  row = row.replace(/{activityname}/ig, obj.activityname);
                  $('#activityname').append(row);
                });

                /* When empty week*/
                if (data === null) {
                    let row = staticHtml;
                    row = row.replace(/{activityname}/ig, "There is not an activity ");
                    $('#activityname').append(row);
                }
            }
            else {
                console.log(obj.error);
                alert("Impossible to load activity");
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
