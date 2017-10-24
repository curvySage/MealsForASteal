var upVote = "../img/voting/upvote-selected.svg";
var downVote = "../img/voting/downvote-selected.svg";

function up(clicked_id){
var upImage = document.getElementById(clicked_id);
var downImage = upImage.nextSibling.nextSibling.nextSibling.nextSibling;

	if(upVote == "../img/voting/upvote-selected.svg"){
		upImage.src = "../img/voting/upvote-selected.svg";
		upVote = "../img/voting/upvote-not-selected.svg";
	}
	else if(upVote == "../img/voting/upvote-not-selected.svg"){
		upImage.src = "../img/voting/upvote-not-selected.svg";
		upVote = "../img/voting/upvote-selected.svg";
	}

	

	downImage.src = "../img/voting/downvote-not-selected.svg";
}

function down(clicked_id){
var downImage = document.getElementById(clicked_id);
var upImage = downImage.previousSibling.previousSibling.previousSibling.previousSibling;

	if(downVote == "../img/voting/downvote-selected.svg"){
		downImage.src = "../img/voting/downvote-selected.svg";
		downVote = "../img/voting/downvote-not-selected.svg";
	}
	else if(downVote == "../img/voting/downvote-not-selected.svg"){
		downImage.src = "../img/voting/downvote-not-selected.svg";
		downVote = "../img/voting/downvote-selected.svg";
	}

	

	upImage.src = "../img/voting/upvote-not-selected.svg";
}

function loadImg(Img){
	var photo = document.getElementById("img")
	var image = document.getElementById("photo");
	image.src = photo.src;
}

function addItem(){
	var elem = document.getElementById("ingredient-form");
	elem.appendChild += '<input type="text" value="" placeholder="Amount & Ingredient" class="ingredient" title="amount and ingredient" />';
}

function removeItem(){
	var select = document.getElementById('ingredient-form');
  	if (select.childNodes.length > 5) {
  		select.removeChild(select.lastChild);
  	}
}
	
function clearAll(){
	var title = document.getElementById("title");
	var item = document.getElementById("first-ingredient");
	var photo = document.getElementById("photo");
	var ingredients = document.getElementById("ingredient-form");
	
	photo.src = "../img/addphoto.svg";
	title.value = "";
	item.value = "";

	while (ingredients.childNodes.length > 5) {
  		ingredients.removeChild(ingredients.lastChild);
  		console.log("hehe");
  	}
}