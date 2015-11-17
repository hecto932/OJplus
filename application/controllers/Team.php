<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends MY_Controller
{
	//CONSTRUCT
	public function __construct() 
	{
		parent::__construct();

        //LOAD DATE HELPER
        $this->load->helper('date');
	}
	
	//VIEW MARATHON LIST - TEAM ALLOW
	public function MarathonList()
	{
        if($this->process->checkLoggedIn())
        {

            if(!$this->process->checkLock())
            {

        		//SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Marathon Allowed');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dropzone/basic.css','header',$prepend_base_url = TRUE);
        		$this->layout->add_includes('css', 'assets/css/plugins/dropzone/dropzone.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                if($this->session->userdata('site_lang') == 'Spanish')
                    $this->layout->add_includes('js', 'assets/js/plugins/validate/Spanish_messages.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/validate/jquery.validate.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);
            	$this->layout->add_includes('js', 'assets/js/plugins/dropzone/dropzone.js', 'footer',$prepend_base_url = TRUE);

                //CONF MESSAGE
                $this->layout->add_includes('js', 'assets/js/conf/team/MarathonList.js', 'footer',$prepend_base_url = TRUE);

                if( isset($_POST['open'])) 
                {
                    $data['id'] = $this->security->xss_clean($this->input->post('open'));
                    $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );

                    $data['marathon']=$data['id'];

                    if(! $data['idFlag'] )
                    {
                        if($this->process->get_MarathonStart($data))
                        {
                        	//CONF DROPZONE
                			$this->layout->add_includes('js', 'assets/js/conf/team/MarathonRepo.js', 'footer',$prepend_base_url = TRUE);

                            //GET PROBLEMS LIST
                            $data['problems'] = $this->process->get_MarathonRepo($data);

                            //GET PROBLEMS LIST
                            $data['problem'] = $this->process->get_MarathonProblems($data);
                            
                            //GET TEAMS
                            $data['teams'] = $this->process->get_MarathonTeam($data);

                            //LOAD VIEW
                            $this->layout->view('team/MarathonRepo', $data);
                        }
                        else
                        {
                            //GET MARATHON LIST
                            $data['marathon'] = $this->process->get_marathonAllow();

                            //LOAD VIEW
                            $this->layout->view('team/MarathonList', $data);

                        }
                    }
                }
                else
                {
        	        //GET MARATHON LIST
        	        $data['marathon'] = $this->process->get_marathonAllow();

        	        //LOAD VIEW
        	        $this->layout->view('team/MarathonList', $data);
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
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Team Leaderboard');

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
                $data['leaderboard'] = $this->process->get_Teamleaderboard();

                //LOAD VIEW
                $this->layout->view('team/Leaderboard', $data);
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

    //UPLOAD SOLVE - MARATHON
    public function MarathonSolve()
    {
        if($this->process->checkLoggedIn())
        {
            if(!$this->process->checkLock())
            {
                $this->load->library('upload');
                
                $this->load->helper('url');

                $this->load->helper('html');

                $this->load->helper('form');

                $data['marathon'] = $this->security->xss_clean($this->input->post('marathon'));
                $data['problem']  = $this->security->xss_clean($this->input->post('problem'));
                $data['marathonFlag'] = ( ( empty($data['marathon']) ) ? 1 : 0 );
                $data['problemFlag'] = ( ( empty($data['problem']) ) ? 1 : 0 );

                if($this->process->get_MarathonStart($data))
                {

                    if(! ($data['marathonFlag'] || $data['problemFlag']))
                    {
                        if (!empty($_FILES)) 
                        {
                        	$count = $this->process->getSolveCount($data);

                            $tempFile = $_FILES['file']['tmp_name'];
                            
                            if ($this->security->xss_clean($tempFile, TRUE))
                            {

                                $fileName = 'problem_'.$data['problem'].'_'.($count+1).'.judge';

                                $dir = '/uploads/marathon/'.$data['marathon'].'/'.$this->session->userdata('teams_id').'/'.$data['problem'].'/';

                                mkdir(getcwd() . $dir, 0700, true);

                                $targetPath = getcwd() . $dir;

                                $targetFile = $targetPath . $fileName ;

                                move_uploaded_file($tempFile, $targetFile); 

                                $data['name'] = $fileName;

                                $this->process->set_MarathonReceived($data);
                            }
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

    //VIEW TEAM CREATE
    public function team_create_view()
    {
        if($this->process->checkLoggedIn())
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Team Create');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/steps/jquery.steps.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/imagePicker/image-picker.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/pace/pace.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/staps/jquery.steps.min.js', 'footer',$prepend_base_url = TRUE);
                if($this->session->userdata('site_lang') == 'Spanish')
                    $this->layout->add_includes('js', 'assets/js/plugins/validate/Spanish_messages.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/validate/jquery.validate.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/imagePicker/image-picker.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF DROPZONE
                $this->layout->add_includes('js', 'assets/js/conf/team/conf_team_create.js', 'footer',$prepend_base_url = TRUE);


                //LOAD VIEW
                $data['error'] = 'Error - Fill all fields';
                $this->layout->view('team/team_create_view',$data);
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

    public function team_create_check()
    {
        if($this->process->checkLoggedIn())
        {
            if(!$this->process->checkLock())
            {
                $data['name'] = $this->security->xss_clean($this->input->post('userName'));
                $data['description'] = $this->security->xss_clean($this->input->post('description'));
                $data['teamLogo'] = $this->input->post('teamLogo');

                $data['nameErrorFlag'] = ( ( empty($data['name']) ) ? 1 : 0 );
                $data['descriptionErrorFlag'] = ( ( empty($data['description']) ) ? 1 : 0 );
                $data['teamLogoErrorFlag'] = ( ( empty($data['teamLogo']) ) ? 1 : 0 );


                if( $data['nameErrorFlag'] || $data['descriptionErrorFlag'] || $data['teamLogoErrorFlag'])
                {
                    $this->team_create_view();
                }
                else
                {
                    $team_createSuccess = $this->process->team_create($data);

                    if(!$team_createSuccess)
                    {

                        $this->team_create_view();

                    }
                    else
                        $this->team_edit_view();
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

    //VIEW ADMIN TEAM
    public function team_admin_view()
    {
        if($this->process->checkLoggedIn())
        {
            if(!$this->process->checkLock())
            {

                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'File Upload');

                //LOAD VIEW
                $this->layout->view('team/team_admin_view');
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

    //FILL TEAM MEMBERS
    public function autocomplete()
    {
        if($this->process->checkLoggedIn()  && !$this->process->checkLock())
        {

            $data['queryString'] = strtolower($this->security->xss_clean(trim($this->input->post('queryString'))));
            $data['queryStringErrorFlag'] = ( ( empty($data['queryString']) ) ? 1 : 0 );

            if(!$data['queryStringErrorFlag'])
            {
                $query=$this->process->search_user($data);

                if($query->num_rows() > 0)
                {
                    foreach ($query->result_array() as $row)
                    {
                        if($row['id'] != $this->session->userdata('users_id'))
                        {
                            $data['id'] = $row['id'];

                            if(! $this->process->isInATeamId($data))
                            {
                                echo   '<tr>
                                            <td class="project-status">
                                                <span class="label label-primary">'.$this->lang->line("Active").'</span>
                                            </td>
                                            <td class="project-title">
                                                <a href="project_detail.html">'.$row['name'].'</a>
                                                <br>
                                                <small>'.$row['email'].'</small>
                                            </td>
                                            <td class="project-completion">
                                                <small>'.$this->lang->line("Level").' '.$row['level'].'</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: '.$row['progress'].'%;" class="progress-bar"></div>
                                                </div>
                                            </td>
                                            <td class="project-people">
                                                <a href=""><img alt="image" class="img-circle" src="'.$row['picture'].'"></a>
                                            </td>
                                            <td class="project-actions">
                                                <button class="btn btn-lg btn-primary" onclick="add_member('.$this->session->userdata('teams_id').','.$row['id'].')" type="submit">'.$this->lang->line("Add").'</button>
                                            </td>
                                        </tr>';
                            }
                        }
                    }
                }
            } 
        }
        else
        {
            echo 'logOut'; 
        }
    }

    //VIEW TEAM MEMBERS
    public function team_members_view()
    {
        if($this->process->checkLoggedIn())
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Team Members');
             
                //CONF 
                $this->layout->add_includes('js', 'assets/js/conf/team/conf_team_members.js', 'footer',$prepend_base_url = TRUE);

                //GET ACTIVE AND REQUEST MEMBERS
                $data['active'] = $this->process->get_active();
                $data['request'] =$this->process->get_request();

                //LOAD VIEW
                $this->layout->view('team/team_members_view', $data);
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

    
    //VIEW EDIT TEAM
    public function team_edit_view()
    {
        if($this->process->checkLoggedIn())
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Team Members');

                //GET TEAM DATA
                $data['team'] = $this->process->get_Myteam();

                //LOAD VIEW
                $this->layout->view('team/team_edit_view', $data);
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

    public function team_members_check()
    {
        if($this->process->checkLoggedIn())
        {

            $data['team'] = $this->security->xss_clean($this->input->post('team'));
            $data['user'] = $this->security->xss_clean($this->input->post('user'));

            $data['teamErrorFlag'] = ( ( empty($data['team']) ) ? 1 : 0 );
            $data['userErrorFlag'] = ( ( empty($data['user']) ) ? 1 : 0 );


            if( $data['teamErrorFlag'] || $data['userErrorFlag'])
            {
                echo "FALSE";
            }
            else
            {
                $team_addSuccess=$this->process->add_member($data);

                if($team_addSuccess == 0)
                {
                    echo "FALSE";  
                }
                else
                {
                    if($team_addSuccess == 1)
                    {
                        echo "TRUE";  
                    }
                    else
                        echo "REQUESTED";
                }
            }
        }
        else
        {
            echo 'logOut'; 
        }
    }

    public function team_edit_check()
    {
        if($this->process->checkLoggedIn())
        {
            if(!$this->process->checkLock())
            {
                $data['name'] = $this->security->xss_clean($this->input->post('name'));
                $data['description'] = $this->security->xss_clean($this->input->post('description'));

                $data['nameErrorFlag'] = ( ( empty($data['name']) ) ? 1 : 0 );
                $data['descriptionErrorFlag'] = ( ( empty($data['description']) ) ? 1 : 0 );


                if( $data['nameErrorFlag'] || $data['descriptionErrorFlag'])
                {
                    $this->team_edit_view();
                }
                else
                {
                    $team_edit=$this->process->team_edit($data);

                    $this->team_edit_view();
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

    public function team_deleted()
    {
        if($this->process->checkLoggedIn())
        {
            if(!$this->process->checkLock())
            {

                $data['deleted'] = $this->security->xss_clean($this->input->post('deleted'));

                $data['deletedErrorFlag'] = ( ( empty($data['deleted']) ) ? 1 : 0 );

                if($data['deletedErrorFlag'])
                {
                     $this->team_edit_view();
                }
                else
                {
                    if($this->process->team_deleted())
                    {
                        $this->session->set_userdata('teams_id',NULL);
                        $this->team_create_view();
                    }
                    else
                        $this->team_edit_view();   
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

    //VIEW EDIT TEAM
    public function team_logo_view()
    {
        if($this->process->checkLoggedIn())
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Team Logo');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/cropper/cropper.min.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/cropper/cropper.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF LOGO CROPPER
                $this->layout->add_includes('js', 'assets/js/conf/team/conf_team_logo.js', 'footer',$prepend_base_url = TRUE);

                //LOAD VIEW
                $this->layout->view('team/team_logo_view');
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


    
    //FILL LEADERBOARD MARATHON
    public function LeaderboardFill()
    {
        if($this->process->checkLoggedIn()  && !$this->process->checkLock())
        {

            $leaderboard =NULL;
            $data['marathon'] = $this->security->xss_clean($this->input->post('id'));
            $data['marathonFlag'] = ( ( empty($data['marathon']) ) ? 1 : 0 );
    		        
            $this->process->LeaderboardFill($data);
            $leaderboard = $this->session->userdata('Leaderboard');
            
            echo json_encode($leaderboard);

        }
        else
        {
            echo 'logOut'; 
        }
    }

    
    //LIST PENDING REQUEST TEAM
    public function TeamRequest()
    {
        if($this->process->checkLoggedIn())
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Team Request');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dropzone/basic.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF MESSAGE
                $this->layout->add_includes('js', 'assets/js/conf/team/TeamRequest.js', 'footer',$prepend_base_url = TRUE);


                if( isset($_POST['id']) && isset($_POST['join']) ) 
                {
                    $data['id']   = $this->security->xss_clean($this->input->post('id'));
                    $data['join'] = $this->security->xss_clean($this->input->post('join'));

                    $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );

 
                    if(! $data['idFlag'] )
                    {
                        if($data['join'] == 'TRUE')
                        {
                            if($this->process->TeamJoin($data))
                                $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successTeamJoin.js', 'footer',$prepend_base_url = TRUE);
                             else
                                $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                        }
                        else
                        {
                            if($this->process->TeamReject($data))
                                $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successTeamReject.js', 'footer',$prepend_base_url = TRUE);
                             else
                                $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                        }

                    }
                }
                
                //GET MARATHON LIST
                $data['request'] = $this->process->get_TeamRequest();

                //LOAD VIEW
                $this->layout->view('team/TeamRequest', $data);
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

    
    //LEAVE TEAM
    public function TeamOut()
    {
        if($this->process->checkLoggedIn())
        {
            if(!$this->process->checkLock())
            { 
                if($this->process->isInATeam())
                {
                    $this->process->TeamOut();
                    $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successTeamOut.js', 'footer',$prepend_base_url = TRUE);
                }

                //LOAD VIEW
                $this->team_create_view();
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

    //SET TEAM LOGO
    public function SetLogo()
    {

        if($this->process->checkLoggedIn()  && !$this->process->checkLock())
        {
            if( isset($_POST['logo']) ) 
            {
                $data['logo'] = $this->input->post('logo');
                $data['logoFlag'] = ( ( empty($data['logo']) ) ? 1 : 0 );


                if(! $data['logoFlag'] )
                {
                    if($this->process->SetLogo($data))
                        echo 'true';
                    else
                        echo 'false';
                }
                else
                {
                    echo 'false';
                }
            }
        }
        else
        {
            echo 'logOut'; 
        }
        
    }

    


}