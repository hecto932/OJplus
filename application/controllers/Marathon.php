<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marathon extends MY_Controller 
{
	//CONSTRUCT
	public function __construct() 
	{
		parent::__construct();
	}
	
    //CREATE MARATHON
    public function NewMarathon()
    {
        if($this->process->CheckRole(0) || $this->process->CheckRole(3))
        { 
            if(!$this->process->checkLock())
            {

                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Create Repository');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/iCheck/custom.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/switchery/switchery.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/steps/jquery.steps.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/datapicker/bootstrap-datetimepicker.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/datapicker/moment.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/staps/jquery.steps.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/switchery/switchery.js', 'footer',$prepend_base_url = TRUE);
                if($this->session->userdata('site_lang') == 'Spanish')
                    $this->layout->add_includes('js', 'assets/js/plugins/validate/Spanish_messages.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/validate/jquery.validate.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/iCheck/icheck.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/datapicker/bootstrap-datetimepicker.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF
                $this->layout->add_includes('js', 'assets/js/conf/marathon/NewMarathon.js', 'footer',$prepend_base_url = TRUE); 

                if( isset($_POST['name']) && isset($_POST['description']) && isset($_POST['date']) && isset($_POST['duration']) && isset($_POST['penalty']) && 
                    isset($_POST['timeshowanswer']) && isset($_POST['autostart']) && isset($_POST['repository']) && isset($_POST['teams']) && isset($_POST['jury'])) 
                {
                    $data['name']        = $this->security->xss_clean($this->input->post('name'));
                    $data['description'] = $this->security->xss_clean($this->input->post('description'));
                    $data['date']        = $this->security->xss_clean($this->input->post('date'));
                    $data['duration']    = $this->security->xss_clean($this->input->post('duration'));
                    $data['startfreeze'] = $this->security->xss_clean($this->input->post('startfreeze'));
                    $data['endfreeze']   = $this->security->xss_clean($this->input->post('endfreeze'));
                    $data['penalty']     = $this->security->xss_clean($this->input->post('penalty'));
                    $data['timeshowanswer'] = $this->security->xss_clean($this->input->post('timeshowanswer'));
                    $data['autostart']   = $this->security->xss_clean($this->input->post('autostart'));
                    $data['repository']  = $this->security->xss_clean($this->input->post('repository'));
                    $data['teams']       = $this->security->xss_clean($this->input->post('teams'));
                    $data['jury']        = $this->security->xss_clean($this->input->post('jury'));


                    $data['nameFlag'] = ( ( empty($data['name']) ) ? 1 : 0 );
                    $data['descriptionFlag'] = ( ( empty($data['description']) ) ? 1 : 0 );
                    $data['dateFlag'] = ( ( empty($data['date']) ) ? 1 : 0 );
                    $data['durationFlag'] = ( ( empty($data['duration']) ) ? 1 : 0 );
                    $data['penaltyFlag'] = ( ( empty($data['penalty']) ) ? 1 : 0 );
                    $data['startfreezeFlag'] = ( ( empty($data['startfreeze']) ) ? 1 : 0 );
                    $data['endfreezeFlag'] = ( ( empty($data['endfreeze']) ) ? 1 : 0 );
                    $data['timeshowanswerFlag'] = ( ( empty($data['timeshowanswer']) ) ? 1 : 0 );
                    $data['autostartFlag'] = ( ( empty($data['autostart']) ) ? 1 : 0 );
                    $data['repositoryFlag'] = ( ( empty($data['repository']) ) ? 1 : 0 );
                    $data['teamsFlag'] = ( ( empty($data['teams']) ) ? 1 : 0 );
                    $data['juryFlag'] = ( ( empty($data['jury']) ) ? 1 : 0 );



                    if(! $data['nameFlag'] || $data['descriptionFlag'] || $data['dateFlag'] || $data['durationFlag'] ||  $data['startfreezeFlag'] || $data['endfreezeFlag']||
                         $data['penaltyFlag'] ||  $data['timeshowanswerFlag'] || $data['autostartFlag'] || $data['repositoryFlag'] || $data['teamsFlag'] || $data['juryFlag'])
                    {           
                        $NewMarathon = $this->process->NewMarathon($data);

                        if($NewMarathon)
                        {
                            //CONF MESSAGE
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successNewMarathon.js', 'footer',$prepend_base_url = TRUE);
                        }
                        else
                        {
                            //CONF MESSAGE
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                        }
                    }       
                }

                //GET PROBLEMS LIST
                $data['repository'] = $this->process->get_RepoList();
                
                //GET TEAMS
                $data['teams'] = $this->process->get_team();

                //GET JURY
                $data['jury'] = $this->process->get_jury();

                //LOAD VIEW
                $this->layout->view('marathon/NewMarathon',$data);
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
    public function ListMarathon()
    {   
        if($this->process->CheckRole(0) || $this->process->CheckRole(3))
        { 
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Marathon List');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/steps/jquery.steps.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/staps/jquery.steps.min.js', 'footer',$prepend_base_url = TRUE);
                if($this->session->userdata('site_lang') == 'Spanish')
                    $this->layout->add_includes('js', 'assets/js/plugins/validate/Spanish_messages.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/validate/jquery.validate.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF MESSAGE
                $this->layout->add_includes('js', 'assets/js/conf/marathon/ListMarathon.js', 'footer',$prepend_base_url = TRUE);

                //GET MARATHON LIST
                $data['marathon'] = $this->process->get_marathon();

                //LOAD VIEW
                $this->layout->view('marathon/ListMarathon', $data);
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


    //VIEW MARATHON DELETED
    public function DeletedMarathon()
    {   
        if($this->process->CheckRole(0) || $this->process->CheckRole(3))
        { 
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Language List');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/steps/jquery.steps.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/staps/jquery.steps.min.js', 'footer',$prepend_base_url = TRUE);
                if($this->session->userdata('site_lang') == 'Spanish')
                    $this->layout->add_includes('js', 'assets/js/plugins/validate/Spanish_messages.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/validate/jquery.validate.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF MESSAGE
                $this->layout->add_includes('js', 'assets/js/conf/marathon/DeletedMarathon.js', 'footer',$prepend_base_url = TRUE);

                if( isset($_POST['deleted']) ) 
                {
                    $data['id'] = $this->security->xss_clean($this->input->post('deleted'));

                    $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );


                    if(! $data['idFlag'])
                    {           
                        $DeletedMarathon = $this->process->DeletedMarathon($data);

                        if($DeletedMarathon)
                        {
                            //CONF MESSAGE
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successDeletedMarathon.js', 'footer',$prepend_base_url = TRUE);
                        }
                        else
                        {
                            //CONF MESSAGE
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                        }
                    }       
                }

                //GET MARATHON LIST
                $data['marathon'] = $this->process->get_marathon();

                //LOAD VIEW
                $this->layout->view('marathon/DeletedMarathon', $data);
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

    
    //VIEW EDIT MARATHON
    public function EditMarathon()
    {
        if($this->process->CheckRole(0) || $this->process->CheckRole(3))
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Marathon Edit');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/switchery/switchery.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/iCheck/custom.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/steps/jquery.steps.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/datapicker/bootstrap-datetimepicker.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/datapicker/moment.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/switchery/switchery.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/staps/jquery.steps.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/iCheck/icheck.min.js', 'footer',$prepend_base_url = TRUE);
                if($this->session->userdata('site_lang') == 'Spanish')
                    $this->layout->add_includes('js', 'assets/js/plugins/validate/Spanish_messages.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/validate/jquery.validate.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/datapicker/bootstrap-datetimepicker.min.js', 'footer',$prepend_base_url = TRUE);


                if( isset($_POST['edit'])) 
                {
                    $data['id'] = $this->input->post('edit');

                    $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );

                    if(! $data['idFlag'] )
                    {
                        //CONF
                        $this->layout->add_includes('js', 'assets/js/conf/marathon/NewMarathon.js', 'footer',$prepend_base_url = TRUE);

                        //GET REPO CONFIG
                        $data['config'] = $this->process->get_MarathonConfig($data);
                        
                        //GET PROBLEMS LIST
                        $data['repository'] = $this->process->get_RepoList();
                        
                        //GET TEAMS
                        $data['teams'] = $this->process->get_team();

                        //GET JURY
                        $data['jury'] = $this->process->get_jury();


                        //GET OLD TEAMS LIST
                        $data['Oldteams'] = $this->process->get_OldMarathonTeams($data);

                        //GET OLD LANGUAGE LIST
                        $data['Oldjury'] = $this->process->get_OldMarathonJury($data);

                        //LOAD VIEW
                        $this->layout->view('marathon/UpdateMarathon',$data); 
                    }
                }
                else
                {

                    if( isset($_POST['name']) && isset($_POST['description']) && isset($_POST['date']) && isset($_POST['duration']) && isset($_POST['penalty']) && isset($_POST['startfreeze']) && isset($_POST['endfreeze']) && isset($_POST['timeshowanswer']) && 
                    isset($_POST['repository']) && isset($_POST['teams']) && isset($_POST['jury'])) 
                    {
                        $data['id']   = $this->security->xss_clean($this->input->post('id'));
                        $data['name'] = $this->security->xss_clean($this->input->post('name'));
                        $data['description'] = $this->security->xss_clean($this->input->post('description'));
                        $data['date']     = $this->security->xss_clean($this->input->post('date'));
                        $data['duration'] = $this->security->xss_clean($this->input->post('duration'));
                        $data['penalty']  = $this->security->xss_clean($this->input->post('penalty'));
                        $data['startfreeze']    = $this->security->xss_clean($this->input->post('startfreeze'));
                        $data['endfreeze']      = $this->security->xss_clean($this->input->post('endfreeze'));
                        $data['timeshowanswer'] = $this->security->xss_clean($this->input->post('timeshowanswer'));
                        $data['repository']     = $this->security->xss_clean($this->input->post('repository'));
                        $data['teams']          = $this->security->xss_clean($this->input->post('teams'));
                        $data['jury'] = $this->security->xss_clean($this->input->post('jury'));

                        $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );
                        $data['nameFlag'] = ( ( empty($data['name']) ) ? 1 : 0 );
                        $data['descriptionFlag'] = ( ( empty($data['description']) ) ? 1 : 0 );
                        $data['dateFlag'] = ( ( empty($data['date']) ) ? 1 : 0 );
                        $data['durationFlag'] = ( ( empty($data['duration']) ) ? 1 : 0 );
                        $data['penaltyFlag'] = ( ( empty($data['penalty']) ) ? 1 : 0 );
                        $data['startfreezeFlag'] = ( ( empty($data['startfreeze']) ) ? 1 : 0 );
                        $data['endfreezeFlag'] = ( ( empty($data['endfreeze']) ) ? 1 : 0 );
                        $data['timeshowanswerFlag'] = ( ( empty($data['timeshowanswer']) ) ? 1 : 0 );
                        $data['repositoryFlag'] = ( ( empty($data['repository']) ) ? 1 : 0 );
                        $data['teamsFlag'] = ( ( empty($data['teams']) ) ? 1 : 0 );
                        $data['juryFlag'] = ( ( empty($data['jury']) ) ? 1 : 0 );



                        if(! $data['idFlag'] || $data['nameFlag'] || $data['descriptionFlag'] || $data['dateFlag'] || $data['durationFlag'] ||  $data['startfreezeFlag'] || $data['endfreezeFlag']||
                             $data['penaltyFlag'] ||  $data['timeshowanswerFlag'] || $data['repositoryFlag'] || $data['teamsFlag'] || $data['juryFlag'])
                        {           
                            $EditMarathon = $this->process->EditMarathon($data);

                            if($EditMarathon)
                            {
                                //CONF MESSAGE
                                $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successEditMarathon.js', 'footer',$prepend_base_url = TRUE);
                            }
                            else
                            {
                                //CONF MESSAGE
                                $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                            }
                        }
                        else
                        {
                            //CONF MESSAGE
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                        }
                        
              
                    }

                    //CONF
                    $this->layout->add_includes('js', 'assets/js/conf/marathon/EditMarathon.js', 'footer',$prepend_base_url = TRUE);

                    //GET PROBLEMS LIST
                    $data['marathon'] = $this->process->get_marathon();

                    //LOAD VIEW
                    $this->layout->view('marathon/EditMarathon', $data);
                    
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

    //VIEW LANGUAGE NEW
    public function LangNew()
    {
        if($this->process->CheckRole(0) || $this->process->CheckRole(3))
        {   
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'New Language');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/steps/jquery.steps.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/staps/jquery.steps.min.js', 'footer',$prepend_base_url = TRUE);
                if($this->session->userdata('site_lang') == 'Spanish')
                    $this->layout->add_includes('js', 'assets/js/plugins/validate/Spanish_messages.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/validate/jquery.validate.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/toastr/toastr.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF 
                $this->layout->add_includes('js', 'assets/js/conf/marathon/LangNew.js', 'footer',$prepend_base_url = TRUE);


                if( isset($_POST['name']) && isset($_POST['compile']) && isset($_POST['run'])  && isset($_POST['flags'])   && isset($_POST['file'])) 
                {
                    $data['name']    = $this->security->xss_clean($this->input->post('name'));
                    $data['compile'] = $this->security->xss_clean($this->input->post('compile'));
                    $data['run']   = $this->security->xss_clean($this->input->post('run'));
                    $data['flags'] = $this->security->xss_clean($this->input->post('flags'));
                    $data['file']  = $this->security->xss_clean($this->input->post('file'));

                    $data['nameFlag'] = ( ( empty($data['name']) ) ? 1 : 0 );
                    $data['compileFlag'] = ( ( empty($data['compile']) ) ? 1 : 0 );
                    $data['runFlag'] = ( ( empty($data['run']) ) ? 1 : 0 );
                    $data['flagsFlag'] = ( ( empty($data['flags']) ) ? 1 : 0 );
                    $data['fileFlag'] = ( ( empty($data['file']) ) ? 1 : 0 );


                    if(! $data['nameFlag'] || $data['compileFlag'] || $data['runFlag'] || $data['flagsFlag'] || $data['fileFlag'])
                    {           
                        $LangNew = $this->process->LangNew($data);

                        if($LangNew)
                        {
                            //CONF MESSAGE
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successfulLangNew.js', 'footer',$prepend_base_url = TRUE);
                        }
                        else
                        {
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                        }
                    }       

                }

                //LOAD VIEW
                $this->layout->view('marathon/LangNew');
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


    //VIEW LANGUAGE LIST
    public function LangList()
    {   
        if($this->process->CheckRole(0) || $this->process->CheckRole(3))
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Language List');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/steps/jquery.steps.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/staps/jquery.steps.min.js', 'footer',$prepend_base_url = TRUE);
                if($this->session->userdata('site_lang') == 'Spanish')
                    $this->layout->add_includes('js', 'assets/js/plugins/validate/Spanish_messages.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/validate/jquery.validate.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF
                $this->layout->add_includes('js', 'assets/js/conf/marathon/LangDeleted.js', 'footer',$prepend_base_url = TRUE);

                //GET LIST
                $data['language'] = $this->process->get_language();

                //LOAD VIEW
                $this->layout->view('marathon/LangList', $data);
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

    //VIEW LANGUAGE DELETED
    public function LangDeleted()
    {   
        if($this->process->CheckRole(0) || $this->process->CheckRole(3))
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Language List');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/steps/jquery.steps.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.bootstrap.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.responsive.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dataTables/dataTables.tableTools.min.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/staps/jquery.steps.min.js', 'footer',$prepend_base_url = TRUE);
                if($this->session->userdata('site_lang') == 'Spanish')
                    $this->layout->add_includes('js', 'assets/js/plugins/validate/Spanish_messages.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/validate/jquery.validate.min.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/jquery.dataTables.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.bootstrap.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.responsive.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/dataTables/dataTables.tableTools.min.js', 'footer',$prepend_base_url = TRUE);

                //CONF MESSAGE
                $this->layout->add_includes('js', 'assets/js/conf/marathon/LangDeleted.js', 'footer',$prepend_base_url = TRUE);

                if( isset($_POST['deleted']) ) 
                {
                    $data['id'] = $this->security->xss_clean($this->input->post('deleted'));

                    $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );


                    if(! $data['idFlag'])
                    {           
                        $LangDeleted = $this->process->LangDeleted($data);
 
                        if($LangDeleted)
                        {
                            //CONF MESSAGE
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successLangDeleted.js', 'footer',$prepend_base_url = TRUE);
                        }
                        else
                        {
                            //CONF MESSAGE
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                        }
                    }       
                }

                //GET PROBLEMS LIST
                $data['language'] = $this->process->get_language();

                //LOAD VIEW
                $this->layout->view('marathon/LangDeleted', $data);
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
    public function RepoNew()
    {
        if($this->process->CheckRole(0) || $this->process->CheckRole(3))
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
                $this->layout->add_includes('js', 'assets/js/conf/marathon/RepoNew.js', 'footer',$prepend_base_url = TRUE); 

                if( isset($_POST['name']) && isset($_POST['description']) && isset($_POST['maxruntime']) && isset($_POST['maxram']) && isset($_POST['maxoutput']) && 
                    isset($_POST['problems']) && isset($_POST['languages'])) 
                {
                    $data['name'] = $this->security->xss_clean($this->input->post('name'));
                    $data['description'] = $this->security->xss_clean($this->input->post('description'));
                    $data['maxruntime'] = $this->security->xss_clean($this->input->post('maxruntime'));
                    $data['maxram'] = $this->security->xss_clean($this->input->post('maxram'));
                    $data['maxoutput'] = $this->security->xss_clean($this->input->post('maxoutput'));
                    $data['problems'] = $this->security->xss_clean($this->input->post('problems'));
                    $data['languages'] = $this->security->xss_clean($this->input->post('languages'));


                    $data['nameFlag'] = ( ( empty($data['name']) ) ? 1 : 0 );
                    $data['descriptionFlag'] = ( ( empty($data['description']) ) ? 1 : 0 );
                    $data['maxruntimeFlag'] = ( ( empty($data['maxruntime']) ) ? 1 : 0 );
                    $data['maxramFlag'] = ( ( empty($data['maxram']) ) ? 1 : 0 );
                    $data['maxoutputFlag'] = ( ( empty($data['maxoutput']) ) ? 1 : 0 );
                    $data['problemsFlag'] = ( ( empty($data['problems']) ) ? 1 : 0 );
                    $data['languagesFlag'] = ( ( empty($data['languages']) ) ? 1 : 0 );



                    if(! $data['nameFlag'] || $data['descriptionFlag'] || $data['maxruntimeFlag'] || $data['maxramFlag'] || $data['maxoutputFlag'] || $data['problemsFlag'] || $data['languagesFlag'] )
                    {           
                        $RepoNew = $this->process->RepoNew($data);

                        if($RepoNew)
                        {
                            //CONF MESSAGE
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successRepoNew.js', 'footer',$prepend_base_url = TRUE);
                        }
                        else
                        {
                            //CONF MESSAGE
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                        }
                    }       
                }

                //GET PROBLEMS LIST
                $data['problems'] = $this->process->get_problems();

                //GET LANGUAGE LIST
                $data['languages'] = $this->process->get_languages();

                //LOAD VIEW
                $this->layout->view('marathon/RepoNew',$data);
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

    //VIEW LIST REPOSITORY
    public function RepoList()
    {
        if($this->process->CheckRole(0) || $this->process->CheckRole(3))
        {
            if(!$this->process->checkLock())
            {

                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Repository List');

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
                $this->layout->add_includes('js', 'assets/js/conf/marathon/RepoList.js', 'footer',$prepend_base_url = TRUE);


                if( isset($_POST['open'])) 
                {
                    $data['id'] = $this->security->xss_clean($this->input->post('open'));


                    $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );

                    if(! $data['idFlag'] )
                    { 

                        //GET PROBLEMS LIST
                        $data['problems'] = $this->process->get_RepoProblems($data);

                        //LOAD VIEW
                        $this->layout->view('marathon/ProblemList', $data);
                    }
                }
                else
                {
                    //GET PROBLEMS LIST
                    $data['repository'] = $this->process->get_RepoList();

                    //LOAD VIEW
                    $this->layout->view('marathon/RepoList', $data);

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
    public function RepoDeleted()
    {
        if($this->process->CheckRole(0) || $this->process->CheckRole(3))
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Repository Deleted');

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
                $this->layout->add_includes('js', 'assets/js/conf/marathon/RepoList.js', 'footer',$prepend_base_url = TRUE);


                if( isset($_POST['deleted'])) 
                {
                    $data['id'] = $this->security->xss_clean($this->input->post('deleted'));


                    $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );

                    if(! $data['idFlag'] )
                    {
                        $RepoDeleted = $this->process->RepoDeleted($data);

                        if($RepoDeleted)
                        {
                            //CONF MESSAGE
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successRepoDeleted.js', 'footer',$prepend_base_url = TRUE);
                        }
                        else
                        {
                            //CONF MESSAGE
                            $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                        }   
                    }
                }

                //GET PROBLEMS LIST
                $data['repository'] = $this->process->get_RepoList();

                //LOAD VIEW
                $this->layout->view('marathon/RepoDeleted', $data);
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
    public function RepoEdit()
    {
        if($this->process->CheckRole(0) || $this->process->CheckRole(3))
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Repository Deleted');

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


                if( isset($_POST['edit'])) 
                {
                    $data['id'] = $this->security->xss_clean($this->input->post('edit'));

                    $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );

                    if(! $data['idFlag'] )
                    {
                        //CONF
                        $this->layout->add_includes('js', 'assets/js/conf/marathon/RepoUpdate.js', 'footer',$prepend_base_url = TRUE);

                        //GET REPO CONFIG
                        $data['config'] = $this->process->get_RepoConfig($data);
                        
                        //GET PROBLEMS LIST
                        $data['problems'] = $this->process->get_problems();

                        //GET LANGUAGE LIST
                        $data['languages'] = $this->process->get_languages();

                        //GET OLD PROBLEMS LIST
                        $data['Oldproblems'] = $this->process->get_OldRepoProblems($data);

                        //GET OLD LANGUAGE LIST
                        $data['Oldlanguages'] = $this->process->get_OldRepoLanguages($data);

                        //LOAD VIEW
                        $this->layout->view('marathon/RepoUpdate',$data); 
                    }
                }
                else
                {

                    if( isset($_POST['id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['maxruntime']) && 
                        isset($_POST['maxram']) && isset($_POST['maxoutput']) && isset($_POST['problems']) && isset($_POST['languages'])) 
                    {
                        $data['id']   = $this->security->xss_clean($this->input->post('id'));
                        $data['name'] = $this->security->xss_clean($this->input->post('name'));
                        $data['description'] = $this->security->xss_clean($this->input->post('description'));
                        $data['maxruntime']  = $this->security->xss_clean($this->input->post('maxruntime'));
                        $data['maxram']    = $this->security->xss_clean($this->input->post('maxram'));
                        $data['maxoutput'] = $this->security->xss_clean($this->input->post('maxoutput'));
                        $data['problems']  = $this->security->xss_clean($this->input->post('problems'));
                        $data['languages'] = $this->security->xss_clean($this->input->post('languages'));

                        $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );
                        $data['nameFlag'] = ( ( empty($data['name']) ) ? 1 : 0 );
                        $data['descriptionFlag'] = ( ( empty($data['description']) ) ? 1 : 0 );
                        $data['maxruntimeFlag'] = ( ( empty($data['maxruntime']) ) ? 1 : 0 );
                        $data['maxramFlag'] = ( ( empty($data['maxram']) ) ? 1 : 0 );
                        $data['maxoutputFlag'] = ( ( empty($data['maxoutput']) ) ? 1 : 0 );
                        $data['problemsFlag'] = ( ( empty($data['problems']) ) ? 1 : 0 );
                        $data['languagesFlag'] = ( ( empty($data['languages']) ) ? 1 : 0 );



                        if(! $data['idFlag'] || $data['nameFlag'] || $data['descriptionFlag'] || $data['maxruntimeFlag'] || 
                             $data['maxramFlag'] || $data['maxoutputFlag'] || $data['problemsFlag'] || $data['languagesFlag'] )
                        {           
                            $RepoNew = $this->process->RepoUpdate($data);

                            if($RepoNew)
                            {
                                //CONF MESSAGE
                                $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successRepoUpdate.js', 'footer',$prepend_base_url = TRUE);
                            }
                            else
                            {
                                //CONF MESSAGE
                                $this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                            }

                            //CONF
                            $this->layout->add_includes('js', 'assets/js/conf/marathon/RepoList.js', 'footer',$prepend_base_url = TRUE);

                            //GET PROBLEMS LIST
                            $data['repository'] = $this->process->get_RepoList();

                            //LOAD VIEW
                            $this->layout->view('marathon/RepoEdit', $data);
                        }       
                    }
                    else
                    {
                        //CONF
                        $this->layout->add_includes('js', 'assets/js/conf/marathon/RepoList.js', 'footer',$prepend_base_url = TRUE);

                        //GET PROBLEMS LIST
                        $data['repository'] = $this->process->get_RepoList();

                        //LOAD VIEW
                        $this->layout->view('marathon/RepoEdit', $data);
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

    


    


    
    
    

		
}
