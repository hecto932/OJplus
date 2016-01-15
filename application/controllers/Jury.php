<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jury extends MY_Controller 
{
	//CONSTRUCT
	public function __construct() 
	{
		parent::__construct();
	}
	
   //VIEW MARATHON LIST
    public function Marathon()
    {   
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {

                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Marathon List');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);
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
                //CONF
                $this->layout->add_includes('js', 'assets/js/conf/team/MarathonList.js', 'footer',$prepend_base_url = TRUE);


                if( isset($_POST['open'])) 
                {
                    $data['id'] = $this->security->xss_clean($this->input->post('open'));


                    $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );

                    if(! $data['idFlag'] )
                    { 
                        //CONF DROPZONE
                        $this->layout->add_includes('js', 'assets/js/conf/jury/MarathonRepo.js', 'footer',$prepend_base_url = TRUE);

                        $this->layout->add_includes('css', 'assets/css/plugins/switchery/switchery.css','header',$prepend_base_url = TRUE);
                        $this->layout->add_includes('js', 'assets/js/plugins/switchery/switchery.js', 'footer',$prepend_base_url = TRUE);

                        //GET PROBLEMS LIST
                        $data['problems'] = $this->process->get_MarathonRepo($data);

                        //GET PROBLEMS LIST
                        $data['problem'] = $this->process->get_MarathonProblems($data);
                        
                        //GET TEAMS
                        $data['teams'] = $this->process->get_MarathonTeam($data);

                        //LOAD VIEW
                        $this->layout->view('Jury/MarathonRepo', $data);
                    }
                }
                else
                {
                    if( isset($_POST['marathon'])) 
                    {
                        $data['marathon'] = $this->security->xss_clean($this->input->post('marathon'));
                        $data['all'] = $this->security->xss_clean($this->input->post('all'));

                        $data['marathonFlag'] = ( ( empty($data['marathon']) ) ? 1 : 0 );


                        if(! $data['marathonFlag'])
                        {

                            //GET PROBLEMS LIST
                            if($this->process->ReJudgeMarathon($data))
                            {
                                
                                $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successReJudgeMarathon.js', 'footer',$prepend_base_url = TRUE);

                            }
                            else
                            {
                                $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                            }

                        }
                        //GET MARATHON LIST
                        $data['marathon'] = $this->process->get_marathonJury();

                        //LOAD VIEW
                        $this->layout->view('Jury/Marathon', $data);
                        
                    }
                    else
                    {
                        //GET MARATHON LIST
                        $data['marathon'] = $this->process->get_marathonJury();

                        //LOAD VIEW
                        $this->layout->view('Jury/Marathon', $data);
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



    
    //VIEW CLARIFICATION
    public function Clarification()
    {
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Clarification');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/iCheck/custom.css','header',$prepend_base_url = TRUE);


                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/iCheck/icheck.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF 
                $this->layout->add_includes('js', 'assets/js/conf/jury/Clarification.js', 'footer',$prepend_base_url = TRUE);

                if( isset($_POST['open'])) 
                {
                    $data['id'] = $this->security->xss_clean($this->input->post('open'));

                    $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );

                    if(! $data['idFlag'] )
                    {
                        
                        //GET PROBLEMS LIST
                        $data['problems'] = $this->process->get_MarathonProblems($data);
                        
                        //GET TEAMS
                        $data['teams'] = $this->process->get_MarathonTeam($data);

                        //LOAD VIEW
                        $this->layout->view('Jury/Clarification',$data); 
                    }
                }
                else
                {
                    //LOAD VIEW
                    $this->ListMarathon();
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

    //FILL CLARIFICATION HISTORY
    public function FillClarification()
    {
        if($this->process->CheckAdminUser() && !$this->process->checkLock())
        {

            $data['team'] = $this->security->xss_clean($this->input->post('team'));
            $data['teamFlag'] = ( ( empty($data['team']) ) ? 1 : 0 );

            $data['marathon'] = $this->security->xss_clean($this->input->post('marathon'));
            $data['marathonFlag'] = ( ( empty($data['marathon']) ) ? 1 : 0 );
            
            $html='';

            if(! $data['marathonFlag'])
            {
                $query=$this->process->FillClarification($data);

                if($query->num_rows() > 0)
                {
                    foreach ($query->result_array() as $row)
                    {
                        $html .='<div class="chat-message '.((($row['jury'])=='t') ? "right": "left").'" >
                                    <div class="message">
                                        <a class="message-author" href="#">'.$row["name"].''.((($row["problems_id"])!= 0) ? " - ".$this->lang->line("Problem").": ".$row["problems_id"]: "").'</a>
                                        <span class="message-date">'.$row['time'].'</span>
                                        <span class="message-content">'.$row['text'].'</span>
                                    </div>
                                </div>';
                    }
                }
                
            }
            echo $html; 
        }
        else
        {
            echo 'logOut'; 
        }
    }

    //SEND MESSAGE CLARIFICATION
    public function SendClarification()
    {
        if($this->process->CheckAdminUser() && !$this->process->checkLock())
        {

            $data['team'] = $this->security->xss_clean($this->input->post('team'));
            $data['teamFlag'] = ( ( empty($data['team']) ) ? 1 : 0 );

            $data['marathon'] = $this->security->xss_clean($this->input->post('marathon'));
            $data['marathonFlag'] = ( ( empty($data['marathon']) ) ? 1 : 0 );

            $data['text'] = $this->security->xss_clean($this->input->post('text'));
            $data['textFlag'] = ( ( empty($data['text']) ) ? 1 : 0 );

            $data['problem'] = $this->security->xss_clean($this->input->post('problem'));
            $data['problemFlag'] = ( ( empty($data['problem']) ) ? 1 : 0 );

            echo $this->process->JuryClarification($data);
        }
        else
        {
            echo 'logOut'; 
        }
    }

    
    //SEND MESSAGE CLARIFICATION
    public function SendUserClarification()
    {
        if($this->process->checkLoggedIn() && !$this->process->checkLock())
        {  
    
            $data['marathon'] = $this->security->xss_clean($this->input->post('marathon'));
            $data['marathonFlag'] = ( ( empty($data['marathon']) ) ? 1 : 0 );

            $data['text'] = $this->security->xss_clean($this->input->post('text'));
            $data['textFlag'] = ( ( empty($data['text']) ) ? 1 : 0 );

            $data['problem'] = $this->security->xss_clean($this->input->post('problem'));
            $data['problemFlag'] = ( ( empty($data['problem']) ) ? 1 : 0 );

            if($this->process->get_MarathonStart($data))
            {
                echo $this->process->UserClarification($data);
            }
            else
                echo '';
        }
        else
        {
            echo 'logOut'; 
        }
    }


    //FILL TEAM CLARIFICATION HISTORY
    public function FillTeamClarification()
    {
        if($this->process->checkLoggedIn()  && !$this->process->checkLock())
        {
            $data['problem'] = $this->security->xss_clean($this->input->post('problem'));
            $data['problemFlag'] = ( ( empty($data['problem']) ) ? 1 : 0 );

            $data['marathon'] = $this->security->xss_clean($this->input->post('marathon'));
            $data['marathonFlag'] = ( ( empty($data['marathon']) ) ? 1 : 0 );
            
            $html='';

            if(! $data['marathonFlag'] )
            {
                $query=$this->process->FillTeamClarification($data);

                if($query->num_rows() > 0)
                {
                    foreach ($query->result_array() as $row)
                    {
                        $html .='<div class="chat-message '.((($row['jury'])=='t') ? "right": "left").'">
                                    <div class="message">
                                        <a class="message-author" href="#">'.$row['name'].'</a>
                                        <span class="message-date">'.$row['time'].'</span>
                                        <span class="message-content">'.$row['text'].'</span>
                                    </div>
                                </div>';
                    }
                }
            }
            echo $html; 
        }
        else
        {
            echo 'logOut'; 
        }
    }

    //VIEW MARATHON LIST
    public function JudgeList()
    {   
        
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Judge List');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/switchery/switchery.css','header',$prepend_base_url = TRUE);
                //ADD JS FOOTER
                if($this->session->userdata('site_lang') == 'Spanish')
                    $this->layout->add_includes('js', 'assets/js/plugins/validate/Spanish_messages.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/validate/jquery.validate.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/switchery/switchery.js', 'footer',$prepend_base_url = TRUE);

                //CONF MESSAGE
                $this->layout->add_includes('js', 'assets/js/conf/jury/JudgeCases.js', 'footer',$prepend_base_url = TRUE);

                
                if( isset($_POST['marathon']) && isset($_POST['problem']) && isset($_POST['all'])) 
                {
                    $data['marathon'] = $this->security->xss_clean($this->input->post('marathon'));
                    $data['all']      = $this->security->xss_clean($this->input->post('all'));
                    $data['problem'] = $this->security->xss_clean($this->input->post('problem'));

                    $data['marathonFlag'] = ( ( empty($data['marathon']) ) ? 1 : 0 );
                    $data['problemFlag'] = ( ( empty($data['problem']) ) ? 1 : 0 );


                    if(! $data['marathonFlag'] || $data['problemFlag'] )
                    {

                        //GET PROBLEMS LIST
                        if($this->process->ReJudgeProblem($data))
                        {
                            
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successReJudgeProblem.js', 'footer',$prepend_base_url = TRUE);

                        }
                        else
                        {
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                        }

                        //GET MARATHON RECEIVED
                        $data['received'] = $this->process->get_marathonReceived($data);

                        //LOAD VIEW
                        $this->layout->view('Jury/JudgeList', $data);

                    }
                    
                    
                }
                else
                {
                    if( isset($_POST['marathonJudge']) && isset($_POST['problemJudge'])) 
                    {
                        $data['marathon'] = $this->security->xss_clean($this->input->post('marathonJudge'));
                        $data['marathonFlag'] = ( ( empty($data['marathon']) ) ? 1 : 0 );

                        $data['problem'] = $this->security->xss_clean($this->input->post('problemJudge'));
                        $data['problemFlag'] = ( ( empty($data['problem']) ) ? 1 : 0 );


                        if(! ($data['problemFlag'] || $data['marathonFlag']))
                        {
                            //GET MARATHON RECEIVED
                            $data['received'] = $this->process->get_marathonReceived($data);

                            //LOAD VIEW
                            $this->layout->view('Jury/JudgeList', $data);
                        }
                    }
                    else
                    {
                        $this->ListMarathon();
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

    //VIEW MARATHON LIST
    public function JudgeProblem()
    { 
        
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Judge Problem');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/switchery/switchery.css','header',$prepend_base_url = TRUE);
                //ADD JS FOOTER
                if($this->session->userdata('site_lang') == 'Spanish')
                    $this->layout->add_includes('js', 'assets/js/plugins/validate/Spanish_messages.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/validate/jquery.validate.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/preetyTextDiff/jquery.pretty-text-diff.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/diff_match_patch/javascript/diff_match_patch.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/switchery/switchery.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/autogrow/autogrow.js', 'footer',$prepend_base_url = TRUE);

                //CONF MESSAGE
                $this->layout->add_includes('js', 'assets/js/conf/jury/JudgeProblem.js', 'footer',$prepend_base_url = TRUE);

                if( isset($_POST['marathon']) && isset($_POST['received'])) 
                {
                    $data['marathon'] = $this->security->xss_clean($this->input->post('marathon'));
                    $data['received'] = $this->security->xss_clean($this->input->post('received'));

                    $data['marathonFlag'] = ( ( empty($data['marathon']) ) ? 1 : 0 );
                    $data['receivedFlag'] = ( ( empty($data['received']) ) ? 1 : 0 );


                    if(! $data['marathonFlag'] || $data['receivedFlag'] )
                    {

                        //GET PROBLEMS LIST
                        if($this->process->ReJudgeSubmission($data))
                        {
                            
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successReJudgeProblem.js', 'footer',$prepend_base_url = TRUE);

                        }
                        else
                        {
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                        }

                        $data['id'] = $data['received'];

                        //GET MARATHON PROBLEM - TEAM FOR JUDGE
                        $data['JudgeProblem'] = $this->process->get_JudgeProblem($data);

                        //LOAD VIEW
                        $this->layout->view('Jury/JudgeProblem', $data);

                    }
                    
                    
                }
                else
                {
                    if(isset($_POST['id']))
                    {
                        $data['id'] = $this->security->xss_clean($this->input->post('id'));
                        $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );

                        if(! ($data['idFlag'] ))
                        {

                            //GET MARATHON PROBLEM - TEAM FOR JUDGE
                            $data['JudgeProblem'] = $this->process->get_JudgeProblem($data);

                            //LOAD VIEW
                            $this->layout->view('Jury/JudgeProblem', $data);
                        }
                        else
                        {
                            $this->ListMarathon();
                        }

                    }
                    else
                    {
                        $this->ListMarathon();
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

    
    //VIEW MARATHON LIST
    public function GetCaseOutput()
    {
        if($this->process->CheckAdminUser())
        {
            if(!$this->process->checkLock())
            { 
                $data['problem'] = $this->security->sanitize_filename($this->input->post('problem'));
                $data['problemFlag'] = ( ( empty($data['problem']) ) ? 1 : 0 );

                $data['casename'] = $this->security->sanitize_filename($this->input->post('casename'));
                $data['casenameFlag'] = ( ( empty($data['casename']) ) ? 1 : 0 );

                if(! ($data['problemFlag'] || $data['casenameFlag']))
                {
                    $path='./uploads/problem/testcases/'.$data['problem'].'/output/'.$data['casename'];
                    echo $this->load->file($path, true);

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

    //VIEW MARATHON LIST
    public function GetTeamOutput()
    { 
        if($this->process->CheckAdminUser())
        { 
            if(!$this->process->checkLock())
            {
                $data['marathon'] = $this->security->sanitize_filename($this->input->post('marathon'));
                $data['marathonFlag'] = ( ( empty($data['marathon']) ) ? 1 : 0 );

                $data['team'] = $this->security->sanitize_filename($this->input->post('team'));
                $data['teamFlag'] = ( ( empty($data['team']) ) ? 1 : 0 );

                $data['problem'] = $this->security->sanitize_filename($this->input->post('problem'));
                $data['problemFlag'] = ( ( empty($data['problem']) ) ? 1 : 0 );

                $data['casename'] = $this->security->sanitize_filename($this->input->post('casename'));
                $data['casenameFlag'] = ( ( empty($data['casename']) ) ? 1 : 0 );

                if(! ($data['marathonFlag'] || $data['teamFlag'] || $data['problemFlag'] || $data['casenameFlag']))
                {
                    $path='./uploads/output/marathon/'.$data['marathon'].'/'.$data['team'].'/'.$data['problem'].'/'.$data['casename'];
                    echo $this->load->file($path, true);
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

    //SET RECEIVED VERIFIED
    public function SetVerified()
    {
        if($this->process->CheckAdminUser())
        {  
            if(!$this->process->checkLock())
            {
                $data['marathon'] = $this->security->xss_clean($this->input->post('marathon'));
                $data['marathonFlag'] = ( ( empty($data['marathon']) ) ? 1 : 0 );

                $data['received'] = $this->security->xss_clean($this->input->post('received'));
                $data['receivedFlag'] = ( ( empty($data['received']) ) ? 1 : 0 );

                $data['problem'] = $this->security->xss_clean($this->input->post('problem'));
                $data['problemFlag'] = ( ( empty($data['problem']) ) ? 1 : 0 );

                $data['verified'] = $this->security->xss_clean($this->input->post('verified'));


                if(! ($data['marathonFlag'] || $data['receivedFlag'] || $data['problemFlag'] ))
                {
                    //SET - UNSET VERIFIED
                    echo $this->process->set_Verified($data);

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


}
