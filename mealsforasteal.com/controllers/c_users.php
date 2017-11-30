<?php
class users_controller extends base_controller
{

    // include parent construct
    public function __construct()
    {
        parent::__construct();
    }


    // create signup function. Check for NULL entries and duplicate email entries
    public function signup($error = NULL)
    {
        $this->template->content = View::instance('v_users_signup');
        $this->template->title = "Meals for a Steal - Sign Up";

        $this->template->content->error = $error;
        echo $this->template;
    }


    // pass content onto database after sanitizing input
    // if content NULL, display error page.
    // if email exists, display error page.
    public function p_signup()
    {
        $error = FALSE;

        $exists = DB::instance(DB_NAME)->select_field("SELECT username FROM users WHERE username = '" . $_POST['username'] . "'");

        if(isset($exists))
        {
            $error = TRUE;
            Router::redirect('/users/signup/error');
        }
        else
        {
            $_POST['created'] = Time::now();
            $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
            $_POST['token'] = sha1(TOKEN_SALT.$_POST['username'].Utils::generate_random_string());
            unset($_POST['password_confirmation']);
            DB::instance(DB_NAME)->insert_row('users', $_POST);
        }

        $q = 'SELECT token
			  FROM users
			  WHERE username = "'.$_POST['username'].'"
			  AND password = "'.$_POST['password'].'"';

        $token = DB::instance(DB_NAME)->select_field($q);

        // After adding user, get user token and set. If error getting token, throw error message.
        if($token)
        {
            setcookie('token', $token, strtotime('+1 year'), '/');
            Router::redirect('/recipes/index');
        }
        else
        {
            Router::redirect('/users/login/error');
        }
    }


    // create login function. Check that both login and password are not NULL
    public function login($error = NULL)
    {
        $this->template->content = View::instance('v_users_login');
        $this->template->title = "Meals for a Steal - Login";
        $this->template->content->error = $error;

        echo $this->template;
    }


    // if login matches, log user in
    // if login or password NULL, display error page
    public function p_login()
    {
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        $q = 'SELECT token
			  FROM users
			  WHERE username = "'.$_POST['username'].'"
			  AND password = "'.$_POST['password'].'"';

        $token = DB::instance(DB_NAME)->select_field($q);

        if($token)
        {
            setcookie('token', $token, strtotime('+1 year'), '/');
            Router::redirect('/recipes/index');
        }
        else
        {
            Router::redirect('/users/login/error');
        }
    }


    // create logout function to clear cookie data and bring user back to homepage
    public function logout()
    {
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        $data = Array('token' => $new_token);

        DB::instance(DB_NAME)->update('users', $data, 'WHERE user_id ='.$this->user->user_id);

        setcookie('token', '', strtotime('+1 year'), '/');

        Router::redirect('/');
    }
} # end of the class