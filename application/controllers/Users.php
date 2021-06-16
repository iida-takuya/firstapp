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
        $data["users"] = $this->users_model->get_users();
    
        // declaring page_title variable
        $data["page_title"] = "List Of Users";
    
        // Assign page title data to header
        $this->load->view('header', $data); 
        $this->load->view('users/index', $data);
        $this->load->view('footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');

        $data["page_title"] = "Create New User";
        $this->form_validation->set_rules('first_name', 'First name', 'required');
        $this->form_validation->set_rules('last_name', 'Last name', 'required');
        $this->form_validation->set_rules('email', 'Email', array('required','valid_email'));

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('header', $data); 
            $this->load->view('users/create', $data);
            $this->load->view('footer');
        } else {
            $this->users_model->create_user();
            redirect(base_url('/'));
        }
    }

}

