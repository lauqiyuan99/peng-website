import toImageArr, { toSpouseNameArr } from './helper'

//Object Destructuring
const { origin: originUrl, pathname } = window.location;
//fetch data url
let url = `${originUrl}/fetch-family-list/${pathname.split('/')[2]}`;

export default async function getFamilyList() {
    const response = await fetch(url);
    if (!response.ok) {
        const message = `An error has occured: ${response.status}`;
        throw new Error(message);
    }
    const data = await response.json();
    return toObjectList(data);
}


function toObjectList(data) {
    let list;
    data.forEach(element => {
        list = {
            id: element.id,
            name: element.name,
            avatar: element.avatar,
            spouse_name: toSpouseNameArr(element.spouse_name),
            spouse_avatar: toImageArr(element.spouse_avatar),
            gender: element.gender,
            state: element.state,
            nationality: element.nationality,
            dob_date: element.dob_date,
            dead_date: element.dead_date,
            era: element.era,
            seniority: element.seniority,
            family: element.family,
            status: element.status,
            parent_id: element.parent_id,
        }
    });
    return list;
}



