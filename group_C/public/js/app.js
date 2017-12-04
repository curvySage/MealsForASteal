function loadImg(Img){
	var photo = document.getElementById("img")
	var image = document.getElementById("image");
	image.src = photo.src;
}

function addItem(){
	var elem = document.getElementById("ingredient-form");
	elem.innerHTML += '<input type="text" value="" placeholder="Amount & Ingredient" class="ingredient" title="amount and ingredient" />';
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
	
	photo.src = "/group_C/public/img/addphoto.svg";
	title.value = "";
	item.value = "";

	while (ingredients.childNodes.length > 5) {
  		ingredients.removeChild(ingredients.lastChild);
  		console.log("hehe");
  	}
}



// jQuery
$(document).ready(function(){
	var upSelected = "/group_C/public/img/voting/upvote-selected.svg"
	var upNotSelected = "/group_C/public/img/voting/upvote-not-selected.svg"
	var downSelected = "/group_C/public/img/voting/downvote-selected.svg"
	var downNotSelected = "/group_C/public/img/voting/downvote-not-selected.svg"

	$(".upvote-button").click(function(){
		var upSrc = $(this).attr("src");
		var downSrc = $(this).parent().children(".downvote-button").attr("src");
		var score = parseInt($(this).parent().children(".score").html());
		
		if (upSrc == upNotSelected && downSrc == downNotSelected) {
			score += 1;
			$(this).attr("src", "/group_C/public/img/voting/upvote-selected.svg");
		} else if (upSrc == upSelected && downSrc == downNotSelected) {
			score -= 1;
			$(this).attr("src", "/group_C/public/img/voting/upvote-not-selected.svg");
		} else if (upSrc == upNotSelected && downSrc == downSelected) {
			score += 2;
			$(this).attr("src", "/group_C/public/img/voting/upvote-selected.svg");
			$(this).parent().children(".downvote-button").attr("src", "/group_C/public/img/voting/downvote-not-selected.svg");
		}

		$(this).parent().children(".score").html(score);

		var requestParser = this.id;
		var parsedRequest = requestParser.split("_");

		var xmlhttp = new XMLHttpRequest();
		// Get current vote, then post new vote
		xmlhttp.open("GET", "makeVote.php?direction=" + parsedRequest[1] + "&recipe_id=" + parsedRequest[2], true);
		xmlhttp.send();

	});

	$(".downvote-button").click(function(){
		var downSrc = $(this).attr("src");
		var upSrc = $(this).parent().children(".upvote-button").attr("src");
		var score = parseInt($(this).parent().children(".score").html());
		
		if (downSrc == downNotSelected && upSrc == upNotSelected) {
			score -= 1;
			$(this).attr("src", "/group_C/public/img/voting/downvote-selected.svg");
		} else if (downSrc == downSelected && upSrc == upNotSelected) {
			score += 1;
			$(this).attr("src", "/group_C/public/img/voting/downvote-not-selected.svg");
		} else if (downSrc == downNotSelected && upSrc == upSelected) {
			score -= 2;
			$(this).attr("src", "/group_C/public/img/voting/downvote-selected.svg");
			$(this).parent().children(".upvote-button").attr("src", "/group_C/public/img/voting/upvote-not-selected.svg");
		}

		$(this).parent().children(".score").html(score);

		var requestParser = this.id;
		var parsedRequest = requestParser.split("_");

		var xmlhttp = new XMLHttpRequest();
		// Get current vote, then post new vote
		xmlhttp.open("GET", "makeVote.php?direction=" + parsedRequest[1] + "&recipe_id=" + parsedRequest[2], true);
		xmlhttp.send();

	});



});


