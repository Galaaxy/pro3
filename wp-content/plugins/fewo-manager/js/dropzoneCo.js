Dropzone.options.dropzone = {
        paramName: "file",
        maxFilesize: 25,
        queuecomplete: function () {
            showImages();
        }
    }

function showImages(){

    location.reload();
}
