//===INIT VARIABLES===
//Data List of Filler Posts to simulate load more button
var loadMore = [];
var loadStr = '<div class="load-more"><button id="loadmore">Load More</button></div>';
//Keep Position in Load More Array (What you have loaded so far)
var curNum = 0;

//Create filler posts using struct to load into loadMore
var post1 = {title:"Bacon Cheeseburger",postTime:"2 hours ago",user:"coolguy32",rating:"8"};
var post2 = {title:"Buffalo CheeseBurger",postTime:"18 hours ago",user:"MonkeyMonkey",rating:"10"};
var post3 = {title:"Chilli CheeseBurger",postTime:"48 hours ago",user:"CoffeeGood",rating:"6"};
var post4 = {title:"Turkey Burger ",postTime:"10 minutes ago",user:"TacoCat",rating:"24"};
var post5 = {title:"Classic Burger",postTime:"4 hours ago",user:"NotABot",rating:"1"};
loadMore.push(post1);
loadMore.push(post2);
loadMore.push(post3);
loadMore.push(post4);
loadMore.push(post5);
//Great now you should have load more filled with random data

//This function uses inner html and strings to make content out of the loadMore array data
function makeContent(){
"use strict";
//Initialize I/set I counter to 0
var i = 0;

//Remove Load More Button tags and text
loadStr = loadStr.slice(0,-69); 

//Make 3 Units of Content OR However many left in loadMore[]
//Maybe put img src inside post object too
//Maybe also somehow use generic href and then add user at end 
//Example '...http://www.mealsforsteal.com/u/'+user+'...' or postid or something

while(i < 3 && curNum <= loadMore.length-1){
	loadStr += '<div class="page-posting"><span class="posting-number">'
	+(curNum+5)+'</span><div class="votes"><img src="../img/voting/upvote-not-selected.svg" alt="upvote"><span class="score">'
	+loadMore[curNum].rating+'</span><img src="../img/voting/downvote-not-selected.svg" alt="downvote"></div><img class="thumbnail" src="../img/filler/food2.png"><div class="posting-details"><span class="food-title">'
	+loadMore[curNum].title+'</span><span class="date">'
	+loadMore[curNum].postTime+'</span><a class="author" href="XXXXXX">'
	+loadMore[curNum].user+'</a></div></div><br>';
	document.getElementById("dynamicLoading").innerHTML = loadStr;
	
	curNum+=1;
	i+=1;
	}//end While
	
//If you can still load more stuff re-add the load more button
if(curNum < loadMore.length-1){
	loadStr += '<div class="load-more"><button id="loadmore">Load More</button></div>';
	document.getElementById("dynamicLoading").innerHTML = loadStr;
	}
}

//===LISTENERS===
//When you click on the load more button class
var elem = document.getElementById('dynamicLoading');
if(elem){
  elem.addEventListener('click', makeContent);
  document.getElementById("dynamicLoading").innerHTML = loadStr;
}
