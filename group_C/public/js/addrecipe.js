// Init. vars
var fileUpload = document.getElementById("image");
var title = document.getElementById("title");
var ingredients = document.getElementById("ingredients");
var instructions = document.getElementById("instructions");
var submitBtn = document.getElementById("submit-btn");
var titleErr = document.getElementById("title-error");
var ingrErr = document.getElementById("ingredient-error");
var instrErr = document.getElementById("instruction-error");

// fileUpload.onchange = function(file){
//     var tgt = file.target || window.event.srcElement,
//         files = tgt.files;

//     // FileReader support
//     if (FileReader && files && files.length) {
//         var fr = new FileReader();
//         fr.onload = function () {
//             document.getElementById('photo').src = fr.result;
//         }
//         fr.readAsDataURL(files[0]);
//     }

//     // Not supported
//     else {
//         // fallback -- perhaps submit the input to an iframe and temporarily store
//         // them on the server until the user's session ends.
// 	document.getElementById('photo').src = "/group_C/public/img/addphoto.svg";
//    }
// }

submitBtn.onclick = function(){
    titleErr.innerHTML = "&nbsp;";
    ingrErr.innerHTML = "&nbsp;";
    instrErr.innerHTML = "&nbsp;";
    var bad = false;
    
    if(title.value == ""){
	   titleErr.innerHTML = "Title cannot be blank.";
       bad = true;
    }

    if(ingredients.value == ""){
	   ingrErr.innerHTML = "Must include atleast 1 ingredient."; 
       bad = true;
    }

    if(instructions.value ==""){
	   instrErr.innerHTML = "Instructions cannot be blank.";
       bad = true;
    }
    
    if (!bad) {
        return true;
    }

    return false;
}
