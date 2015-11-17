<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller 
{
	//CONSTRUCT
	public function __construct() 
	{
		parent::__construct();

        //LOAD ZIP
        $this->load->library('zip');
	} 
	
	

    //VIEW PROFILE 
    public function profile()
    {
        if($this->process->checkLoggedIn())
        {   
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Profile');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/cropper/cropper.min.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/peity/jquery.peity.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/demo/peity-demo.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/cropper/cropper.min.js', 'footer',$prepend_base_url = TRUE);
                if($this->session->userdata('site_lang') == 'Spanish')
                    $this->layout->add_includes('js', 'assets/js/plugins/validate/Spanish_messages.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/validate/jquery.validate.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF LOGO CROPPER
                $this->layout->add_includes('js', 'assets/js/conf/user/profile.js', 'footer',$prepend_base_url = TRUE);
                
                //GET USER DATA
                $data['user'] = $this->process->get_UserData();

                //GET TEAM DATA
                $data['team'] = $this->process->get_UserTeam();

                //GET CANT CORRECT PROBLEM
                $data['Correct'] = $this->process->get_CorrectProblem();

                //GET CANT SUBMISSION PROBLEM
                $data['Submission'] = $this->process->get_SubmissionProblem();

                //GET CANT 1ER PLACE
                $data['FirstPlace'] = $this->process->get_UserFirstPlace();

                //GET CANT 2nd PLACE
                $data['SecondPlace'] = $this->process->get_UserSecondPlace();

                //GET TROPHY BY USER ID
                $data['Trophy'] = $this->process->get_UserTrophy(); 
                $data['Trophy']['FirstPlace'] = ($data['FirstPlace'] > 0);
                
                //PREVENT DIVISION BY ZERO
                $TempSubmission = $data['Submission'];
                if($TempSubmission == 0)
                    $TempSubmission=1;

                $data['Trophy']['Perfectionnist'] = (round((($data['Correct'] / $TempSubmission)*100),1) >= 80);
                $data['Trophy']['Obsessive'] = (round((($data['Correct'] / $TempSubmission)*100),1) == 100);

                //GET MEDALS BY USER ID
                $data['Medals'] = $this->process->get_UserMedals();

                //LOAD VIEW
                $this->layout->view('user/profile', $data);
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

    
    //CHANGE PASSWORD
    public function ChangePassword()
    {
        if($this->process->checkLoggedIn())
        {   
            if(!$this->process->checkLock())
            {
                //LOAD EMAIL - SEND PASSWORD CHANGE CONFIRMATION
                $this->load->library('email');

                $data['password'] = $this->security->xss_clean($this->input->post('password'));
                $data['passwordFlag'] = ( ( empty($data['password']) ) ? 1 : 0 );

                $data['Rpassword'] = $this->security->xss_clean($this->input->post('Rpassword'));
                $data['RpasswordFlag'] = ( ( empty($data['Rpassword']) ) ? 1 : 0 );

                if(! ($data['passwordFlag'] && $data['RpasswordFlag']))
                {
                    //CHANGE PASSWORD
                    if($this->process->ChangePassword($data))
                        $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/ChangePassword.js', 'footer',$prepend_base_url = TRUE);
                    else
                        $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                }
                
                //LOAD VIEW
                $this->profile();
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
 
    //SET USER PICTURE
    public function SetProfile()
    {
        
        if($this->process->checkLoggedIn() && !$this->process->checkLock())
        {
            if( isset($_POST['picture']) ) 
            {
                $data['picture'] = trim($this->input->post('picture'));
                $data['pictureFlag'] = ( ( empty($data['picture']) ) ? 1 : 0 );


                if(! $data['pictureFlag'] )
                {
                    if($this->process->SetProfile($data))
                        echo 'true';
                    else
                        echo 'false';
                }
                else
                {
                    echo 'false';
                }
            }
            else
            {
                echo 'false'; 
            }
        }
        else
        {
            echo 'logOut'; 
        }
    }

    //SET USER ID
    public function SetUserID()
    {
        
        if($this->process->checkLoggedIn() && !$this->process->checkLock())
        {
            if( isset($_POST['id']) ) 
            {
                $data['id'] = trim($this->input->post('id'));
                $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );


                if(! $data['idFlag'] )
                {
                    $this->session->set_userdata('ProfileID',$data['id']);
                    echo 'true';
                }
                else
                {
                    echo 'false';
                }
            }
            else
            {
                echo 'false'; 
            }
        }
        else
        {
            echo 'logOut'; 
        }
    }
	
	//VIEW FILE UPLOAD
	public function solve_upload()
	{
        if($this->process->checkLoggedIn())
        { 
            if(!$this->process->checkLock())
            {
                $data['id'] = $this->security->xss_clean($this->input->post('solve'));
                $data['idErrorFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );

                if(!$data['idErrorFlag'])
                {

        			//SET TITLE
        			$this->layout->set_title('Judge' . $this->layout->title_separator . 'File Upload');

        			//ADD CSS AND JS HEADER
                    $this->layout->add_includes('css', 'assets/css/plugins/dropzone/basic.css','header',$prepend_base_url = TRUE);
        			$this->layout->add_includes('css', 'assets/css/plugins/dropzone/dropzone.css','header',$prepend_base_url = TRUE);
        			
                    
        			//ADD JS FOOTER
        			$this->layout->add_includes('js', 'assets/js/plugins/dropzone/dropzone.js', 'footer',$prepend_base_url = TRUE);

        			//CONF DROPZONE
        			$this->layout->add_includes('js', 'assets/js/conf/user/conf_dropzone.js', 'footer',$prepend_base_url = TRUE);

        			//LOAD VIEW
        			$this->layout->view('user/solve_upload',$data);
                }
                else
                {
                    $this->problem_list();
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

    

    public function DownloadCases()
    {
        if($this->process->checkLoggedIn())
        { 
            if(!$this->process->checkLock())
            {
                $data['id'] = $this->security->sanitize_filename($this->input->post('problemID'));
                $data['idErrorFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );
                
                if(! $data['idErrorFlag'])
                {
                    $this->load->library('zip');

                    $file_path = './uploads/problem/testcases/'.$data['id'].'/';

                    if (is_dir($file_path)) 
                    {

                        $this->zip->read_dir($file_path,FALSE);

                        $name= 'Problem_'.$data['id'].'.zip';

                        $this->zip->download($name);
                    }
                    else
                    {
                        //CONF MESSAGE
                        $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/NoTestCases.js', 'footer',$prepend_base_url = TRUE);
                        $this->problem_list();
                    }

                }
                else
                    $this->problem_list();
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

    

    public function do_upload()
    {
        if($this->process->checkLoggedIn())
        { 
            if(!$this->process->checkLock())
            {
                $data['id'] = $this->security->xss_clean($this->input->post('name'));
                $data['idErrorFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );

                if(!$data['idErrorFlag'])
                {
                    if (!empty($_FILES)) 
                    {
                        $tempFile = $_FILES['file']['tmp_name'];
                        
                        if ($this->security->xss_clean($tempFile, TRUE))
                        {
                            $fileName = 'problem_'.$data['id'].'.judge';
                        
                            mkdir(getcwd() . '/uploads/user/'.$this->session->userdata('users_id').'/', 0700, true);

                            $targetPath = getcwd() . '/uploads/user/'.$this->session->userdata('users_id').'/';
                            $targetFile = $targetPath . $fileName ;
                            move_uploaded_file($tempFile, $targetFile); 

                            $data['name'] = $fileName;

                            $this->process->set_received($data);
                        }
                    }
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

	//VIEW NEW PROBLEM UPLOAD
	public function problem_new()
	{
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {
        		//SET TITLE
        		$this->layout->set_title('Judge' . $this->layout->title_separator . 'New Problem');

        		//ADD CSS AND JS HEADER
        		$this->layout->add_includes('css', 'assets/css/plugins/steps/jquery.steps.css','header',$prepend_base_url = TRUE);
        		$this->layout->add_includes('css', 'assets/css/plugins/summernote/summernote.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/summernote/summernote-bs3.css','header',$prepend_base_url = TRUE);

        		//ADD JS FOOTER
        		$this->layout->add_includes('js', 'assets/js/plugins/staps/jquery.steps.min.js', 'footer',$prepend_base_url = TRUE);
                if($this->session->userdata('site_lang') == 'Spanish')
                    $this->layout->add_includes('js', 'assets/js/plugins/validate/Spanish_messages.js', 'footer',$prepend_base_url = TRUE);
        		$this->layout->add_includes('js', 'assets/js/plugins/validate/jquery.validate.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/summernote/summernote.min.js', 'footer',$prepend_base_url = TRUE);

        		//CONF DROPZONE
        		$this->layout->add_includes('js', 'assets/js/conf/user/conf_problem_new.js', 'footer',$prepend_base_url = TRUE);

        		//LOAD VIEW
        		$this->layout->view('user/problem_new');
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


    //PROBLEMS EDIT LIST
    public function problem_edit()
    {
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Problem Edit');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF DROPZONE
                $this->layout->add_includes('js', 'assets/js/conf/user/conf_problem_list.js', 'footer',$prepend_base_url = TRUE);

                //GET PROBLEMS LIST
                $data['problems'] = $this->process->get_problemsHide();

                //LOAD VIEW
                $this->layout->view('user/problem_edit', $data);
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
    
    

    //PROBLEMS EDIT DATA
    public function problem_edit_view()
    {
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {
                $data['edit'] = $this->security->xss_clean($this->input->post('edit'));
                $data['editErrorFlag'] = ( ( empty($data['edit']) ) ? 1 : 0 );

                if(!$data['editErrorFlag'])
                {
         
                    //SET TITLE
                    $this->layout->set_title('Judge' . $this->layout->title_separator . 'Edit Problem');

                    //ADD CSS AND JS HEADER
                    $this->layout->add_includes('css', 'assets/css/plugins/iCheck/custom.css','header',$prepend_base_url = TRUE);
                    $this->layout->add_includes('css', 'assets/css/plugins/steps/jquery.steps.css','header',$prepend_base_url = TRUE);
                    $this->layout->add_includes('css', 'assets/css/plugins/summernote/summernote.css','header',$prepend_base_url = TRUE);
                    $this->layout->add_includes('css', 'assets/css/plugins/summernote/summernote-bs3.css','header',$prepend_base_url = TRUE);

                    //ADD JS FOOTER
                    $this->layout->add_includes('js', 'assets/js/plugins/staps/jquery.steps.min.js', 'footer',$prepend_base_url = TRUE);
                    if($this->session->userdata('site_lang') == 'Spanish')
                        $this->layout->add_includes('js', 'assets/js/plugins/validate/Spanish_messages.js', 'footer',$prepend_base_url = TRUE);
                    $this->layout->add_includes('js', 'assets/js/plugins/validate/jquery.validate.min.js', 'footer',$prepend_base_url = TRUE);
                    $this->layout->add_includes('js', 'assets/js/plugins/summernote/summernote.min.js', 'footer',$prepend_base_url = TRUE);

                    //CONF EDIT PROBLEM
                    $this->layout->add_includes('js', 'assets/js/conf/user/conf_problem_new.js', 'footer',$prepend_base_url = TRUE);

                        
                    //GET PROBLEMS TO EDIT
                    $data['problems'] = $this->process->get_edit_problem($data);

                    $this->layout->view('user/problem_edit_view',$data);
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

    

    //VIEW LIST PROBLEMS
    public function problem_list()
    {
        if($this->process->checkLoggedIn())
        {
            if(!$this->process->checkLock())
            { 
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Problem List');

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
                $this->layout->add_includes('js', 'assets/js/conf/user/conf_problem_list.js', 'footer',$prepend_base_url = TRUE);

                //GET PROBLEMS LIST
                $data['problems'] = $this->process->get_problems();

                //LOAD VIEW
                $this->layout->view('user/problem_list', $data);
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

    //VIEW DELETED PROBLEMS
    public function problem_deleted()
    {
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Problem Deleted');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF DROPZONE
                $this->layout->add_includes('js', 'assets/js/conf/user/conf_problem_list.js', 'footer',$prepend_base_url = TRUE);

                //GET PROBLEMS LIST
                $data['problems'] = $this->process->get_problems();

                //LOAD VIEW
                $this->layout->view('user/problem_deleted', $data);
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

    //FILL OPEN PROBLEM
    public function problem_fill()
    {
        if($this->process->checkLoggedIn() && !$this->process->checkLock())
        { 

            $data['id'] = $this->security->xss_clean($this->input->post('id'));
            $data['idErrorFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );

            if(!$data['idErrorFlag'])
            {
                $query=$this->process->problem_fill($data);

                if($query->num_rows() > 0)
                {
                    foreach ($query->result_array() as $row)
                    {
                        $html =  '<div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">'.$row['name'].'</h4>
                                </div>
                                <div class="modal-body">';

                        if($row['background'] != NULL)
                        {
                            $html .='<h1>'.$this->lang->line("Background").'</h4>
                                    <small class="font-bold">'.$row['background'].'</small>';
                        }
                                    

                        $html .= '<h1>'.$this->lang->line("The_Problem").'</h4>
                                    <small class="font-bold">'.$row['description'].'</small>

                                    <h1>'.$this->lang->line("The_Input").'</h4>
                                    <small class="font-bold">'.$row['inputformat'].'</small>
                                    </br>

                                    <h1>'.$this->lang->line("The_Output").'</h4>
                                    <small class="font-bold">'.$row['outputformat'].'</small>
                                    </br>
                                    

                                    <h1>'.$this->lang->line("Sample_Input").'</h4>
                                    <small class="font-bold">'.$row['sampleinput'].'</small>
                                    </br>

                                    <h1>'.$this->lang->line("Sample_Output").'</h4>
                                    <small class="font-bold">'.$row['sampleoutput'].'</small>
                                    </br>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">'.$this->lang->line("Close").'</button>
                                </div>';
                         echo $html;
                    }
                }
            }
        }
        else
        {
            echo 'logOut'; 
        } 
    }

    //FILL INPUT CASE
    public function FillInputCase()
    {
        if($this->process->CheckAdminUser() && !$this->process->checkLock())
        {

            $data['id'] = $this->security->xss_clean($this->input->post('id'));
            $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );

            if(!$data['idFlag'])
            {
                $query=$this->process->FillInputCase($data);

                if($query->num_rows() > 0)
                {
                    $html='<option value="" disabled selected>'.$this->lang->line("Select_option").'</option> ';
                    foreach ($query->result_array() as $row)
                    {
                        $html .='<option value="'.$row['id'].'">'.$row['filename'].'</option> ';
                    }
                }
                echo $html;
            }
        }
        else
        {
            echo 'logOut'; 
        } 
    }

    

    public function problem_new_check()
    {
        echo "<pre>".print_r($_POST, true)."</pre>";
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {

                $data['name'] = $this->security->xss_clean($this->input->post('name'));
                $data['background'] = $this->security->xss_clean($this->input->post('background'));
                $data['level'] = $this->security->xss_clean($this->input->post('level'));
                $data['hide']  = $this->security->xss_clean($this->input->post('hide'));
                $data['keyword'] = $this->security->xss_clean($this->input->post('keyword'));
                $data['the_problem'] = $this->input->post('the_problem');
                $data['the_input']   = $this->input->post('the_input');
                $data['the_output']  = $this->input->post('the_output');
                $data['sample_input']  = $this->input->post('sample_input');
                $data['sample_output'] = $this->input->post('sample_output');


                $data['nameErrorFlag'] = ( ( empty($data['name']) ) ? 1 : 0 );
                $data['levelErrorFlag'] = ( ( empty($data['level']) ) ? 1 : 0 );
                $data['hideErrorFlag'] = ( ( empty($data['hide']) ) ? 1 : 0 );
                $data['the_problemErrorFlag'] = ( ( empty($data['the_problem']) ) ? 1 : 0 );
                $data['the_inputErrorFlag'] = ( ( empty($data['the_input']) ) ? 1 : 0 );
                $data['the_outputErrorFlag'] = ( ( empty($data['the_output']) ) ? 1 : 0 );
                $data['sample_inputErrorFlag'] = ( ( empty($data['sample_input']) ) ? 1 : 0 );
                $data['sample_outputErrorFlag'] = ( ( empty($data['sample_output']) ) ? 1 : 0 );


                if( $data['nameErrorFlag'] || $data['levelErrorFlag'] || $data['hideErrorFlag'] || $data['the_problemErrorFlag'] || 
                    $data['the_inputErrorFlag'] || $data['the_outputErrorFlag'] || $data['sample_inputErrorFlag']|| $data['sample_outputErrorFlag'] )
                {

                    $this->problem_new();
                }
                else
                {
                    if($this->process->problem_new($data))
                    {
                        $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successNewProblem.js', 'footer',$prepend_base_url = TRUE);

                    }
                    else
                    {
                        $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);

                    }

                    $this->problem_new();

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

    public function problem_edit_check()
    {
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {

                $data['id'] = $this->security->xss_clean($this->input->post('id'));
                $data['name'] = $this->security->xss_clean($this->input->post('name'));
                $data['background'] = $this->security->xss_clean($this->input->post('background'));
                $data['level'] = $this->security->xss_clean($this->input->post('level'));
                $data['hide']  = $this->security->xss_clean($this->input->post('hide'));
                $data['keyword'] = $this->security->xss_clean($this->input->post('keyword'));
                $data['the_problem'] = $this->input->post('the_problem');
                $data['the_input'] = $this->input->post('the_input');
                $data['the_output'] = $this->input->post('the_output');
                $data['sample_input'] = $this->input->post('sample_input');
                $data['sample_output'] = $this->input->post('sample_output');


                $data['idErrorFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );
                $data['nameErrorFlag'] = ( ( empty($data['name']) ) ? 1 : 0 );
                $data['levelErrorFlag'] = ( ( empty($data['level']) ) ? 1 : 0 );
                $data['hideErrorFlag'] = ( ( empty($data['hide']) ) ? 1 : 0 );
                $data['the_problemErrorFlag'] = ( ( empty($data['the_problem']) ) ? 1 : 0 );
                $data['the_inputErrorFlag'] = ( ( empty($data['the_input']) ) ? 1 : 0 );
                $data['the_outputErrorFlag'] = ( ( empty($data['the_output']) ) ? 1 : 0 );
                $data['sample_inputErrorFlag'] = ( ( empty($data['sample_input']) ) ? 1 : 0 );
                $data['sample_outputErrorFlag'] = ( ( empty($data['sample_output']) ) ? 1 : 0 );


                if( $data['idErrorFlag'] || $data['nameErrorFlag'] || $data['levelErrorFlag'] || $data['hideErrorFlag'] || $data['the_problemErrorFlag'] || 
                    $data['the_inputErrorFlag'] || $data['the_outputErrorFlag'] || $data['sample_inputErrorFlag']|| $data['sample_outputErrorFlag'] )
                {
                    $this->problem_edit();
                }
                else
                {
                    $problem_edit = $this->process->problem_edit($data);

                    $this->problem_edit();
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

    public function problem_deleted_check()
    {
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {
                $data['deleted'] = $this->security->xss_clean($this->input->post('deleted'));

                $data['deletedErrorFlag'] = ( ( empty($data['deleted']) ) ? 1 : 0 );

                if($data['deletedErrorFlag'])
                {
                     $this->problem_deleted();
                }
                else
                {
                    $this->process->problem_deleted($data);

                    $this->problem_deleted();
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


    //VIEW REPOSITORY CREATE
    public function repository_new()
    {
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Create Repository');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/switchery/switchery.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/steps/jquery.steps.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/staps/jquery.steps.min.js', 'footer',$prepend_base_url = TRUE);
                if($this->session->userdata('site_lang') == 'Spanish')
                    $this->layout->add_includes('js', 'assets/js/plugins/validate/Spanish_messages.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/validate/jquery.validate.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/switchery/switchery.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF 
                $this->layout->add_includes('js', 'assets/js/conf/user/conf_repository_new.js', 'footer',$prepend_base_url = TRUE);


                //GET PROBLEMS LIST
                $data['problems'] = $this->process->get_problems();

                //LOAD VIEW
                $this->layout->view('user/repository_new',$data);
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

    public function repository_new_check()
    {
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {
                $data['name'] = $this->security->xss_clean($this->input->post('name'));
                $data['description'] = $this->security->xss_clean($this->input->post('description'));
                $data['check_list'] = $this->security->xss_clean($this->input->post('check_list'));

                $data['nameErrorFlag'] = ( ( empty($data['name']) ) ? 1 : 0 );
                $data['descriptionErrorFlag'] = ( ( empty($data['description']) ) ? 1 : 0 );
                $data['check_listErrorFlag'] = ( ( empty($data['check_list']) ) ? 1 : 0 );


                if(! $data['nameErrorFlag'] || $data['descriptionErrorFlag'] || $data['check_listErrorFlag'] )
                {
                    
                    if($this->process->repository_new($data))
                    {
                         $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successRepoNew.js', 'footer',$prepend_base_url = TRUE);
                    }
                    else
                    {
                         $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                    }  
                }               

                $this->repository_new();
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

    //VIEW DELETED REPOSITORY
    public function repository_deleted()
    {
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Problem Deleted');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF DROPZONE
                $this->layout->add_includes('js', 'assets/js/conf/user/conf_problem_list.js', 'footer',$prepend_base_url = TRUE);

                //GET PROBLEMS LIST
                $data['repository'] = $this->process->get_repository();

                //LOAD VIEW
                $this->layout->view('user/repository_deleted', $data);
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
    
    public function repository_deleted_check()
    {
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {
                $data['deleted'] = $this->security->xss_clean($this->input->post('deleted'));

                $data['deletedErrorFlag'] = ( ( empty($data['deleted']) ) ? 1 : 0 );

                if($data['deletedErrorFlag'])
                {
                     $this->repository_deleted();
                }
                else
                {
                    $this->process->repository_deleted($data);

                    $this->repository_deleted();
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

    //VIEW DELETED REPOSITORY
    public function repository_list()
    {
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Problem Deleted');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF DROPZONE
                $this->layout->add_includes('js', 'assets/js/conf/user/conf_repository_list.js', 'footer',$prepend_base_url = TRUE);

                //GET PROBLEMS LIST
                $data['repository'] = $this->process->get_repository();

                //LOAD VIEW
                $this->layout->view('user/repository_list', $data);
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

    //VIEW LIST PROBLEMS
    public function repository_list_open()
    {
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {
                $id['open'] = $this->security->xss_clean($this->input->post('open'));
                $id['openErrorFlag'] = ( ( empty($id['open']) ) ? 1 : 0 );
                
                if(!$id['openErrorFlag'])
                {
                    //SET TITLE
                    $this->layout->set_title('Judge' . $this->layout->title_separator . 'Problem List');

                    //ADD CSS AND JS HEADER
                    $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                    $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                    $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);

                    //ADD JS FOOTER
                    $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                    $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                    $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                    $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);

                    //CONF DROPZONE
                    $this->layout->add_includes('js', 'assets/js/conf/user/conf_problem_list.js', 'footer',$prepend_base_url = TRUE);

                    //GET PROBLEMS LIST
                    $data['repository'] = $this->process->get_problems_id($id);

                    //LOAD VIEW
                    $this->layout->view('user/repository_list_open', $data);

                }
                else
                {
                    $this->repository_list();
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

    //VIEW LEADERBOARD
    public function leaderboard()
    {
        if($this->process->checkLoggedIn())
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Problem List');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF DROPZONE
                $this->layout->add_includes('js', 'assets/js/conf/user/conf_problem_list.js', 'footer',$prepend_base_url = TRUE);

                //GET PROBLEMS LIST
                $data['leaderboard'] = $this->process->get_leaderboard();

                //LOAD VIEW
                $this->layout->view('user/leaderboard', $data);
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



	
		
}
