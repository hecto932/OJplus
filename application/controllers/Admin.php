<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller 
{
	//CONSTRUCT
	public function __construct() 
	{
		parent::__construct();
	}


    //SET USER ROLE
    public function Role()
    {
        if($this->process->CheckRole(0))
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Update Role');

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
                $this->layout->add_includes('js', 'assets/js/conf/admin/role.js', 'footer',$prepend_base_url = TRUE);

                if( isset($_POST['id']) && isset($_POST['role'])) 
                {
                    $data['id'] = $this->security->xss_clean(trim($this->input->post('id')));
                    $data['role'] = $this->security->xss_clean(trim($this->input->post('role')));

                    $data['idFlag'] = ( ( empty($data['id']) ) ? 1 : 0 );
                    $data['roleFlag'] = ( ( empty($data['role']) ) ? 1 : 0 );

                    if(! $data['idFlag'] || $data['roleFlag'] )
                    {           
                        echo $this->process->set_role($data);
                    }


                }

                //GET PROBLEMS LIST
                $data['users'] = $this->process->get_users();

                //GET ROLE LIST
                $data['role'] = $this->process->get_roles();

                //LOAD VIEW
                $this->layout->view('admin/Role',$data);
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

    
    //GET SERVER STATUS
    public function ServerStatus()
    {
        if($this->process->CheckRole(0))
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'Server Status');

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
                $this->layout->add_includes('js', 'assets/js/conf/admin/ServerStatus.js', 'footer',$prepend_base_url = TRUE);

                
                //LOAD VIEW
                $this->layout->view('admin/ServerStatus');
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

	//VIEW ADMIN ADD TEST CASES 
    public function AddCases()
    {
        if($this->process->CheckRole(0) || $this->process->CheckRole(3))
        {
            if(!$this->process->checkLock())
            {
                //SET TITLE
                $this->layout->set_title('Judge' . $this->layout->title_separator . 'File Upload');

                //ADD CSS AND JS HEADER
                $this->layout->add_includes('css', 'assets/css/plugins/dropzone/basic.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/dropzone/dropzone.css','header',$prepend_base_url = TRUE);
                $this->layout->add_includes('css', 'assets/css/plugins/chosen/chosen.css','header',$prepend_base_url = TRUE);

                //ADD JS FOOTER
                $this->layout->add_includes('js', 'assets/js/plugins/dropzone/dropzone.js', 'footer',$prepend_base_url = TRUE);
                $this->layout->add_includes('js', 'assets/js/plugins/chosen/chosen.jquery.js', 'footer',$prepend_base_url = TRUE);
                
                //CONF 
                $this->layout->add_includes('js', 'assets/js/conf/admin/TestCases.js', 'footer',$prepend_base_url = TRUE);


                if( isset($_POST['problemid']) && isset($_POST['typeid'])) 
                {
                    $data['problemid'] = $this->security->xss_clean(trim($this->input->post('problemid')));
                    $data['typeid'] = $this->security->xss_clean(trim($this->input->post('typeid')));
                    $data['inputid'] = $this->security->xss_clean(trim($this->input->post('inputid')));

                    $data['problemidFlag'] = ( ( empty($data['problemid']) ) ? 1 : 0 );
                    $data['typeidFlag'] = ( ( empty($data['typeid']) ) ? 1 : 0 );
                    $data['inputidFlag'] = ( ( empty($data['inputid']) ) ? 1 : 0 );

                    
                    if(! $data['problemidFlag'] || $data['typeidFlag'])
                    {
                        if (!empty($_FILES)) 
                        {

                            $tempFile = $_FILES['file']['tmp_name'];

                            if ($this->security->xss_clean($tempFile, TRUE))
                            {
                                $data['md5'] = md5_file($_FILES['file']['tmp_name']);
                                $fileName = $_FILES['file']['name'];
                                $data['name'] = $fileName;
                                $exist = false;

                                $dir='/tmp/';

                                if($data['typeid'] == 0)
                                {
                                    $dir='/uploads/problem/testcases/'.$data['problemid'].'/input/';
                                }
                                else
                                {
                                   echo 'InputCase Requiered';

                                    $dir='/uploads/problem/testcases/'.$data['problemid'].'/output/';
                                    $exist = $this->process->ExistTestCases($data);         
                                }

                                
                                if(! $exist)
                                {
                                	if($this->process->set_TestCases($data))
                                	{
        	                        	mkdir(getcwd() . $dir, 0700, true);

        		                        $targetPath = getcwd() . $dir;
        		                        
        		                        $targetFile = $targetPath . $fileName ;
        		                        
        		                        move_uploaded_file($tempFile, $targetFile);

                                	}

                                }
                                
                            }

                        }
                    }
                    
                }


                //GET PROBLEMS LIST
                $data['problems'] = $this->process->get_problems();

                //LOAD VIEW
                $this->layout->view('admin/AddCases',$data);
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
	

	//VIEW DELETED TEST CASES
	public function AdminCases()
	{
        if($this->process->CheckRole(0) || $this->process->CheckRole(3))
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

                

                if( isset($_POST['problem'])) 
                {
                    $data['problem'] = $this->security->xss_clean(trim($this->input->post('problem')));

                    $data['problemFlag'] = ( ( empty($data['problem']) ) ? 1 : 0 );

                    if( isset($_POST['case'])) 
               		{
               			$data['case'] = $this->security->xss_clean(trim($this->input->post('case')));

                    	$data['caseFlag'] = ( ( empty($data['case']) ) ? 1 : 0 );

                    	if($this->process->DeletedCases($data))
                    	{
                    		$this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/successDeletedCase.js', 'footer',$prepend_base_url = TRUE);
                    	}
                    	else
                    	{
                    		$this->layout->add_includes('js', 'assets/js/conf/message/'.$this->session->userdata('site_lang').'/error.js', 'footer',$prepend_base_url = TRUE);
                    	}
               		}

                    if(! $data['problemFlag'])
                    {

                		//GET PROBLEMS LIST
                		$data['Cases'] = $this->process->get_Cases($data);

               			//LOAD VIEW
                		$this->layout->view('admin/DeletedCases', $data);

                    }
                }
                else
                {
                	//GET PROBLEMS LIST
                	$data['problems'] = $this->process->get_problems();

               		//LOAD VIEW
                	$this->layout->view('admin/AdminCases', $data);
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

