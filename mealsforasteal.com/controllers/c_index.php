<?php

class index_controller extends base_controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /*-------------------------------------------------------------------------------------------------
    Accessed via http://localhost/index/index/
    -------------------------------------------------------------------------------------------------*/
    public function index()
    {
        // print homepage
        if(!$token)
        {
            //render view v_index_index
            $this->template->content = View::instance('v_index_index');
            $this->template->title = "Meals for a Steal";
            echo $this->template;
        }
    } # End of method
} # End of class
