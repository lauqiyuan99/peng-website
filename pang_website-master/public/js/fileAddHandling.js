//Selectors
const fileImageUploadControl = document.querySelector("[data-img-file-upload]");
const uploadImageBtnControl = document.querySelector("[data-img-upload-btn]");
const displayImageContainer = document.querySelector("[ data-display-image-field]");
const imageDisplayTemplate = document.querySelector("[data-img-template]");

const fileVideoUploadControl = document.querySelector("[data-vid-file-upload]");
const uploadVideoBtnControl = document.querySelector("[data-vid-upload-btn]");
const displayVideoContainer = document.querySelector("[ data-display-video-field]");
const videoDisplayTemplate = document.querySelector("[data-vid-template]");

//Variables
let imgFileList = [];
let vidFileList = [];

//Event Listener
uploadImageBtnControl.addEventListener("click", () => {
    fileImageUploadControl.click();
});
if (uploadVideoBtnControl) {
    uploadVideoBtnControl.addEventListener("click", () => {
        fileVideoUploadControl.click();
    });
}

fileImageUploadControl.addEventListener("change", (event) => {
    const { files } = event.target;
    for (let i = 0; i < files.length; i++) {
        if (!files[i].type.match("image")) {
            alert(`第${i + 1}个文件不符合格式,请重新上传`);
            return;
        }
        const item = imageDisplayTemplate.content.cloneNode(true);
        item.querySelector("[data-display-image]").src = URL.createObjectURL(files[i]);
        item.querySelector("[data-img-name]").dataset.imgName = files[i].name;
        displayImageContainer.append(item);
        imgFileList.push(new File([files[i]], files[i].name));
        fileImageUploadControl.files = fileListItems(imgFileList); //sync with fileList;
    }
});
if (fileVideoUploadControl) {
    fileVideoUploadControl.addEventListener("change", (event) => {
        const { files } = event.target;
        for (let i = 0; i < files.length; i++) {
            if (!files[i].type.match("video")) {
                alert(`第${i + 1}个文件不符合格式,请重新上传`);
                return;
            }
            const item = videoDisplayTemplate.content.cloneNode(true);
            item.querySelector("[data-display-video]").src = URL.createObjectURL(files[i]);
            item.querySelector("[data-vid-name]").dataset.vidName = files[i].name;
            displayVideoContainer.append(item);
            vidFileList.push(new File([files[i]], files[i].name));
            fileVideoUploadControl.files = fileListItems(vidFileList); //sync with fileList;
        }
    });
}

//Function
const onDeleteImage = (currentDeleteBtn) => {
    let isMatch = false;
    const fileArr = fileImageUploadControl.files;
    for (let i = 0; i < fileArr.length; i++) {
        if (fileArr[i]) {
            isMatch = fileArr[i].name.includes(currentDeleteBtn.parentNode.dataset.imgName);
            if (isMatch) {
                imgFileList.splice(i, 1);
            }
        }
    }
    fileImageUploadControl.files = fileListItems(imgFileList);
    console.log(fileImageUploadControl.files);
    currentDeleteBtn.parentNode.remove();
}

const onDeleteVideo = (currentDeleteBtn) => {
    let isMatch = false;
    const fileArr = fileVideoUploadControl.files;
    for (let i = 0; i < fileArr.length; i++) {
        if (fileArr[i]) {
            isMatch = fileArr[i].name.includes(currentDeleteBtn.parentNode.dataset.vidName);
            if (isMatch) {
                vidFileList.splice(i, 1);
            }
        }
    }
    fileVideoUploadControl.files = fileListItems(vidFileList);
    console.log(fileVideoUploadControl.files);
    currentDeleteBtn.parentNode.remove();
}

const fileListItems = (files) => {
    let list = new ClipboardEvent("").clipboardData || new DataTransfer();
    for (let i = 0; i < files.length; i++) {
        list.items.add(files[i]);
    }
    return list.files;
}