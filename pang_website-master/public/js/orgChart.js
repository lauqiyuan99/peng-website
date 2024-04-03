$(document).ready(function () {
    const seperateURL = location.href.split('/');
    const id = seperateURL[4];
    fetchFamiliyList(id);
    downLoadPDF(id);
});

function fetchFamiliyList(id) {
    const url = "/fetch-family-list/" + id
    $.ajax({
        type: 'GET',
        url: url,
        datatype: "json",
        success: function (response) {
            googleOrgChartInitialization(response.familiylist);
            console.log(response.familiylist);
        },
        error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            console.log(msg);
        }
    });
}

function googleOrgChartInitialization(familiylist) {
    google.charts.load('current', { packages: ["orgchart"] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name'); // Can be refer by child 
        data.addColumn('string', 'ParentName'); // Current record Parent Name
        data.addColumn('string', 'ToolTip'); // when you cursor hover to it, display the value
        //Mapping value
        mappingValue(data, familiylist);
    }

}

function mappingValue(data, arr) {
    $.each(arr, function (key, value) {
        var spouse_avatar = value.spouse_avatar == 'noimage.jpg' && value.spouse_name == null ? "display:none" : value.spouse_avatar;
        var seperateURL = location.href.split('/');
        var correctUrl = seperateURL[0] + '//' + seperateURL[1] + seperateURL[2] + '/' + 'image/avatar/';
        var avatar = correctUrl + value.avatar;
        var spouseImg = correctUrl + value.spouse_avatar;
        var state = value.state ? value.state : '-';
        var nationality = value.nationality ? value.nationality : '-';
        var seniority = value.seniority ? value.seniority : '-';

        // var address = value.address ? value.address : '-' // for future usage

        data.addRows([
            [{
                v: value.name,
                'f': '<a href="/history/' + value.id + '">' +
                    '<div id = "referUsage" class="scrollTo' + value.id + '" data-id="'+value.id+'">' +
                    '<div class="image d-flex flex-row justify-content-center align-items-center" id="firstRow">' +
                    '<img class="mr-3" id="parent_avatar"src="' + avatar + '" height="100" width="100" />' +
                    '<img class="mr-3" id="spouse_avatar" src="' + spouseImg + '" height="100" width="100" style="' + spouse_avatar + '">' +
                    '</div>' +
                    '<div class="image d-flex flex-column justify-content-center align-items-center" id="' + value.name.replace(/\s/g, '').replace("@", "-") + '">' +
                    '<div class="container bg-white text-dark mt-2" style="border-radius: 20px">' +
                    '<div class="row d-flex justify-content-center p-1">' +
                    '<div style="width: 80px;" class="justify-content-center" id="name">' + value.name + '<br/> (' + value.era + ') </div>' +
                    '<div style="width: 80px;" class="justify-content-center" id="spouse_name' + 0 + '"><p></p></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="container bg-white text-dark mt-2">' +
                    '<div class="row text-justify p-2">' +
                    '<div><b> 辈分 :</b>' + seniority + '</div>' +
                    '</div>' +
                    '<div class="row text-justify p-2">' +
                    '<div><b>国籍 :</b>' + nationality + '</div>' +
                    '</div>' +
                    '<div class="row text-justify p-2">' +
                    '<div><b>区域 :</b>' + state + '</div>' +
                    '</div>' +
                    '<div class="row text-justify p-2">' +
                    '<div><b>年份 :</b>' + value.dob_date + '</div>' +
                    '</div>' +
                    // '<div class="row text-justify p-2">' +
                    // '<div><b>地址 :</b>' + address + '</div>' +
                    // '</div>' + // for future usage
                    '</a>'
            }, value.parent_id, value.name]
        ]);
    })
    createChart(data);
    loopSpouseName(arr, false);
    // fixedFirstRowCss();
    // fixedImgCss();


    // $("#chartInputData").val($("#chart_div").html());
}


function createChart(data) {
    var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
    // Draw the chart, setting the allowHtml option to true for the tooltips.
    chart.draw(data, {
        'allowHtml': true,
        'allowCollapse': true,
        'size': 'medium',
        'color': '#FF0000'
    });
}


function fixedFirstRowCss() { // No use Anymore, So i did not call this function
    $('div#firstRow').each(function () {
        $(this).css('height', '104');
        $(this).css('width', '236');
        $(this).parent().css('width', '240');
        $(this).parent().css('height', '180');
    });
}

function fixedImgCss() { // No use Anymore, So i did not call this function
    $('img#spouse_avatar').each(function () {
        if ($(this).attr('src') == 'image/avatar/noimage.jpg' && $(this).parent().parent().find('div#spouse_name >p').text() == '')
            $(this).parent().find('img#parent_avatar').removeClass('mr-3');
    });
}

function loopSpouseName(arr, isDownloadPDF) { // Passing in as Object
    var spouseNameArr = [];
    for (var i = 0; i < arr.length; i++) {
        spouseNameArr[i] = {
            "Name": arr[i].name,
            "Spouse_Name": arr[i].spouse_name != null ? arr[i].spouse_name.split('|') : ""
        }
    }
    if (isDownloadPDF) {
        pdfAppendSpouseName(spouseNameArr);
        return;
    }
    appendSpouseName(spouseNameArr);
}
//Loop to html page
function appendSpouseName(spouseNameArr) {
    for (var i = 0; i < spouseNameArr.length; i++) {
        $('div#' + spouseNameArr[i].Name.replace(/\s/g, '').replace("@", "-")).each(function (index) {
            var currentContainer = $(this);
            for (var j = 0; j < spouseNameArr[i].Spouse_Name.length; j++) {
                if (j >= 1) {
                    currentContainer.find('div#spouse_name' + (j - 1) + '> p').after('<div style="width: 100px;" id="spouse_name' + j + '" class="mr-1"><p></p></div>');
                    // currentContainer.find('div#spouse_name'+j+'> p').text(spouseNameArr[i].Spouse_Name[j]);
                }
                currentContainer.find('div#spouse_name' + j + '> p').text(spouseNameArr[i].Spouse_Name[j]);
                // currentContainer.find('div#name').after('<div style="width: 100px;" id="spouse_name'+j+'" class="mr-1"><p></p></div>');  
            }
        });
    }
}

function downLoadPDF(id) {
    const url = "/fetch-family-list/" + id
    $.ajax({
        type: 'GET',
        url: url,
        datatype: "json",
        success: function (response) {
            google.charts.load('current', { packages: ["orgchart"] });
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Name'); // Can be refer by child 
                data.addColumn('string', 'ParentName'); // Current record Parent Name
                data.addColumn('string', 'ToolTip'); // when you cursor hover to it, display the value

                $.each(response.familiylist, function (key, value) {
                    data.addRows([
                        [{
                            v: value.name,
                            f: value.name +
                                '<div style="width: 100px; justify-content-center; text-justify; p-2;" class="mr-2" id="' + value.name.replace(/\s/g, '').replace("@", "-") + '">' +
                                '<div style="width: 100px; justify-content-center; text-justify; p-2;" class="mr-2" id="spouse_name' + 0 + '">配偶:<p></p></div>' +
                                '</div>'
                        },
                        value.parent_id, value.name]
                    ]);
                })



                // Create the chart.
                var chart = new google.visualization.OrgChart(document.getElementById('hiddenDiv'));
                // Draw the chart, setting the allowHtml option to true for the tooltips. 
                chart.draw(data, {
                    'allowHtml': true,
                    'size': 'small',
                });
                loopSpouseName(response.familiylist, true);

                $("#chartInputData").val($("#hiddenDiv").html());
                scrollToCurrentPerson(id);
                // $('div.scrollto' + id)[0].scrollIntoView();// scroll to the current user                         
            }
        }
    });
}

function pdfAppendSpouseName(spouseNameArr) {
    for (var i = 0; i < spouseNameArr.length; i++) {
        $('#hiddenDiv').find('div#' + spouseNameArr[i].Name.replace(/\s/g, '').replace("@", "-")).each(function (index) {
            var currentContainer = $(this);
            for (var j = 0; j < spouseNameArr[i].Spouse_Name.length; j++) {
                if (j >= 1) {
                    currentContainer.find('div#spouse_name' + (j - 1) + '> p').after('<div style="width: 100px;" id="spouse_name' + j + '" class="mr-1"><p></p></div>');

                }
                currentContainer.find('div#spouse_name' + j + '> p').text(spouseNameArr[i].Spouse_Name[j]);
            }
        });
    }   
}

function scrollToCurrentPerson(currentPersonID) {
    document.querySelectorAll('[data-id]').forEach(element => {
        if (element.dataset.id === currentPersonID) {
            element.scrollIntoView();
            return;
        }
    })
}


