<?php
class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->helper('url');
    }

    public function index()
    {    
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data["users"] = $this->users_model->get_users();

        $data["page_title"] = "List Of Users";
        
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
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('header', $data);
            $this->load->view('users/create', $data);
            $this->load->view('footer');
        } else {
            $this->users_model->create_user();
            redirect(base_url('/'));
        }
    }

    public function update($user_id)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data["user"] = $this->users_model->get_user($user_id);

        $data["page_title"] = "update User";
        
        $this->form_validation->set_rules('first_name', 'First name', 'required');
        $this->form_validation->set_rules('last_name', 'First name', 'required');
        $this->form_validation->set_rules('email', 'Email', array('required', 'valid_email'));
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('header', $data);
            $this->load->view('users/update', $data);
            $this->load->view('footer');
        } else {
            $this->users_model->update_user($user_id);
            redirect(base_url('/'));
        }
    }

    public function detail($user_id)
    {
        $data["user"] = $this->users_model->get_user($user_id);

        $data["page_title"] = "detail User";

        $this->load->view('header', $data); 
        $this->load->view('users/detail', $data);
        $this->load->view('footer');
    }

    public function delete($user_id)
    {
        $this->users_model->delete_user($user_id);
        redirect(base_url('/'));
    }

    public function delete_multi()
    {
        $user_ids = $this->input->post('ids');
        if ($user_ids !== null) {
            $this->users_model->delete_users($user_ids);
        }
        redirect(base_url('/'));
    }
}
