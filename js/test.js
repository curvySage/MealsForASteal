//===INIT VARIABLES===
//Data List of Filler Posts to simulate load more button
var loadMore[];

//Keep Position in Load More Array (What you have loaded so far)
var curNum = 0;

//Create filler posts using struct to load into loadMore
var post1 = {title:"Food",postTime:"2 hours ago",user:"banana",rating:"8"};
var post2 = {title:"More Food",postTime:"18 hours ago",user:"apple",rating:"10"};
var post3 = {title:"Ah yes Food",postTime:"48 hours ago",user:"orange",rating:"6"};
var post4 = {title:"Let me show you Food",postTime:"10 minutes ago",user:"melon",rating:"24"};
var post5 = {title:"Did you forget Food",postTime:"4 hours ago",user:"carrot",rating:"1"};
loadMore.push(post1);
loadMore.push(post2);
loadMore.push(post3);
loadMore.push(post4);
loadMore.push(post5);
//Great now you should have load more filled with random data

//===LISTENERS===
//When you click on the load more button class
document.getElementByClassName('load-more').addEventListener('click',function(){

//Initialize I/set I counter to 0
var i = 0;

//Make 3 Units of Content OR However many left in loadMore[]
//Maybe put img src inside post object too
//Maybe also somehow use generic href and then add user at end 
//Example '...http://www.mealsforsteal.com/u/'+user+'...' or postid or something

while(i < 3 || curNum >= loadMore.length-1){

	document.getElementById("dynamicLoad").innerHTML = '
	
	<div class="page-posting">
      <span class="posting-number">'+(curNum+4)+'</span>
      <div class="votes">
        <img src="../img/voting/upvote-not-selected.svg" alt="upvote">
        <span class="score">'+loadMore[curNum].rating+'</span>
        <img src="../img/voting/downvote-not-selected.svg" alt="downvote">
      </div>
      <img class="thumbnail" src="../img/filler/food2.png">
      <div class="posting-details">
        <span class="food-title">'+loadMore[curNum].title+'</span>
        <span class="date">'+loadMore[curNum].postTime+'</span>
        <a class="author" href="XXXXXX">'+loadMore[curNum].user+'</a>
      </div>
	
	";
	
	curNum++;
	i++;
	}//end While
	
//If you can still load more stuff leave the load more button
if(curNum < loadMore.length-1)
	document.getElementById("dynamicLoad").innerHTML = "
	
	<div class="load-more"><button>Load More</button></div>
	
	";
}