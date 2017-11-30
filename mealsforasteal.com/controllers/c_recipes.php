<?php

class recipes_controller extends base_controller
{
    // include parent construct
    // check to make sure user is logged in. else take them to homepage
    public function __construct()
    {
        parent::__construct();

        if(!$this->user)
        {
            Router::redirect("/");
        }
    }


    // main function. Accessed by /recipes/index
    public function index()
    {
        $this->template->content = View::instance('v_recipes');
        $this->template->title = "Meals for a Steal - Recipes";

        // SQL query to select list_name
        $qresult = 'SELECT *
					FROM recipes
					ORDER BY recipe_id DESC
					LIMIT 10';

        // select all the rows that match that list_name
        $qre = DB::instance(DB_NAME)->select_rows($qresult);

        $this->template->content->recipes = $qre;

        // render view

        echo $this->template;
    }


    public function detail($id = null)
    {
        $this->template->content = View::instance('v_recipes_details');
        $this->template->title = "Meals for a Steal - Recipe Detail";

        // SQL query to select list_name
        $qresult = 'SELECT *
					FROM recipes
					WHERE recipe_id = "'.$id.'"';

        // select all the rows that match that list_name
        $qre = DB::instance(DB_NAME)->select_row($qresult);

        $this->template->content->recipe = $qre;

        $ingredients = explode(',', $qre['ingredients']);
        $this->template->content->ingredients = $ingredients;

        // render view

        echo $this->template;
    }

    // Add a recipe
    public function add()
    {
        $this->template->content = View::instance('v_recipes_add');
        $this->template->title = "Meals for a Steal - Add Recipe";

        echo $this->template;

    }

    // Event handler controller when a user posts a recipe
    public function p_add()
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . '/' . time() . '_' . $_FILES["upload"]["name"];

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
        }

//        echo "a";

        if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
            echo "1";
            if ($target_file != null) {
                $_POST['image'] = $target_file;
            }
//            else {
//                $_POST['image'] = '../../uploads//0_none.jpg';
//            }
            echo "2";

            $_POST['created'] = Time::now();
            $_POST['user_id'] = $this->user->user_id;


            DB::instance(DB_NAME)->insert_row('recipes', $_POST);


            $q = 'SELECT *
        FROM recipes
        WHERE title="'.$_POST["title"].'"
        AND created="'.$_POST["created"].'"';

            $qres = DB::instance(DB_NAME)->select_row($q);

            Router::redirect('/recipes/detail/'.$qres["recipe_id"]);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


    //delete task for list
    public function delete()
    {
        // delete matching record row
        DB::instance(DB_NAME)->delete('recipes','WHERE recipe_id ='.$_POST['recipe_id']);

        // return to homepage with updated task list
        Router::redirect('/recipes/index/');
    }
} # end of the class
