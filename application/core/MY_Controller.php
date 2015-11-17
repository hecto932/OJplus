<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{


    function __construct()
    {

        parent::__construct();

        //LOAD LIBRARY LAYOUT
        $this->load->library('layout');

        //LOAD MODEL
        $this->load->model(array('process')); 

        //LOAD HELPER URL
        $this->load->helper('url'); 

        //LOAD FORM
        $this->load->helper('form');

        //LOAD FORM VALIDATION
        $this->load->library('form_validation');

        //LOAD DATABASE
        $this->load->database();

        //LOAD SESSION
        $this->load->library('session');

        //INIT TIMEZONE
        ini_set('date.timezone', TIMEZONE);

        //Load MoiEncode
        $this->load->library('MoiEncode');        

    }
    
    //LOGOUT 
    public function logout()
    {
        //DESTROY SESSION
        $this->session->sess_destroy();
        
        //SET MESSAGE
        $data['error'] = $this->lang->line("Welcome_to_Judge_Online").', '.$this->lang->line("Place_your_login_details");

        //VIEW LOGIN
        $this->load->view('controller/login',$data);
    }

    //VIEW LOGIN
    public function login()
    {
        if($this->session->userdata('site_lang') == NULL)
                $this->session->set_userdata('site_lang',$this->config->item('language'));

        if(isset($_POST['email'])  && isset($_POST['password']))
        {
            $data['email'] = $this->security->xss_clean(trim($this->input->post('email')));
            $data['password'] = $this->security->xss_clean(trim($this->input->post('password')));
            $data['emailErrorFlag'] = ( ( empty($data['email']) ) ? 1 : 0 );
            $data['passwordErrorFlag'] = ( ( empty($data['password']) ) ? 1 : 0 );

            if( $data['emailErrorFlag'] || $data['passwordErrorFlag'] )
            {
                $data['error'] = $this->lang->line("ProvideUsernamePassword");

                $this->load->view('controller/login', $data);
            }
            else
            {
                $loginSuccess = $this->process->login($data);

                if(! $loginSuccess['login'])
                {
                    $data['error'] = $loginSuccess['error'];
                    $this->load->view('controller/login', $data); 
                }
                else
                    $this->index();
            }
        }
        else
        {
            //SET MESSAGE
            $data['error'] = $this->lang->line("Welcome_to_Judge_Online").', '.$this->lang->line("Place_your_login_details");

            //LOAD VIEW
            $this->load->view('controller/login', $data);
        }
    }

    //REGISTER 
    public function register()
    {
        //SET MESSAGE
        $data['error'] = $this->lang->line("Create_account");
        //VIEW LOGIN
        $this->load->view('controller/registerara',$data);
    }




}
