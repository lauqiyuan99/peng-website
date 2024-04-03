import  { getFamilyListData } from './person.js';


//Create an empty array
let family_list = [];
let spouse_list = [];

//Object Destructuring
const { origin: originUrl, pathname } = window.location;

//fetch data url
let url = `${originUrl}/fetch-family-list/${pathname.split('/')[2]}`;

//Url For Image Path
const imagePath = `${originUrl}/image/avatar/`;

// Holding Template
const spouse_name_template = document.getElementById('spouse-name-template');
const spouse_img_template = document.getElementById('spouse-img-template');

//Get FormControl
const chartDiv = document.getElementById('chart_div');
const hiddenDiv = document.getElementById('hiddenDiv');
const chartInputData = document.getElementById('chartInputData');

async function getFamilyList() {
    const response = await fetch(url);
    if (!response.ok) {
        const message = `An error has occured: ${response.status}`;
        throw new Error(message);
    }
    const data = await response.json();
    return data;
}

getFamilyList().then(data => {
    family_list = getFamilyListData(data.family_list);
    google.charts.load('current', { packages: ["orgchart"] });
    google.charts.setOnLoadCallback(drawChart);
}).catch(error => {
    console.log(error.message); // 'An error has occurred: 404'
});


function drawChart() {
    let data = new google.visualization.DataTable();
    data.addColumn('string', 'Name'); // Can be refer by child 
    data.addColumn('string', 'ParentName'); // Current record Parent Name
    data.addColumn('string', 'ToolTip'); // when you cursor hover to it, display the value
    family_list.forEach((element, familyIndex) => {
        let avatar = `${imagePath}${element.avatar}`;
        let state = element.state ?? "-";
        let nationality =  element.nationality ?? "-"
        let seniority = element.seniority ?? "-";
        data.addRows([
            [{
                v: element.name,
                'f': `<a href="/history/${element.id}">
                    <div id = "referUsage" class="scrollTo${element.id}">
                    <div class="image d-flex flex-row justify-content-center align-items-center" id="firstRow" data-image='${familyIndex}'>
                    <img class="mr-3" id="parent_avatar"src="${avatar}" height="100" width="100" />
                    </div> 
                    <div class="image d-flex flex-column justify-content-center align-items-center" id="${element.name}">
                    <div class="container bg-white text-dark mt-2" style="border-radius: 20px">
                    <div class="row d-flex justify-content-center p-2" data-spouse='${familyIndex}'>
                    <div style="width: 100px;" class="mr-1" id="name">${element.name}<br/> (${element.era}) </div>
                    </div> 
                    </div> 
                    </div> 
                    </div> 
                    </div> 
                    <div class="container bg-white text-dark mt-2">
                    <div class="row text-justify p-2">
                    <div><b> 辈分 :</b>${seniority}</div>
                    </div>
                    <div class="row text-justify p-2">
                    <div><b>国籍 :</b>${nationality}</div>
                    </div>
                    <div class="row text-justify p-2"> 
                    <div><b>区域 :</b>${state}</div>
                    </div>
                    <div class="row text-justify p-2">
                    <div><b>年份 :</b>${element.dob_date}</div>
                    </div>           
                    </a>`
            }, element.parent_id, element.name]
        ]);

    })


    // Create the chart.
    var chart = new google.visualization.OrgChart(chartDiv);
    // Draw the chart, setting the allowHtml option to true for the tooltips.
    chart.draw(data, {
        'allowHtml': true,
        'allowCollapse': true,
        'size': 'medium',
        'color': '#FF0000',
        'compactRows': true
    });
    appendSpouseName();
    appendSpouseAvatar();
    downLoadPDF();
}

function downLoadPDF() {
    google.charts.load('current', { packages: ["orgchart"] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name'); // Can be refer by child 
        data.addColumn('string', 'ParentName'); // Current record Parent Name
        data.addColumn('string', 'ToolTip'); // when you cursor hover to it, display the value

        family_list.forEach((element, familyIndex) => {
            data.addRows([
                [{
                    v: element.name,
                    f: element.name +
                        `<div id="'${element.name}'"></div>
                        <div class="row d-flex justify-content-center p-2" data-spousePDF='${familyIndex}'>
                         </div>
                        <div style="color:red;">年份:${element.dob_date}</div>`
                },
                element.parent_id, element.name]
            ]);
        })
        // Create the chart.
        var chart = new google.visualization.OrgChart(hiddenDiv);
        // Draw the chart, setting the allowHtml option to true for the tooltips. 
        chart.draw(data, {
            'allowHtml': true,
            'size': 'medium',
            'compactRows': true
        });
        appendSpouseNamePdf();
        chartInputData.value = hiddenDiv.innerHTML;
        let currentUserContainerID = `scrollto${parseInt(window.location.pathname.split('/')[2])}`;
        document.getElementsByClassName(currentUserContainerID)[0].scrollIntoView();// scroll to the current user                         
    }
}

function appendSpouseNamePdf() {
    spouse_list.forEach((element) => {
        let spouseNameTemplate = spouse_name_template.content.cloneNode(true);
        spouseNameTemplate.querySelector('[data-spouse-name]').innerText = `配偶:${element.wife_name}`;
        let container = document.querySelectorAll('[data-spousePDF]');
        container.forEach((item) => {
            if (item.dataset.spousepdf === element.id.toString()) {
                item.append(spouseNameTemplate);
            }
        })
    })
}

function appendSpouseName() {
    family_list.forEach((element) => {
        let spouseNameTemplate;
        element.spouse_name.forEach((item) => {
            spouseNameTemplate = spouse_name_template.content.cloneNode(true);
            spouseNameTemplate.querySelector('[data-spouse-name]').innerText = item;
        })
        let container = document.querySelectorAll('[data-spouse]');
        container.forEach((item) => {
            if (item.dataset.spouse === element.id.toString()) {
                item.append(spouseNameTemplate);
            }
        })
    })
}

function appendSpouseAvatar() {
    spouse_list.forEach((element) => {
        let spouseImgTemplate = spouse_img_template.content.cloneNode(true);
        spouseImgTemplate.querySelector("#spouse_avatar").src = `${imagePath}${element.wife_picture}`;
        let container = document.querySelectorAll('[data-image]');
        container.forEach((item) => {
            if (item.dataset.image === element.id.toString()) {
                item.append(spouseImgTemplate);
            }
        })
    })
}










