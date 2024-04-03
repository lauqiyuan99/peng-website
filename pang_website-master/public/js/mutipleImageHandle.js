//Selectors
const fileUploadControl = document.querySelector("[data-file-upload]");
const displayImageContainer = document.querySelector("[ data-display-image-field]");
const imageDisplayTemplate = document.querySelector("[data-img-template]");

//Event
fileUploadControl.addEventListener("change", (event) => {
    displayImageContainer.innerHTML = '';
    const { files } = event.target;
    for (let i = 0; i < files.length; i++) {
        if (!files[i].type.match("image")) {
            alert(`第${i + 1}个文件不符合格式,请重新上传`);
            resetControls();
            return;
        }
        const item = imageDisplayTemplate.content.cloneNode(true);
        item.querySelector("[data-display-image]").src = URL.createObjectURL(files[i]);
        displayImageContainer.append(item);
    }
});

//Function
const resetControls = () =>{
    fileUploadControl.type = '';
    fileUploadControl.type = 'file'; // Reinitialize the control
    displayImageContainer.innerHTML = '';
}

// const notifyMe = (messages) => {
//     if (!("Notification" in window)) {
//       // Check if the browser supports notifications
//       alert("This browser does not support desktop notification");
//     } else if (Notification.permission === "granted") {
//       const notification = new Notification(messages);
//     } else if (Notification.permission !== "denied") {
//       Notification.requestPermission().then((permission) => {      
//         if (permission === "granted") {
//           const notification = new Notification(messages);
//         }
//       });
//     }
//   }
