<?php
class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // This line will load user model to this controller
        $this->load->model('users_model');
    }

    public function index()
    {
        // Use method get_users of user model to get users list
        $data["users"] = $this->users_model->get_users();

        $this->load->view('header'); 

        // assign users list to view
        $this->load->view('users/index', $data);
        $this->load->view('footer');
    }
}
