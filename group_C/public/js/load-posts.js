//===INIT VARIABLES===
//Data List of Filler Posts to simulate load more button
var loadMore = [];
var loadStr = '';
//Keep Position in Load More Array (What you have loaded so far)
var curNum = 0;
var contentBlock = document.getElementById("content-section");

//Create filler posts using struct to load into loadMore
var post1 = { title: "Bacon Cheeseburger", postTime: "2 hours ago", user: "coolguy32", rating: "8" };
var post2 = { title: "Buffalo CheeseBurger", postTime: "18 hours ago", user: "MonkeyMonkey", rating: "10" };
var post3 = { title: "Chilli CheeseBurger", postTime: "48 hours ago", user: "CoffeeGood", rating: "6" };
var post4 = { title: "Turkey Burger ", postTime: "10 minutes ago", user: "TacoCat", rating: "24" };
var post5 = { title: "Classic Burger", postTime: "4 hours ago", user: "NotABot", rating: "1" };
loadMore.push(post1);
loadMore.push(post2);
loadMore.push(post3);
loadMore.push(post4);
loadMore.push(post5);
//Great now you should have load more filled with random data

//This function uses inner html and strings to make content out of the loadMore array data
function makeContent() {
  "use strict";
  //Initialize I/set I counter to 0
  var i = 0;
  var loadButton = document.getElementsByClassName("load-more");

  //Make 3 Units of Content OR However many left in loadMore[]
  //Maybe put img src inside post object too
  //Maybe also somehow use generic href and then add user at end 
  //Example '...http://www.mealsforsteal.com/u/'+user+'...' or postid or something

  while (i < 3 && curNum <= loadMore.length - 1) {

    //Create a new postElement of tag div and give it a class name 
    var postElem = document.createElement('div');
    postElem.className = "page-posting";
    contentBlock.insertBefore(postElem, loadButton[0]);

    loadStr = '<span class="posting-number">' +
      (curNum + 5) + '</span><div class="votes"><img src="/group_C/public/img/voting/upvote-not-selected.svg" alt="upvote"><span class="score">' +
      loadMore[curNum].rating + '</span><img src="/group_C/public/img/voting/downvote-not-selected.svg" alt="downvote"></div><img class="thumbnail" src="/group_C/public/img/filler/food2.png"><div class="posting-details"><span class="food-title">' +
      loadMore[curNum].title + '</span><span class="date">' +
      loadMore[curNum].postTime + '</span><a class="author" href="XXXXXX">' +
      loadMore[curNum].user + '</a></div>';
    postElem.innerHTML = loadStr;

    curNum += 1;
    i += 1;
  }
  
  //If you can still load more stuff re-add the load more button
  if (curNum == loadMore.length) {
    //Remove Load More Button tags and text
    contentBlock.removeChild(loadButton[0]);
  }
}

//===LISTENERS===
//When you click on the load more button class
var buttonElem = document.getElementById('loadmore');
if (buttonElem) {
  buttonElem.addEventListener('click', makeContent);
}