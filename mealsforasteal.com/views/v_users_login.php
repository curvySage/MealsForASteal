<body>


<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">
                <img alt="Meals for a Steal" src="../images/favicon.png" style="height: 100%">
                <span>Meals for a Steal</span>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/users/signup">Sign Up</a></li>
            </ul>
        </div>
    </div>
</nav>



<div class="container signup">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

            <div id="form_error_signup">
                <?php if($error == TRUE): ?>
                    <p id="errorsignup">Invalid credentials.</p><br>
                <? endif; ?>
            </div>


            <form name="submit" method="POST" action="/users/p_login" id="login_form" onsubmit="return(login_validate())">
                <h2>Log in to Meals for a Steal</h2>
                <hr class="colorgraph">

                <div class="form-group">
                    <input type="input" name="username" id="username" class="form-control input-lg" placeholder="Enter Username" tabindex="4" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5" required>
                </div>

                <hr class="colorgraph">
                <div class="row">
                    <div class="col-xs-12 col-md-6"><input type="submit" value="Login" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
                </div>
            </form>

        </div>
    </div>
</div>


</body>