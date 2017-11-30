<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">
                <img alt="Meals for a Steal" src="images/favicon.png" style="height: 100%">
                <span>Meals for a Steal</span>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/recipes/add">Add Recipe</a></li>
            </ul>
        </div>
    </div>
</nav>




<div class="container recipes">

    <?php foreach($recipes as $r): ?>
        <div class="page-posting">
            <span class="posting-number">#<?= $r['recipe_id'] ?></span>

<!--            <div class="votes">-->
<!--                <img class="upvote-button" src="public/img/voting/upvote-not-selected.svg" alt="upvote">-->
<!--                <span class="score">27</span>-->
<!--                <img class="downvote-button" src="public/img/voting/downvote-not-selected.svg" alt="downvote">-->
<!--            </div>-->
<!--            -->
<!--            <img class="thumbnail" src="public/img/filler/food1.png" alt="user submitted food">-->

            <div class="posting-details">
                <a class="food-title" href="/recipes/detail/<?= $r['recipe_id'] ?>"><?= $r['title'] ?></a>
                <span class="date"><?= $r['created'] ?></span>
                <a class="author" href="profile.html"> <?= $r['user_id'] ?></a>
            </div>
        </div>
    <?php endforeach; ?>

</div>




</body>


