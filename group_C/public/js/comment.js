var postComment = document.getElementById("post-comment");
var postCommentError = document.getElementById("post-comment-error");
var recipe_id = document.getElementById("recipe_id");

postComment.onclick = function() {
	
	if (comment.value == "") {
		postCommentError.innerHTML = "No empty comments!";
		postCommentError.style.color = "red";
		return false;
	}

}