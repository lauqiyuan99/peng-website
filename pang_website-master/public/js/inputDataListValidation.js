const inputListTextFieldControl = document.querySelector("[data-input-list]");
const spanControl = document.querySelector("[data-span]");
const labelName = document.querySelector("[data-label]").dataset.label;
const saveBtn = document.querySelector('button[type="submit"]');
let list = [];

//Event Listener
window.addEventListener("load", getList);
inputListTextFieldControl.addEventListener("change", validation);

function validation() {
    let usrInputValue = inputListTextFieldControl.value;
    if (!usrInputValue) {
        spanControl.hidden = true;
        spanControl.textContent = '';
        saveBtn.disabled = false;
        return;
    }
    
    let isValid = isExist(usrInputValue);
    if (!isValid) {
        spanControl.textContent = `没有此${labelName}的记录,请检查你的输入是否正确，多一个空格也会影响结果`;
        spanControl.hidden = false;
        saveBtn.disabled = true;
    }else{
        spanControl.hidden = true;
        saveBtn.disabled = false;
    }
}

function getList() {
    const controlID = inputListTextFieldControl.getAttribute("list");
    for (let item of document.getElementById(controlID).options) {
        list.push({
            value: item.value,
        });
    }
}

const isExist = (usrInput) =>{
     for(let item of list){
        if(item.value === usrInput){
            return true;
        }
     }
     return false;
}
