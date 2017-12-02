// Init. vars
var newTitle = document.getElementById("title");

function loadImage(file) {
    var tgt = file.target || window.event.srcElement,
        files = tgt.files;

    // FileReader support
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
            document.getElementById('photo').src = fr.result;
        }
        fr.readAsDataURL(files[0]);
    }

    // Not supported
    else {
        // fallback -- perhaps submit the input to an iframe and temporarily store
        // them on the server until the user's session ends.
	document.getElementById('photo').src = "public/img/addphoto.svg";
   }
}