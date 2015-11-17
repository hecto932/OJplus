<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller extends MY_Controller 
{
	//CONSTRUCT
	public function __construct() 
	{
		parent::__construct();

        //LOAD ZIP
        $this->load->library('zip');

        //LOAD GEOIP
        $this->load->library('timezone');   

        //LOAD SECURITY FOR SHA1 PASSWORD RECOVERY
        $this->load->helper('security');

        //LOAD EMAIL - SEND PASSWORD RECOVERY
        $this->load->library('email');

	}

	//VIEW INDEX
	public function index()
	{	
        if($this->process->checkLoggedIn())
        {
            if(!$this->process->checkLock())
            {

                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . $this->lang->line("Main"));

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF 
                $this->layout->add_includes('js', 'assets/js/conf/controller/Main.js', 'footer',$prepend_base_url = TRUE);

                //GET TOP USERS
                $data['TopUsers'] = $this->process->get_TopUsers();

                //GET TOP TEAM
                $data['TopTeam']  = $this->process->get_TopTeam();

                if($this->process->CheckRole(1))
                {
                    //GET CANT PROBLEMS CORRECT
                    $data['ProblemStats'] = $this->process->get_CantCorrectProblems();

                    //GET CANT MARATHON
                    $data['marathon'] = $this->process->get_CantMarathon();
                
                    //GET SUBMISSION
                    $data['Submission']  = $this->process->get_Submission();

                    //LOAD VIEW
                    $this->layout->view('controller/index',$data);

                }
                else
                {

                    //GET TOTAL USERS
                    $data['TotalUsers']  = $this->process->get_TotalUsers();

                    //GET TOTAL TEAMS
                    $data['TotalTeams']  = $this->process->get_TotalTeams();

                    //GET TOTAL PROBLEMS
                    $data['TotalProblems']  = $this->process->get_TotalProblems();

                    //GET TOTAL REPOSITORIES
                    $data['TotalRepositories']  = $this->process->get_TotalRepositories();

                    //GET TOTAL SUBMISSION
                    $data['Submission']  = $this->process->get_AllSubmission();

                    //LOAD VIEW
                    $this->layout->view('admin/index',$data);

                }
            }
            else
            {
                $this->lock();
            }    		 
        }
        else
        {
            $this->logout();
        }

	}

	

	//VIEW REGISTER
	public function register()
	{
		if( isset($_POST['name']) && isset($_POST['email'])  && isset($_POST['password'])) 
        {

	        $data['name'] = $this->security->xss_clean(trim($this->input->post('name')));
	    	$data['email'] = $this->security->xss_clean(trim($this->input->post('email')));
	        $data['password'] = $this->moiencode->encode($this->security->xss_clean(trim($this->input->post('password'))));

	        $data['usernameErrorFlag'] = ( ( empty($data['name']) ) ? 1 : 0 );
	        $data['emailErrorFlag'] = ( ( empty($data['email']) ) ? 1 : 0 );
	        $data['passwordErrorFlag'] = ( ( empty($data['password']) ) ? 1 : 0 );

	        if( $data['usernameErrorFlag'] || $data['passwordErrorFlag'] || $data['emailErrorFlag'])
	        {
	            $data['error'] = 'Error - Please complete all fields';
	            //VIEW REGISTER
	            $this->load->view('controller/register', $register);
	        }
			else
	        {
	        	$RegisterSuccess = $this->process->register($data);

	            if(!$RegisterSuccess)
	            {
	                $data['error'] = 'Error - Email already in use';
	                $this->load->view('controller/register', $data);
	            }
	            else
	                $this->index();
	        }
	    }
	    else
	    {
	    	$data['error'] = $this->lang->line("Create_account");
			//LOAD VIEW
			$this->load->view('controller/register',$data);
	    }

	}


    public function lock()
	{
        if($this->process->checkLoggedIn())
        {
            $this->session->set_userdata('lock',TRUE); 
            $data['error'] = $this->lang->line("Lock").'</br>'.$this->lang->line("Enter_your_password");
            $this->load->view('controller/lockscreen', $data);
        }
        else
        {
            $data['error'] = $this->lang->line("Welcome_to_Judge_Online").', '.$this->lang->line("Place_your_login_details");
            $this->load->view('controller/login', $data); 
        }
	}

    

    public function Unlock()
    {
        $data['password'] = $this->security->xss_clean(trim($this->input->post('password')));
        $data['passwordErrorFlag'] = ( ( empty($data['password']) ) ? 1 : 0 );

        if($data['passwordErrorFlag'])
        {
            $data['error'] = $this->lang->line("ErrorProvidePassword");
            $this->load->view('controller/lockscreen', $data);
        }
        else
        {
            $lockSuccess = $this->process->lock($data);

            if(!$lockSuccess)
            {
            	$data['error'] = $this->lang->line("WrongPassword");
                $this->load->view('controller/lockscreen', $data);
            }
            else
            	$this->index();
        }
    }

    //GET LANG
    public function get_Lang() 
    {
        echo $this->session->userdata('site_lang');
    }

    
    //VIEW PASSWORD RECOVERY
    public function ForgotPassword()
    {   
        if( isset($_POST['email'])) 
        {
            $data['email'] = $this->security->xss_clean(trim($this->input->post('email')));

            $this->process->ForgotPassword($data);
            
            //SET MESSAGE
            $data['error'] = $this->lang->line("Send_Password");

            //LOAD VIEW
            $this->load->view('controller/login', $data);
        }
        else
        {
            $this->load->view('controller/forgotpassword');
        }
        
    }

    //RESET PASSWORD
    public function ResetPassword()
    {
        
        $data['id'] = $this->uri->segment(3);
        $data['hash'] = $this->uri->segment(4);

        if($data['id'] && $data['hash'])
        {
            //SET RANDOM PASSWORD AND SEND EMAIL
            $result = $this->process->ResetPassword($data);
        }

        //SET MESSAGE
        $data['error'] = $result['error'];

        //LOAD VIEW
         $this->load->view('controller/login', $data);
    }

    //ALLOW COUNTRY
    public function AllowCountry()
    {
        
        $data['id'] = $this->uri->segment(3);
        $data['country'] = $this->uri->segment(4);
        $data['hash'] = $this->uri->segment(5);

        if($data['id'] && $data['country'] && $data['hash'])
        {
            //SET RANDOM PASSWORD AND SEND EMAIL
            $result = $this->process->AllowCountry($data);
        }

        //SET MESSAGE
        $data['error'] = $result['error'];

        //LOAD VIEW
        $this->load->view('controller/login', $data);
    }
	
}
 

