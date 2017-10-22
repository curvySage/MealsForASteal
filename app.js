var upVote = "../img/voting/upvote-selected.svg";
var downVote = "../img/voting/downvote-selected.svg";

function up(clicked_id){
var upImage = document.getElementById(clicked_id);

	if(upVote == "../img/voting/upvote-selected.svg"){
		upImage.src = "../img/voting/upvote-selected.svg";
		upVote = "../img/voting/upvote-not-selected.svg";
	}
	else if(upVote == "../img/voting/upvote-not-selected.svg"){
		upImage.src = "../img/voting/upvote-not-selected.svg";
		upVote = "../img/voting/upvote-selected.svg";
	}
}

function down(clicked_id){
var downImage = document.getElementById(clicked_id);

	if(downVote == "../img/voting/downvote-selected.svg"){
		downImage.src = "../img/voting/downvote-selected.svg";
		downVote = "../img/voting/downvote-not-selected.svg";
	}
	else if(downVote == "../img/voting/downvote-not-selected.svg"){
		downImage.src = "../img/voting/downvote-not-selected.svg";
		downVote = "../img/voting/downvote-selected.svg";
	}
}