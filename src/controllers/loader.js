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
                  row = row.replace(/{ID}/ig, obj.id);
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
                  row = row.replace(/{ID}/ig, obj.id);
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
                    row = row.replace(/{ID}/ig, obj.id);
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
                  row = row.replace(/{ID}/ig, obj.id);
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
                  row = row.replace(/{ID}/ig, obj.id);
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
                localStorage.setItem('name', data.id +
                    " - " + data.site + " - " + data.typology + " - " + data.time);
                $("#workspace-rows").append(workspaceNotes);
                $("#intervDescription-rows").append(desc);

                $.each(data.skills, function(index, obj) {
                  let row = skill;
                  row = row.replace(/{Skill}/ig, obj.name);
                  $('#skillsNeeded-rows').append(row);
                });
                /* When empty activity */
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

    function loadUsers() {
        let role = document.getElementById("role").value;
        jQuery.ajax({
            type: "POST",
            url: '../models/loader.php',
            dataType: 'json',
            data: {functionname: "loadUsers", arguments: []},

            success: function (obj, textstatus) {
                if( !('error' in obj) ) {
                    let data = JSON.parse(obj.result);
                    let staticHtml = $("#users-row-template").html();

                    $.each(data, function (index, obj) {
                        if(obj.role == role) {
                            let row = staticHtml;
                            row = row.replace(/{Username}/ig, obj.username);
                            row = row.replace(/{Name}/ig, obj.name);
                            row = row.replace(/{Email}/ig, obj.email);
                            row = row.replace(/{Password}/ig, obj.password);

                            $('#users-rows').append(row);
                        }
                    });

                    /* When empty user */
                    if (data === null) {
                        alert("There are no users!")
                    }
                }
                else {
                    console.log(obj.error);
                    alert("Impossible to load users");
                }
            }
        });
    }


    function loadDailyAvail() {
        let id = localStorage.getItem('id');
        id = '{"id":' + id + "}";
        jQuery.ajax({
            type: "POST",
            url: '../models/loader.php',
            dataType: 'json',
            data: {functionname: "loadDailyAvail", arguments: [id]},

            success: function (obj, textstatus) {
                if (!('error' in obj)) {
                    let data = JSON.parse(obj.result);
                    let workspaceNotes = $("#workspace-row-template").html();
                    let mainAvail = $("maint-availab-template").html;
                    workspaceNotes = workspaceNotes.replace(/{Workspace Notes}/ig, data.workspaceNotes);
                    $("#workspace-rows").append(workspaceNotes);

                    document.getElementById("numWeek").innerHTML = data.week;
                    document.getElementById("dayName").innerHTML = data.day;
                    document.getElementById("activityName").innerHTML = data.id +
                        " - " + data.site + " - " + data.typology + " - " + data.time;

                    $('#maint-availab-rows').children().remove();

                    $.each(data, function (index, obj) {
                        let row = mainAvail;
                        row = row.replace(/{MainName}/ig, obj.mainname);
                        row = row.replace(/{NumSkill}/ig, obj.numskill);
                        row = row.replace(/{Availab8}/ig, obj.availab8);
                        row = row.replace(/{Availab9}/ig, obj.availab9);
                        row = row.replace(/{Availab10}/ig, obj.availab10);
                        row = row.replace(/{Availab11}/ig, obj.availab11);
                        row = row.replace(/{Availab14}/ig, obj.availab14);
                        row = row.replace(/{Availab15}/ig, obj.availab15);
                        row = row.replace(/{Availab16}/ig, obj.availab16);
                        $('#maint-availab-rows').append(row);
                    });

                    // When empty availability
                    if (data === null) {
                        alert("Error with maintainer chosen!")
                    }
                } else {
                    console.log(obj.error);
                    alert("Impossible to load maintainer's availability");
                }
            }
        });
    }

    function loadWeekPercentage() {
        let id = localStorage.getItem("id");
        let week = localStorage.getItem('week');
        let json = '{"week":' + week + ',"id":' + id + "}";
        console.log(json);
        jQuery.ajax({
            type: "POST",
            url: '../models/loader.php',
            dataType: 'json',
            data: {functionname: "loadWeekPercentage", arguments: [json]},

            success: function (obj, textstatus) {
                let data = JSON.parse(obj);
                if(data['error'] == 0) {
                    let skills = data['skills'];
                    let maintainerInfo = data['maintainers'];
                    let skills_template = $("#skillsNeeded-row-template").html();
                    let maintainerInfo_template = $("#maint-availab-template").html();

                    $.each(skills, function (index, obj) {
                        let row = skills_template;
                        row = row.replace(/{Skill}/ig, obj.skill);
                        $('#skillsNeeded-rows').append(row);
                    });
                    /* When empty skills */
                    if (skills.length == 0) {
                        let row = skills_template;
                        row = row.replace(/{Skill}/ig, "No specific skill needed");
                        $('#skillsNeeded-rows').append(row);
                    }

                    var currUser = "";
                    var rows = [];
                    $.each(maintainerInfo, function (index, obj) {
                        let row = maintainerInfo_template;

                        if (currUser != obj.username) {
                            // if some days are not present in db
                            if(currUser != ""){
                                rows[currUser] = rows[currUser].replace(/{Mon}/ig, "0%");
                                rows[currUser] = rows[currUser].replace(/{Tue}/ig, "0%");
                                rows[currUser] = rows[currUser].replace(/{Wed}/ig, "0%");
                                rows[currUser] = rows[currUser].replace(/{Thu}/ig, "0%");
                                rows[currUser] = rows[currUser].replace(/{Fri}/ig, "0%");
                                rows[currUser] = rows[currUser].replace(/{Sat}/ig, "0%");
                                rows[currUser] = rows[currUser].replace(/{Sun}/ig, "0%");
                                $('#maint-availab-rows').append(rows[currUser]);
                            }
                            rows[obj.username] = row;
                            currUser = obj.username;
                            rows[currUser] = rows[currUser].replace(/{MainName}/ig, currUser);
                            rows[currUser] = rows[currUser].replace(/{NumSkill}/ig, obj.skillsAcquired);
                        }


                        var d = new Date(obj.day);
                        var day = d.getDay();
                        switch (day) {
                            case 1:
                                rows[currUser] = rows[currUser].replace(/{Mon}/ig, obj.availab);
                                break;
                            case 2:
                                rows[currUser] = rows[currUser].replace(/{Tue}/ig, obj.availab);
                                break;
                            case 3:
                                rows[currUser] = rows[currUser].replace(/{Wed}/ig, obj.availab);
                                break;
                            case 4:
                                rows[currUser] = rows[currUser].replace(/{Thu}/ig, obj.availab);
                                break;
                            case 5:
                                rows[currUser] = rows[currUser].replace(/{Fri}/ig, obj.availab);
                                break;
                            case 6:
                                rows[currUser] = rows[currUser].replace(/{Sat}/ig, obj.availab);
                                break;
                            case 0:
                                rows[currUser] = rows[currUser].replace(/{Sun}/ig, obj.availab);
                                break;
                        }
                    });
                    $('#maint-availab-rows').append(rows[currUser]);
                    /* When empty skills */
                    if (maintainerInfo-length == 0) {
                        alert("No maintainer avaible on this week!");
                    }

                }
                else {
                    console.log(obj.error);
                    alert("Impossible to load maintainer's availability");
                }
            }
        });
    }


