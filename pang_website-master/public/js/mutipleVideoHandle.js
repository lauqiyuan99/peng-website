//Selectors
const videoFileUploadControl = document.querySelector("[data-video-file-upload]");
const displayVideoContainer = document.querySelector("[ data-display-video-field]");
const videoDisplayTemplate = document.querySelector("[data-video-template]");
const deleteVideoBtn = document.querySelector('[data-delete-video-btn]');
const isDeletePreviousVideo = document.getElementById('isDeletePreviousVideoHiddenField');

//Event
videoFileUploadControl.addEventListener("change", (event) => {
    displayVideoContainer.innerHTML = '';
    const { files } = event.target;
    for (let i = 0; i < files.length; i++) {
        if (!files[i].type.match("video")) {
            alert(`第${i + 1}个文件不符合格式,请重新上传`);
            reset();
            return;
        }
        const item = videoDisplayTemplate.content.cloneNode(true);
        item.querySelector("[data-display-video]").src = URL.createObjectURL(files[i]);
        deleteVideoBtn.disabled = false;
        displayVideoContainer.append(item);
    }
});
deleteVideoBtn.addEventListener('click', event => {
    event.preventDefault();
    if (videoFileUploadControl.files.length > 0 || deleteVideoBtn.dataset.deleteVideoBtn) {
        if (confirm('确定删除')) {
            reset();
            deleteVideoBtn.disabled = true;
            setIsDeletePreviousVideo(true);
            return;
        }
        deleteVideoBtn.disabled = false;
        setIsDeletePreviousVideo(false);
        
        return;
    } else {
        deleteVideoBtn.disabled = false;
        setIsDeletePreviousVideo(false);
    }
})

//Function
const reset = () =>{
    videoFileUploadControl.type = '';
    videoFileUploadControl.type = 'file'; // Reinitialize the control
    displayVideoContainer.innerHTML = '';
}

const setIsDeletePreviousVideo = isDelete => { 
    if (isDeletePreviousVideo) {
        isDeletePreviousVideo.value = isDelete;
    }
}






