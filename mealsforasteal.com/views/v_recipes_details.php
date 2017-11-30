<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">
                <img alt="Meals for a Steal" src="../../`ximages/favicon.png" style="height: 100%">
                <span>Meals for a Steal</span>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/users/signup">Sign Up</a></li>
                <li><a href="/users/login">Login</a></li>
            </ul>
        </div>
    </div>
</nav>




<div class="container recipeDetail">

    <div class="recipe-posting">
        <div class="recipe-header">
<!--            <div class="votes">-->
<!--                <img src="public/img/voting/upvote-not-selected.svg" alt="upvote" id = "recUp" onclick = "up(this.id);">-->
<!--                <span class="score">27</span>-->
<!--                <img src="public/img/voting/downvote-not-selected.svg" alt="downvote" id = "recDown" onclick = "down(this.id);">-->
<!--            </div>-->

            <div class="posting-details">
                <span class="food-title"> <?= $recipe['title'] ?></span>
                <span class="date"><?= $recipe['created'] ?></span>
                <a class="author" href="profile.html"><?= $recipe['user_id'] ?></a>
            </div>
        </div>

        <img class="recipe-image" src="../../<?= $recipe['image'] ?>" alt="imagefs">


        <div class="recipe-details">
            <div class="recipe-ingredients">
                <span class="detail-title">Ingredients</span>
                <ul>
                    <?php foreach($ingredients as $i): ?>
                        <li><?= $i ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="recipe-instructions">
                <span class="detail-title">Instructions</span>
                <p> <?= $recipe['description'] ?></p>
            </div>
        </div>

<!--        <div class="comments">-->
<!--            <span class="comments-title">Comments</span>-->
<!--            <!-- Need to replace with link to profiles -->-->
<!--            <p><a class="author" href="XXXXXX">TokyoChef</a><span class="comment-date"> &nbsp; 18 minutes ago</span><span class="comment-id"> &nbsp; id:1</span>-->
<!--                <br>Great recipe! I especially liked the mixture of the flour and sugar! </p>-->
<!--            <p><a class="author" href="XXXXXX">MaestroEater</a><span class="comment-date"> &nbsp; 1 hour ago</span><span class="comment-id"> &nbsp; id:2</span>-->
<!--                <br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>-->
<!--            <p><a class="author" href="XXXXXX">PoorCollegeStudent1988</a><span class="comment-date"> &nbsp; 2 hours ago</span><span class="comment-id"> &nbsp; id:3</span>-->
<!--                <br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>-->
<!--        </div>-->
<!--        <div class="add-comment">-->
<!--            <span class="add-comment-title">Comment:</span>-->
<!--            <textarea class="add-comment-box" id="comment" placeholder="comment" title="comment"></textarea>-->
<!--            <button class = "post-comment-button" id="post-comment">Post Comment</button>-->
<!--        </div>-->

    </div>

</div>




</body>


