// Selectors
const pplHistoryContainerSelectors = document.querySelectorAll('[data-id]');
const historyNameSelectors = document.querySelector('#history_name');


// Function
const onClick = id =>{
    id = id.toString();
    pplHistoryContainerSelectors.forEach(element=>{
       if(element.dataset.id == id){
        element.style.display = 'block';
        historyNameSelectors.innerHTML = element.dataset.name;
       }else{
        element.style.display = 'none';
       }
    })
}