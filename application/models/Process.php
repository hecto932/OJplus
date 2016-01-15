<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Process extends CI_Model 
    {

    	public function checkLoggedIn()
    	{
    		return $this->session->userdata('loggedIn');
    	}

    	public function checkLock()
    	{
    		return $this->session->userdata('lock');
    	}

        public function getRole()
        {
            return $this->session->userdata('role_id');
        }

        public function CheckUser()
        {
            return ($this->checkLoggedIn() && $this->checkLock());
        }

        public function CheckRole($role)
        {
            if($this->checkLoggedIn())
                return ($role == $this->getRole());
            else
                return false;
        }

        public function CheckAdminUser()
        {
            if($this->checkLoggedIn())
            {
                $role = $this->getRole();
                return ($role == 0 || $role == 2 || $role == 3);
            }
            else
                return false;
        }

        public function isAdminTeam() 
        {
            $data = array(
                            'id'   => $this->session->userdata('teams_id'),
                            'users_id'  => $this->session->userdata('users_id')
                            );

            $query = $this->db->get_where('teams', $data);

            
            return ($query->num_rows() == 1);
        }

        public function isInReceived($fields)
        {
            $data = array(
                            'users_id'    => $this->session->userdata('users_id'),
                            'filename'    => $fields['name'],
                            'problems_id' => $fields['id']
                        );

            $query = $this->db->get_where('received', $data);

            
            return ($query->num_rows() != 0);
        }

        public function isInMarathonReceived($fields)
        {
            $data = array(
                            'teams_id'    => $this->session->userdata('teams_id'),
                            'filename'    => $fields['name'],
                            'problems_id' => $fields['problem'],
                            'marathon_id' => $fields['marathon']
                        );

            $query = $this->db->get_where('marathonreceived', $data);

            
            return ($query->num_rows() != 0);
        }

        public function isInATeam()
        {       
            return ($this->session->userdata('teams_id') != NULL);
        }

        public function isInATeamId($fields)
        {
            $this->db->where('id',$fields['id']);
            $this->db->where('teams_id !=',NULL);
            return $this->db->count_all_results('users') > 0;
        }

        public function isATeamAdmin()
        {
            if ($this->isInATeam())
            {
                $data = array(
                            'id'        => $this->session->userdata('teams_id'),
                            'users_id'  => $this->session->userdata('users_id')
                            );

                $query = $this->db->get_where('teams', $data);

                
                return ($query->num_rows() > 0); 
            }
            else
                return FALSE;
        }

        

        public function getLoginError()
        {
            $data = array(
                            'users_id'  => $this->session->userdata('users_id')
                            );

            $this->db->select('error');
            $this->db->from('logsession');
            $this->db->where($data);
            $query =  $this->db->get();

            $row = $query->row_array();

            return $row['error'];
        }

        public function getTeamLogo()
        {
            $data = array(
                            'users_id'  => $this->session->userdata('users_id')
                            );

            $this->db->select('logo');
            $this->db->from('teams');
            $this->db->where($data);
            $query =  $this->db->get();

            $row = $query->row_array();

            return $row['logo'];
        }

        public function getProfilePicture()
        {
            $data = array(
                            'id'  => $this->session->userdata('users_id')
                            );

            $this->db->select('picture');
            $this->db->from('users');
            $this->db->where($data);
            $query =  $this->db->get();

            $row = $query->row_array();

            return $row['picture'];
        }

        //GET USER DATA
        public function get_UserData()
        {
            $user= NULL;

            $this->db->select('name,email,level,picture');
            $this->db->from('users');
            $this->db->where('id',$this->session->userdata('ProfileID'));

            $query = $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $user[] = array(
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'level' => $row['level'],
                    'picture' => $row['picture']
                );
            }
            return $user;

        }

        //GET USER TEAM DATA
        public function get_UserTeam()
        {
            $this->db->select('teams_id');
            $this->db->from('users');
            $this->db->where('id',$this->session->userdata('ProfileID'));

            $query = $this->db->get();

            $row = $query->row_array();

            $team= NULL;

            $data = array(
                            'id' => $row['teams_id']
                            );

            $query = $this->db->get_where('teams',$data);

            foreach ($query->result_array() as $row)
            {
                $team[] = array(
                    'name' => $row['name'],
                    'level' => $row['level']
                );
            }
            return $team;

        }

        //GET # PROBLEM CORRECT FOR USER ID
        public function get_CorrectProblem()
        {
            $data = array(
                            'users_id'  =>  $this->session->userdata('ProfileID'),
                            'answer_id' => 3
                            );

            $this->db->from('received');
            $this->db->where($data);

            return $this->db->count_all_results();
        }

        //GET # SUBMISSION PROBLEM FOR USER ID
        public function get_SubmissionProblem()
        {
            $data = array(
                            'users_id'  =>  $this->session->userdata('ProfileID')
                            );

            $this->db->from('received');
            $this->db->where($data);

            return $this->db->count_all_results();
        }

        
        //GET # FIRST PLACE FOR USER ID
        public function get_UserFirstPlace()
        {
            $Count = 0;

            $this->db->from('received');
            $this->db->where('users_id', $this->session->userdata('ProfileID'));
            $this->db->where('answer_id', 3);

            $query = $this->db->get();

            foreach ($query->result_array() as $row)
            {

                $this->db->select('users_id,runtime');
                $this->db->from('received');
                $this->db->where('problems_id', $row['problems_id']);
                $this->db->where('answer_id', 3);
                $this->db->order_by('runtime', 'ASC');
                $this->db->limit(1);

                $queryFirst = $this->db->get();

                $rowFirst = $queryFirst->row_array();

                if($rowFirst['users_id'] == $this->session->userdata('ProfileID'))
                    $Count += 1;
                
            }

            return $Count;
            
        }

        //GET # SECOND PLACE FOR USER ID
        public function get_UserSecondPlace()
        {
            $Count = 0;

            $this->db->from('received');
            $this->db->where('users_id', $this->session->userdata('ProfileID'));
            $this->db->where('answer_id', 3);

            $query = $this->db->get();

            foreach ($query->result_array() as $row)
            {

                $this->db->select('users_id,runtime');
                $this->db->from('received');
                $this->db->where('problems_id', $row['problems_id']);
                $this->db->where('answer_id', 3);
                $this->db->order_by('runtime', 'ASC');
                $this->db->limit(2,1);


                $querySecond = $this->db->get();

                $rowSecond = $querySecond->row_array();

                if($rowSecond['users_id'] == $this->session->userdata('ProfileID'))
                    $Count +=  1;
                
            }

            return $Count;
            
        }

        
        //GET BOOL IF PROBLEM PIONER
        public function get_SubmissionPioner()
        {
            $this->db->select('problems_id');
            $this->db->from('received');
            $this->db->where('users_id', $this->session->userdata('ProfileID'));
            $this->db->where('answer_id', 3);

            $query = $this->db->get();

            foreach ($query->result_array() as $row)
            {

                $this->db->select('users_id,time');
                $this->db->from('received');
                $this->db->where('problems_id', $row['problems_id']);
                $this->db->where('answer_id', 3);
                $this->db->order_by('time', 'ASC');
                $this->db->limit(1);


                $querySecond = $this->db->get();

                $rowSecond = $querySecond->row_array();

                if($rowSecond['users_id'] == $this->session->userdata('ProfileID'))
                    return TRUE;
                
            }

            return FALSE;
            
        }

        
        //GET BOOL IF PROBLEM PIONER
        public function get_CrazySubmission()
        {
            //GET 50% CANT PROBLEMS
            $this->db->from('problems');
            $query = $this->db->get();
            $CantProblems = ($this->db->count_all_results() / 2 );

            //GET CANT SUBMISSION
            $this->db->from('received');
            $this->db->where('users_id',$this->session->userdata('ProfileID'));
            $CantSubmission = $this->db->count_all_results();
            
            return ($CantSubmission >= $CantProblems);  
        }

        
        //GET BEST USER
        public function get_BestUser()
        {
            //GET USER INFO
            $this->db->select('id,level,progress');
            $this->db->from('users');
            $this->db->order_by('level', 'DESC');
            $this->db->order_by('progress', 'DESC');
            $this->db->limit(1);

            $query = $this->db->get();
            $row = $query->row_array();

            if($row['id'] == $this->session->userdata('ProfileID'))
                return TRUE;
            
            return FALSE;  
        }

        
        //GET BEST TEAM
        public function get_BestTeam()
        {
            //GET USER INFO
            $this->db->select('teams_id');
            $this->db->from('users');
            $this->db->where('id', $this->session->userdata('ProfileID'));
            $query = $this->db->get();
            $row = $query->row_array();

            $team = $row['teams_id'];

            $this->db->select('id,level,progress');
            $this->db->from('teams');
            $this->db->order_by('level', 'DESC');
            $this->db->order_by('progress', 'DESC');
            $this->db->limit(1);

            $query = $this->db->get();

            $row = $query->row_array();

            if($row['id'] == $team)
                return TRUE;
            
            return FALSE;  
        }
        
        //GET TROPHY BY USER ID
        public function get_UserTrophy()
        {
            //TROPHY 1 - 1st PLACE PROBLEM
            //CONTROLLER USER CHANGE THIS VAL
            $Trophy['FirstPlace'] = 0;

            //TROPHY 2 - PIONER 1 CORRECT 1 PROBLEM
            $Trophy['Pioner'] = $this->get_SubmissionPioner();

            //TROPHY 3 - PERFECTIONIST MORE CORRECT LESS WRONG
            //CONTROLLER USER CHANGE THIS VAL
            $Trophy['Perfectionnist'] = FALSE;

            //TROPHY 4 - PIONER 1 CORRECT 1 PROBLEM
            $Trophy['Crazy'] = $this->get_CrazySubmission();

            //TROPHY 5 - PERFECTIONIST 100% CORRECT
            //CONTROLLER USER CHANGE THIS VAL
            $Trophy['Obsessive'] = FALSE;

            //TROPHY 6 - PIONER 1 BEST USER
            $Trophy['User'] = $this->get_BestUser();

            //TROPHY 7 - PIONER 1 BEST TEAM
            
            $Trophy['Team'] = $this->get_BestTeam();

            //TROPHY 8 - ELITE - BEST USER AND TEAM
            $Trophy['Elite'] = ($Trophy['User'] && $Trophy['Team']);


            //RETURN TROPHY
            return $Trophy;
        }

        //GET MEDALS BY USER ID
        public function get_UserMedals()
        {
            //GET CANT SUBMISSION 
            $CorrectSubmission = $this->get_CorrectProblem();

            //GET USER INFO
            $this->db->select('picture,teams_id');
            $this->db->from('users');
            $this->db->where('id', $this->session->userdata('ProfileID'));
            $query = $this->db->get();
            $row = $query->row_array();

            //MEDAL 1 - CHANGE PICTURE
            $Medals['Picture'] = (strlen($row['picture']) != 82);

            //MEDAL 2 - IS IN A TEAM
            $Medals['Team'] = $row['teams_id']!= NULL;

            //MEDAL 3 - 1 SUBMISSION
            $Medals['Submission'] = ($this->get_SubmissionProblem() > 0);

            //MEDAL 4 - PARTICIPATED IN A MARATHON
            $this->db->from('teamsallowed');
            $this->db->where('teams_id', $row['teams_id']);
            $Medals['Marathon'] = ($this->db->count_all_results() > 0);

            //MEDAL 5 - PARTICIPATED IN A MARATHON
            $Medals['WinMarathon'] = ($this->get_TeamWinMarathon($row['teams_id']));

            //MEDAL 6 - 5 CORRECT SUBMISSION
            $Medals['Medals6'] = ($CorrectSubmission >= 5);

            //MEDAL 7 - 10 CORRECT SUBMISSION
            $Medals['Medals7'] = ($CorrectSubmission >= 10);

            //MEDAL 8 - 50 CORRECT SUBMISSION
            $Medals['Medals8'] = ($CorrectSubmission >= 50);

            //RETURN MEDALS
            return $Medals;
        }

        //GET BOOL IF TEAM WIN A MARATHON 
        public function get_TeamWinMarathon($fields)
        {
            //GET MARATHON ALLOWED
            $this->db->select('marathon_id');
            $this->db->from('teamsallowed');
            $this->db->where('teams_id', $fields);

            $query = $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $data['marathon'] = $row['marathon_id'];
                if($this->get_MarathonStart($data))
                {
                    $SQL=  "SELECT
                               teams_id,
                               teams.name,
                               SUM(SCORE)AS FINALSCORE,
                               SUM(TIME) AS FINALTIME
                            FROM(
                                (SELECT 
                                    marathonreceived.teams_id,
                                    marathonreceived.marathon_id,
                                    COALESCE(SUM(case when marathonreceived.answer_id  = 3 then 1 else 0 end),0) as SCORE,
                                    COALESCE(SUM(case when marathonreceived.answer_id  = 3 then ((EXTRACT(EPOCH FROM marathonreceived.time) - EXTRACT(EPOCH FROM marathon.date))/60)
                                              when ((marathonreceived.answer_id != 3)and(marathonreceived.answer_id != 0)and(marathonreceived.answer_id != 10)) then marathon.penalty else 0 end),0) as TIME
                                FROM 
                                    marathonreceived
                                JOIN 
                                    marathon ON marathon.id = marathonreceived.marathon_id 
                                WHERE
                                    marathonreceived.marathon_id = ".$this->db->escape($row['marathon_id'])." 
                                GROUP BY
                                    marathonreceived.teams_id,
                                    marathonreceived.marathon_id)

                            UNION ALL

                                (SELECT 
                                    teamsallowed.teams_id,
                                    teamsallowed.marathon_id,
                                    0 AS SCORE,
                                    0 as TIME
                                 FROM 
                                    teamsallowed
                                 WHERE
                                    teamsallowed.marathon_id = ".$this->db->escape($row['marathon_id'])."
                                 GROUP BY
                                    teamsallowed.teams_id,
                                    teamsallowed.marathon_id)) LEADERBOARD
                            JOIN 
                                teams ON teams.id = teams_id
                            GROUP BY
                                teams_id,
                                teams.name
                                    
                            ORDER BY
                               FINALSCORE DESC,
                               FINALTIME  ASC

                            LIMIT 1";


                        $Teams = $this->db->query($SQL);                

                        foreach ($Teams->result_array() as $key=>$Teamsrow)
                        {
                            return ($fields == $Teamsrow['teams_id']);
                        }

                }
            }

        }

        //GET # SOLVES SEND 
        public function getSolveCount($fields)
        {
            $data = array(
                            'marathon_id'  => $fields['marathon'],
                            'problems_id'  => $fields['problem'],
                            'teams_id'     => $this->session->userdata('teams_id')
                            );

            $this->db->from('marathonreceived');
            $this->db->where($data);

            return $this->db->count_all_results();
        }


        //LOCK USER
    	public function lock($fields)
    	{
    		

    		$data = array(
    						'pass'   => $fields['password'],
    	    				'email'  => $this->session->userdata('email')
						    );

    		$query = $this->db->get_where('users', $data);

            
            if($query->num_rows() > 0)
            {
            	$this->session->set_userdata('lock',FALSE);
            	return TRUE;
            }
            else
            	return FALSE;

        }

        
        //CHANGE PASSWORD
        public function ChangePassword($fields)
        {
            if($fields['password'] == $fields['Rpassword'])
            {               
                $data = array(
                                'pass'   => $fields['password']
                            );

                $this->db->where('id',$this->session->userdata('users_id'));
                $this->db->update('users', $data);

                $this->email->from('support@judge.com.ve', 'JO+');
                $this->email->to($this->session->userdata("email"));
                $this->email->subject($this->lang->line("PasswordChangeSUB"));
                $this->email->message('
                                        <table class="body-wrap">
                                            <tr>
                                                <td style="display: block !important;max-width: 600px !important;margin: 0 auto !important;clear: both !important;" width="600">
                                                    <div style="max-width: 600px;margin: 0 auto;display: block;padding: 20px;">
                                                        <table style="  background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;" width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding: 20px;">
                                                                    <table  cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                            <td>
                                                                                <img class="img-responsive" src="http://www.judge.com.ve/assets/email_templates/img/'.$this->session->userdata('site_lang').'_header.jpg"/>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 0 0 20px;">
                                                                                <h3>'.$this->lang->line("PasswordChange").'</h3>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 0 0 20px;">
                                                                                '.$this->lang->line("PasswordChangeSUB").'
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: center;  padding: 0 0 20px;">
                                                                                <a href="'.site_url().'" target="_blank" style="text-decoration: none;color: #FFF;background-color: #1ab394;border: solid #1ab394;border-width: 5px 10px;
                                                                                                   line-height: 2;font-weight: bold;text-align: center;cursor: pointer;display: inline-block;border-radius: 5px;text-transform: capitalize;">'.$this->lang->line("login").'</a>
                                                                            </td>
                                                                        </tr>
                                                                      </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>');

                $this->email->send();

                return ($this->db->affected_rows() > 0); 
            }
            else
                return FALSE;

        }

        //FORGOT PASSWORD
        public function ForgotPassword($fields)
        {
            
            $data = array(
                                'email'  => $fields['email']
                            );

            $query = $this->db->get_where('users', $data);

            if($query->num_rows() == 1)
            {

                $row = $query->row_array();

                $this->email->from('support@judge.com.ve', 'JO+');
                $this->email->to($fields['email']);
                $this->email->subject($this->lang->line("ForgotPassword"));
                $this->email->message('
                                        <table class="body-wrap">
                                            <tr>
                                                <td style="display: block !important;max-width: 600px !important;margin: 0 auto !important;clear: both !important;" width="600">
                                                    <div style="max-width: 600px;margin: 0 auto;display: block;padding: 20px;">
                                                        <table style="  background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;" width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding: 20px;">
                                                                    <table  cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                            <td>
                                                                                <img class="img-responsive" src="http://www.judge.com.ve/assets/email_templates/img/'.$this->session->userdata('site_lang').'_header.jpg"/>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 0 0 20px;">
                                                                                <h3>'.$this->lang->line("ForgotPassword").'</h3>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 0 0 20px;">
                                                                                '.$this->lang->line("TextPasswordEmail").'
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 0 0 20px;">
                                                                                '.$this->lang->line("Text2PasswordEmail").'
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: center;  padding: 0 0 20px;">
                                                                                <a href="'.site_url().'controller/ResetPassword/'.$row['id'].'/'.do_hash($row["id"].$row["email"].$row["pass"].date('YmdG')).'" target="_blank" style="text-decoration: none;color: #FFF;background-color: #1ab394;border: solid #1ab394;border-width: 5px 10px;
                                                                                                   line-height: 2;font-weight: bold;text-align: center;cursor: pointer;display: inline-block;border-radius: 5px;text-transform: capitalize;">'.$this->lang->line("BtnRestore").'</a>
                                                                            </td>
                                                                        </tr>
                                                                      </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>');

                $this->email->send();

                return TRUE;
            }
            else
                return FALSE;

        }
        
        //ALLOW COUNTRY
        public function AllowCountry($fields)
        {

            $data = array(
                            'id'   => $fields['id']
                            );

            $query = $this->db->get_where('users', $data);

            
            if($query->num_rows() == 1)
            {

                $row = $query->row_array();

                $data = array(
                            'users_id'   => $row['id']
                            );

                $queryLog = $this->db->get_where('logsession', $data);

                $rowLog = $queryLog->row_array();


                if($fields['hash'] == ( do_hash($row["id"].$row["email"].$rowLog["ip"].$rowLog["time"]) ))
                {

                    //ADD COUNTRY
                    $data = array(
                                    'users_id' => $row["id"],
                                    'name' => rawurldecode($fields['country'])
                                );

                    $query = $this->db->get_where('allowcountry', $data);

                    if($query->num_rows() == 0)
                    {
                        $this->db->insert('allowcountry', $data);
                        $result['error']=$this->lang->line("AllowCountrySuccess");
                    }
                    else
                    {
                        $result['error']=$this->lang->line("HashExpired");
                    }

                    return $result;
                }
                else
                {
                    $result['error']=$this->lang->line("HashExpired");
                    return $result;
                }
            }
            else
            {
                $result['error']=$this->lang->line("HashExpired");
                return $result;
            }
        }

        //RESET PASSWORD USERS
        public function ResetPassword($fields)
        {
            $this->load->helper('string');

            $data = array(
                            'id'   => $fields['id']
                            );

            $query = $this->db->get_where('users', $data);

            
            if($query->num_rows() == 1)
            {

                $row = $query->row_array();

                if($fields['hash'] == ( do_hash($fields['id'].$row["email"].$row["pass"].date('YmdG')) ))
                {
                    //ENCRYPT THIS
                    $new = random_string('alnum', 8);

                    //UPDATE NEW PASSWORD AND UNBLOCK
                    $data = array(
                                    'pass'   => $new,
                                    'block' => FALSE
                                );
                    $this->db->where('id',$fields['id']);
                    $this->db->update('users', $data);

                    //SEND NEW PASSWORD
                    $this->email->from('support@judge.com.ve', 'JO+');
                    $this->email->to($row['email']);
                    $this->email->subject($this->lang->line("PasswordRestore"));
                    $this->email->message('
                                        <table class="body-wrap">
                                            <tr>
                                                <td style="display: block !important;max-width: 600px !important;margin: 0 auto !important;clear: both !important;" width="600">
                                                    <div style="max-width: 600px;margin: 0 auto;display: block;padding: 20px;">
                                                        <table style="  background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;" width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding: 20px;">
                                                                    <table  cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                            <td>
                                                                                <img class="img-responsive" src="http://www.judge.com.ve/assets/email_templates/img/'.$this->session->userdata('site_lang').'_header.jpg"/>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 0 0 20px;">
                                                                                <h3>'.$this->lang->line("PasswordRestore").'</h3>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 0 0 20px;">
                                                                                '.$this->lang->line("Email").': '.$row["email"].'
                                                                                '.$this->lang->line("password").': '.$new.'
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: center;  padding: 0 0 20px;">
                                                                                <a href="'.site_url().'" target="_blank" style="text-decoration: none;color: #FFF;background-color: #1ab394;border: solid #1ab394;border-width: 5px 10px;
                                                                                                   line-height: 2;font-weight: bold;text-align: center;cursor: pointer;display: inline-block;border-radius: 5px;text-transform: capitalize;">'.$this->lang->line("login").'</a>
                                                                            </td>
                                                                        </tr>
                                                                      </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>');

                    $this->email->send();

                    $result['error']=$this->lang->line("PasswordRestore");
                    return $result;


                }
                else
                {
                    $result['error']=$this->lang->line("HashExpired");
                    return $result;
                }
            }
            else
            {
                $result['error']=$this->lang->line("HashExpired");
                return $result;
            }
        }
          
        

        //LOGIN USERS
    	public function login($fields)
    	{
    		$data = array(
    						'pass'   => $fields['password'],
    	    				'email'  => $fields['email']
						    );

    		$query = $this->db->get_where('users', $data);

            if($query->num_rows() == 1)
            {
                $country = $this->timezone->get_country_code_by_ip('201.242.20.218');
                $row = $query->row_array();

                $data = array(
                        'users_id'  => $row['id'],
                        'name'      => $country
                        );

                $queryCountry = $this->db->get_where('allowcountry', $data);

                if($queryCountry->num_rows() == 1)
                {

                    if($row['block'] == 'f')
                    {
                        $session_data = array(
                                            'users_id'   => $row['id'],
                                            'name'       => $row['name'],
                                            'email'      => $row['email'],
                                            'teams_id'   => $row['teams_id'],
                                            'role_id'    => $row['role_id'],
                                            'level'      => $row['level'],
                                            'progress'   => $row['progress'],
                                            'picture'    => $row['picture'],
                                            'loggedIn'   => TRUE,
                                            'lock'       => FALSE,
                                            'country'    => $country                                   
                                        );


                        $this->session->set_userdata($session_data);

                        $data = array(
                                        'error' => 0
                                );

                        $this->db->where('users_id',$row['id']);
                        $this->db->set('time', 'NOW()');
                        $this->db->update('logsession', $data);
                        
                        $result['login']=TRUE;

                        return $result;
                    }
                    else
                    {
                        //SEND EMAIL
                        $data['email'] = $row['email'];
                        $this->ForgotPassword($data);

                        $result['error'] = $this->lang->line("UserBlocked");

                        $result['login'] = FALSE;
                        return $result;

                    }
                }
                else
                {
                    $data = array(
                            'users_id'   => $row['id']
                            );

                    $queryLog = $this->db->get_where('logsession', $data);

                    $rowLog = $queryLog->row_array();

                    //SEND NEW PASSWORD
                    $this->email->from('support@judge.com.ve', 'JO+');
                    $this->email->to($row['email']);
                    $this->email->subject($this->lang->line("AllowCountry"));
                    $this->email->message('
                                        <table class="body-wrap">
                                            <tr>
                                                <td style="display: block !important;max-width: 600px !important;margin: 0 auto !important;clear: both !important;" width="600">
                                                    <div style="max-width: 600px;margin: 0 auto;display: block;padding: 20px;">
                                                        <table style="  background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;" width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="padding: 20px;">
                                                                    <table  cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                            <td>
                                                                                <img class="img-responsive" src="http://www.judge.com.ve/assets/email_templates/img/'.$this->session->userdata('site_lang').'_Country.jpg"/>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 0 0 20px;">
                                                                                <h3>'.$this->lang->line("AllowCountry").': '.$country.'</h3>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 0 0 20px;">
                                                                                '.$this->lang->line("AllowCountryText").'
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 0 0 20px;">
                                                                                '.$this->lang->line("AllowCountryText2").'
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: center;  padding: 0 0 20px;">
                                                                                <a href="'.site_url().'controller/AllowCountry/'.$row['id'].'/'.$country.'/'.do_hash($row["id"].$row["email"].$rowLog["ip"].$rowLog["time"]).'" target="_blank" style="text-decoration: none;color: #FFF;background-color: #1ab394;border: solid #1ab394;border-width: 5px 10px;
                                                                                                   line-height: 2;font-weight: bold;text-align: center;cursor: pointer;display: inline-block;border-radius: 5px;text-transform: capitalize;">'.$this->lang->line("AllowCountry").'</a>
                                                                            </td>
                                                                        </tr>
                                                                      </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>');

                    $this->email->send();

                    $result['error'] = $this->lang->line("AllowCountryLoginText");
                    $result['login'] = FALSE;
                    return $result;

                }

            }
            else
            {
            	$data = array(
    	    					'email'  => $fields['email']
						    );

    			$query = $this->db->get_where('users', $data);

    			if($query->num_rows() == 1)
           		{

                	$row = $query->row_array();

                	$id = $row['id'];
                    $email = $row['email'];
                	$query = $this->db->get_where('logsession', array('users_id' => $id) );

	            	$row = $query->row_array();

                    if($row['error']+1 < 3)
                    {
                        $data = array(
                                'error' => $row['error']+1
                            );

                        $this->db->where('users_id',$id);
                        $this->db->set('time', 'NOW()');
                        $this->db->update('logsession', $data);
                        $result['error']=$this->lang->line("WrongUsernamePassword");
                    }
                    else
                    {
                        $data = array(
                                'block' => TRUE
                            );

                        $this->db->where('id',$id);
                        $this->db->update('users', $data);

                        //SEND EMAIL
                        $data['email'] = $email;
                        $this->ForgotPassword($data);

                        $result['error']= $this->lang->line("UserBlocked");
                    }

	            	
	            }
                $result['error']= $this->lang->line("WrongUsernamePassword");
                $result['login']=FALSE;
                return $result;	
            }
            
            
        }



        public function register($fields)
    	{

    	    $query = $this->db->get_where('users', array('email' => $fields['email']));

    	    if($query->num_rows() == 0)
            {
            	$data = array(
    	    				'pass'  =>  $fields['password'],
						    'name'  =>  $fields['name'],
						    'email' =>  $fields['email'],
						    'teams_id' => NULL,
						    'role_id'  => 1,
						    'level'    => 0,
                            'progress' => 0,
						    'picture'  => 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==',
						    'block'    => FALSE

						);

			    if(!$this->db->insert('users', $data))
			    {
			    	//BLOCK - IP
			    	return FALSE;
			    }
			    else
			    {

			    	$query = $this->db->get_where('users', array('email' => $fields['email']));
			    	$row = $query->row_array();

			    	$data = array(
    	    				'users_id'  => $row['id'],
    	    				'error' => 0,
                            'ip'    => $this->input->ip_address()
    	    				);

			    	$this->db->insert('logsession', $data);

                    $data = array(
                            'users_id'  => $row['id'],
                            'name'    =>  $this->timezone->get_country_code_by_ip('201.242.20.218')
                            );
                    //$this->input->ip_address()

                    $this->db->insert('allowcountry', $data);



					//START SESSION
			    	$session_data = array(
	                						'users_id' => $row['id'],
	                                        'name'     => $fields['name'],
	                                        'email'    => $fields['email'],
                                            'teams_id' => $row['teams_id'],
	                                        'role_id'  => 1,
	                                        'level'    => 0,
                                            'progress' => 0,
	                                        'picture'  => 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==',
	                                        'loggedIn' => TRUE,
	                                        'lock'     => FALSE,
                                            'country'  => $this->timezone->get_country_code_by_ip('201.242.20.218')
	                                    );

 



	                $this->session->set_userdata($session_data);

			    	return TRUE;
			    }
            }
            else
            {	
            	return FALSE;
            }

    	    
		}
        
        public function search_user($fields)
        {
            $this->db->select('id,name,email,level,picture,progress');
            $this->db->from('users');
            $this->db->like(array('LOWER(name)' => $fields['queryString']));
            $this->db->or_like(array('LOWER(email)' => $fields['queryString']));
            return $this->db->get();
        }
        
        public function FillInputCase($fields)
        {

            $this->db->select('inputcase_id');
            $this->db->from('outputcase');
            $this->db->where('problems_id',$fields['id']);

            $query = $this->db->get();
            foreach ($query->result_array() as $key=>$row)
            {
                $output[] = $row['inputcase_id'];

            }

            $row = $query->row_array();

            $this->db->select('id,filename');
            $this->db->from('inputcase');
            $this->db->where('problems_id',$fields['id']);
            $this->db->where_not_in('id', $output);
            return $this->db->get();
        }

        public function team_create($fields)
        {
            $data = array(
                            'name'  =>  $fields['name'],
                            'description' =>  $fields['description'],
                            'users_id'  => $this->session->userdata('users_id'),
                            'level'  => 0,
                            'progress'  => 0,
                            'logo'    => $fields['teamLogo']
                        );

            if(!$this->db->insert('teams', $data))
            {
                return FALSE;
            }
            else
            {
                $query = $this->db->get_where('teams',$data);
                
                if ($query->num_rows() > 0)
                {
                    $row = $query->row_array();
                    $this->session->set_userdata('teams_id',$row['id']);

                    $data = array(
                                'teams_id'  =>  $this->session->userdata('teams_id')
                            );

                    $this->db->where('id',$this->session->userdata('users_id'));

                    //UPDATE ALL USER THIS TEAM
                    $this->db->update('users', $data);
                    
                    return ($this->db->affected_rows()> 0);
                    
                }
                else
                    return FALSE;
            }
        }

        public function add_member($fields)
        {
            $data = array(
                                'teams_id' => $fields['team'],
                                'users_id' => $fields['user']
                            );

            $query = $this->db->get_where('teamrequest',$data);

            if($query->num_rows() == 0)
            {
                $this->db->where('teams_id',$fields['team']);
                if($this->db->count_all('teamrequest') < 3)
                {
                    $this->db->set('time', 'NOW()');
                    $this->db->insert('teamrequest', $data);

                    if($this->db->affected_rows()> 0)
                    {
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }
            }
            else
                return 3;
        }

        //GET MEMBERS ACTIVE
        public function get_active()
        {
            $active= NULL;
            $data = array(
                            'teams_id' => $this->session->userdata('teams_id')
                            );

            $query = $this->db->get_where('users',$data);

            foreach ($query->result_array() as $row)
            {
                $active[] = array(
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'level' => $row['level']
                );
            }
            return $active;

        }

        
        //GET MEMBERS ACTIVE
        public function get_TopUsers()
        {
            $TopUsers= NULL;

            $this->db->select('name,email,level,progress');
            $this->db->from('users');
            
            $this->db->order_by('level', 'DESC');
            $this->db->order_by('progress', 'DESC');

            $this->db->limit(5);

            $query = $this->db->get();

            foreach ($query->result_array() as $key=>$row)
            {
                $TopUsers[] = array(
                    'id'    => $key+1,
                    'name'  => $row['name'],
                    'email' => $row['email'],
                    'level' => $row['level'],
                    'progress' => $row['progress']
                );
            }
            return $TopUsers;

        }

        
        //GET MEMBERS ACTIVE
        public function get_TopTeam()
        {
            $TopTeam= NULL;

            $this->db->select('name,description,level,progress');
            $this->db->from('teams');
            
            $this->db->order_by('level', 'DESC');
            $this->db->order_by('progress', 'DESC');

            $this->db->limit(5);

            $query = $this->db->get();

            foreach ($query->result_array() as $key=>$row)
            {
                $TopTeam[] = array(
                    'id'    => $key+1,
                    'name'  => $row['name'],
                    'description' => $row['description'],
                    'level' => $row['level'],
                    'progress' => $row['progress']
                );
            }
            return $TopTeam;

        }

        
        //GET USER SUBMISSION
        public function get_Submission()
        {
            $Submission= NULL;

            $this->db->select('*');
            $this->db->select('received.id AS received_id');
            $this->db->select('problems.id AS problems_id');
            $this->db->select('problems.name AS problems_name');
            $this->db->select('answer.id AS answer_id');
            $this->db->select('answer.name AS answer_name');
            $this->db->from('received');

            $this->db->join('answer', 'answer.id  = received.answer_id');
            $this->db->join('problems', 'problems.id  = received.problems_id');


            $this->db->where('users_id', $this->session->userdata('users_id'));


            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $Submission[] = array(
                    'id'     => $row['problems_id'],
                    'name'   => $row['problems_name'],
                    'level'  => $row['level'],
                    'time'   => $row['time'],
                    'answer' => $row['answer_name']              
                    );
            }
            return $Submission;

        }

        //GET USER SUBMISSION
        public function get_AllSubmission()
        {
            $Submission= NULL;

            $this->db->select('*');
            $this->db->select('received.id AS received_id');
            $this->db->select('problems.id AS problems_id');
            $this->db->select('problems.name AS problems_name');
            $this->db->select('users.name AS users_name');
            $this->db->select('answer.id AS answer_id');
            $this->db->select('answer.name AS answer_name');
            $this->db->from('received');

            $this->db->join('answer', 'answer.id  = received.answer_id');
            $this->db->join('problems', 'problems.id  = received.problems_id');
            $this->db->join('users', 'users.id  = received.users_id');

            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $Submission[] = array(
                    'id'     => $row['problems_id'],
                    'problem'   => $row['problems_name'],
                    'name'   => $row['users_name'],
                    'email'   => $row['email'],
                    'level'  => $row['level'],
                    'time'   => $row['time'],
                    'answer' => $row['answer_name']              
                    );
            }
            return $Submission;

        }

        
        //GET TOTAL USERS
        public function get_TotalUsers()
        {
            $this->db->from('users');
            return $this->db->count_all_results();
        }

        //GET TOTAL USERS
        public function get_TotalTeams()
        {
            $this->db->from('teams');
            return $this->db->count_all_results();
        }

        //GET TOTAL USERS
        public function get_TotalProblems()
        {
            $this->db->from('problems');
            return $this->db->count_all_results();
        }

        //GET TOTAL USERS
        public function get_TotalRepositories()
        {
            $this->db->from('repository');
            return $this->db->count_all_results();
        }

        
        public function get_CantCorrectProblems()
        {
            $data = array(
                            'users_id'  =>  $this->session->userdata('users_id'),
                            'answer_id' => 3
                            );

            $this->db->from('received');
            $this->db->where($data);

            $CantCorrect = $this->db->count_all_results();

            $data = array(
                            'users_id'  =>  $this->session->userdata('users_id')                            
                            );

            $this->db->from('received');
            $this->db->where($data);
            $CantProblems = $this->db->count_all_results();

            //PREVENT DIVISION BY ZERO
            if($CantProblems == 0)
            {
                $CantProblems=1;
            }

            $ProblemStast = array(
                                        'CantProblem'  => $CantCorrect,
                                        'Percentage'   => round((($CantCorrect / $CantProblems)*100),1)           
                                    );
            return $ProblemStast;
        }

        
        //GET IF MARATHON START
        public function get_MarathonStart($fields)
        {
            $this->load->helper('date');
            date_default_timezone_set(TIMEZONE);

            //GET START DATE FROM MARATHON
            $this->db->select('date,startfreeze,endfreeze');
            $this->db->from('marathon');
            $this->db->where('id', $fields['marathon']);
            $query =  $this->db->get();

            $row = $query->row_array();
            $MarathonStart = $row['date'];


            return (time() >= strtotime($MarathonStart));

        }



        //GET CANT ALLOWED MARATHON
        public function get_CantMarathon()
        {
            $data = array(
                            'teams_id'  =>  $this->session->userdata('teams_id')
                            );

            $this->db->from('teamsallowed');

            $this->db->join('marathon', 'teamsallowed.marathon_id  = marathon.id');

            $this->db->where($data);

            return $this->db->count_all_results();
        }


        //GET TEAM REQUEST MEMBERS
        public function get_request()
        {
            $request= NULL;

            $data = array(
                            'teams_id' => $this->session->userdata('teams_id')
                            );

            $query = $this->db->get_where('teamrequest',$data);

            foreach ($query->result_array() as $row)
            {

                $data = array(
                            'id' => $row['users_id']
                            );

                $query_user = $this->db->get_where('users',$data);

                foreach ($query_user->result_array() as $row_user)
                {

                    $request[] = array(
                        'name' => $row_user['name'],
                        'email' => $row_user['email'],
                        'level' => $row_user['level']
                    );
                }
            }

            return $request;
        }

        //GET MEMBERS REQUEST TEAM    
        public function get_TeamRequest()
        {
            $request= NULL;

            $this->db->select('*');
            $this->db->select('teams.id AS teams_id');
            $this->db->select('teams.id AS teams_id');
            $this->db->from('teamrequest');
            $this->db->where('teamrequest.users_id',$this->session->userdata('users_id'));

            $this->db->join('teams', 'teamrequest.teams_id  = teams.id');

            
            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $request[] = array(
                    'id'    => $row['teams_id'],
                    'name'  => $row['name'],
                    'description'=> $row['description'],
                    'level'      => $row['level'],
                    'progress'   => $row['progress'],
                    'time' => $row['time'],
                );
            }

            return $request;
        }

        

        //JOIN TEAM
        public function TeamJoin($fields)
        {
            if(! $this->isInATeam())
            {


                $data = array(
                                'teams_id'    => $fields['id']
                            );

                $this->db->where('id', $this->session->userdata('users_id'));
                $this->db->update('users', $data);



                $this->db->where('users_id', $this->session->userdata('users_id'));
                $this->db->where('teams_id', $fields['id']);

                $this->db->delete('teamrequest');

                $this->session->set_userdata('teams_id',$fields['id']);
            }
        
            return $this->db->affected_rows() > 0;
        }

        
        //REJECT TEAM
        public function TeamReject($fields)
        {

            $this->db->where('users_id', $this->session->userdata('users_id'));
            $this->db->where('teams_id', $fields['id']);

            $this->db->delete('teamrequest');           
        
            return $this->db->affected_rows() > 0;
        }

        
        //LEAVE TEAM
        public function TeamOut()
        {

            $data = array(
                                'teams_id' => NULL
                            );

            $this->db->where('id',$this->session->userdata('users_id'));
            $this->db->update('users', $data);
                    
            if($this->db->affected_rows()> 0)
            {
                return $this->session->set_userdata('teams_id',NULL); 
            }
            else 
                return false;
        }


        //GET MY TEAM
        public function get_Myteam()
        {
            $team= NULL;
            $data = array(
                            'id' => $this->session->userdata('teams_id')
                            );

            $query = $this->db->get_where('teams',$data);

            foreach ($query->result_array() as $row)
            {
                $team[] = array(
                    'name' => $row['name'],
                    'description' => $row['description'],
                    'level' => $row['level'],
                    'progress' => $row['progress'],
                    'logo' => $row['logo']
                );
            }
            return $team;

        }

        //GET TEAMS
        public function get_team()
        {
            $team= NULL;
            
            $this->db->select('*');
            $this->db->from('teams');
            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $team[] = array(
                    'id'          => $row['id'],
                    'name'        => $row['name'],
                    'level'       => $row['level'],
                    'progress'    => $row['progress'],
                    'description' => $row['description'],
                    'logo'        => $row['logo']
                );
            }
            return $team;

        }

        //GET TEAMS BY MARATHON
        public function get_MarathonTeam($fields)
        {
            $team= NULL;
            
            $this->db->select('*');
            $this->db->select('teams.id AS teams_id');
            $this->db->from('teams');
            $this->db->join('teamsallowed', 'teamsallowed.teams_id  = teams.id');

            $this->db->where('teamsallowed.marathon_id',$fields['id']);
            $query =  $this->db->get();


            foreach ($query->result_array() as $row)
            {
                $team[] = array(
                    'id'          => $row['teams_id'],
                    'name'        => $row['name'],
                    'level'       => $row['level'],
                    'progress'    => $row['progress'],
                    'description' => $row['description'],
                    'logo'        => $row['logo']
                );
            }
            return $team;

        }

        
        //GET PROBLEM LIST
        public function get_users()
        {
            $users= NULL;
            $this->db->select('id,name,email,role_id');
            $this->db->from('users');
            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {

                $users[] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'role' => $row['role_id']
                );
            }
            return $users;

        }

        //GET JURY LIST
        public function get_jury()
        {
            $jury= NULL;
            $this->db->select('id,name,email,role_id');
            $this->db->from('users');
            $this->db->where('role_id',2);
            $this->db->or_where('role_id',3);
            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $jury[] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email']
                );
            }
            return $jury;
        }

        
        //GET ROLE LIST
        public function get_roles()
        {
            $role= NULL;
            $this->db->select('id,name');
            $this->db->from('role');
            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {

                $role[] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                );
            }
            return $role;

        }

        
        //SET ROLE 
        public function set_role($fields)
        {
            $data = array(
                                'role_id' => $fields['role']
                            );

            $this->db->where('id',$fields['id']);
            $this->db->update('users', $data);
                    
            return $this->db->affected_rows()> 0;
        }

        //GET PROBLEM LIST
        public function get_problems()
        {
            $problems= NULL;
            $this->db->select('id,name,keyword,level');
            $this->db->from('problems');
            $this->db->where('hide',FALSE);
            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                //GET PIONER FOR THIS PROBLEM
                $this->db->select('users_id,name,time');
                $this->db->from('received');
                $this->db->join('users', 'received.users_id  = users.id');
                $this->db->where('problems_id', $row['id']);
                $this->db->where('answer_id', 3);
                $this->db->order_by('time', 'ASC');
                $this->db->limit(1);


                $querySecond = $this->db->get();

                $rowSecond = $querySecond->row_array();

                //GET FIRT PLACE PROBLEM
                $this->db->select('users_id,name,runtime');
                $this->db->from('received');
                $this->db->join('users', 'received.users_id  = users.id');
                $this->db->where('problems_id', $row['id']);
                $this->db->where('answer_id', 3);
                $this->db->order_by('runtime', 'ASC');
                $this->db->limit(1);

                $querythird = $this->db->get();

                $rowthird = $querythird->row_array();

                $problems[] = array(
                    'id'      => $row['id'],
                    'pionerid'   => $rowSecond['users_id'],
                    'pionername' => $rowSecond['name'],
                    'firstplaceid'   => $rowthird['users_id'],
                    'firstplacename' => $rowthird['name'],
                    'name'    => $row['name'],
                    'level'   => $row['level'],
                    'keyword' => $row['keyword']
                );
            }
            return $problems;

        }

        //GET PROBLEM HIDE TO
        public function get_problemsHide()
        {
            $problems= NULL;
            $this->db->select('id,name,keyword,level');
            $this->db->from('problems');
            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {

                $problems[] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'level' => $row['level'],
                    'keyword' => $row['keyword']
                );
            }
            return $problems;

        }

        //GET PROBLEM LIST
        public function get_problems_id($fields)
        {
            $problems= NULL;
            $this->db->select('*');
            $this->db->select('problems.id AS problems_id');
            $this->db->select('problems.name AS problems_name');
            $this->db->select('repository.name AS repository_name');
            $this->db->from('repositoryid');
            $this->db->where('repositoryid.repository_id', $fields['open']);

            $this->db->join('problems', 'problems.id  = repositoryid.problems_id');
            $this->db->join('repository', 'repository.id  = repositoryid.repository_id');

            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {

                $problems[] = array(
                    'id' => $row['problems_id'],
                    'name' => $row['problems_name'],
                    'level' => $row['level'],
                    'keyword' => $row['keyword'],
                    'repository_name' => $row['repository_name']
                );
            }
            return $problems;

        }

        //GET MARATHON PROBLEM LIST
        public function get_MarathonProblems($fields)
        {
            $problems= NULL;
            $this->db->select('*');
            $this->db->select('problems.id AS problems_id');
            $this->db->select('problems.name AS problems_name');
            $this->db->from('marathon');
            
            $this->db->join('marathonrepoid', 'marathonrepoid.marathonrepo_id  = marathon.marathonrepo_id');
            $this->db->join('problems', 'problems.id  = marathonrepoid.problems_id');

            $this->db->where('marathon.id', $fields['id']);
            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {

                $problems[] = array(
                    'id' => $row['problems_id'],
                    'name' => $row['problems_name']
                );
            }
            return $problems;

        }

        //GET REPOSITORY LIST
        public function get_repository()
        {
            $repository= NULL;
            $this->db->select('*');
            $this->db->from('repository');
            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {

                $repository[] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'description' => $row['description']
                );
            }
            return $repository;

        }

        //GET LEADERBOARD
        public function get_leaderboard()
        {
            $leaderboard= NULL;
            $this->db->select('id,name,email,level,progress');
            $this->db->from('users');
            $this->db->order_by('level', 'DESC');
            $this->db->order_by('progress', 'DESC');
            $query =  $this->db->get();

            foreach ($query->result_array() as $key=>$row)
            {

                $leaderboard[] = array(
                    'users_id' => $row['id'],
                    'position' => $key+1,
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'level' => $row['level'],
                    'progress' => $row['progress']
                );
            }
            return $leaderboard;

        }

        //GET PROBLEM TO EDIT
        public function get_edit_problem($fields)
        {
            $problems= NULL;
            $this->db->select('*');

            $this->db->from('problems');

            $this->db->where('problems.id', $fields['edit']);

            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $problems[] = array(
                    'id'   => $row['id'],
                    'name' => $row['name'],
                    'description' => $row['description'],
                    'background'  => $row['background'],
                    'level' => $row['level'],
                    'hide'  => $row['hide'],
                    'keyword' => $row['keyword'],
                    'inputformat'  => $row['inputformat'],
                    'outputformat' => $row['outputformat'],
                    'inputcase'  => $row['sampleinput'],
                    'outputcase' => $row['sampleoutput']
                );
            }
            return $problems;
        }

        
        public function team_edit($fields)
        {
            $data = array(
                            'name'  =>  $fields['name'],
                            'description' =>  $fields['description']
                        );

            $this->db->where('id',$this->session->userdata('teams_id'));
            

            $this->db->update('teams', $data);

            return ($this->db->affected_rows()> 0);
            
        }

        public function team_deleted()
        {
            //IF ADMIN TEAM
            //IF EXIST

            //DELETED ALL FROM TEAMREQUEST
            $this->db->where('teams_id', $this->session->userdata('teams_id'));

            if($this->db->delete('teamrequest'))
            {
                $data = array(
                                'teams_id'  =>  NULL
                            );

                $this->db->where('teams_id',$this->session->userdata('teams_id'));

                //UPDATE ALL USER THIS TEAM
                if($this->db->update('users', $data))
                {
                    //DELETED ALL FROM TEAMS
                    $this->db->where('id', $this->session->userdata('teams_id'));
                    $this->db->delete('teams');
                    if(! ($this->db->affected_rows()> 0))
                    {
                        return FALSE;
                    }
                    else
                    {
                        //DELETED ALL FROM TEAMS
                        $this->db->where('teams_id', $this->session->userdata('teams_id'));
                        
                        return $this->db->delete('teamsallowed');
                    }

                }
                else
                {
                    return FALSE;
                }

            }
            else
            {
                return FALSE;
            }            
        }

        //SET TEAM LOGO
        public function SetLogo($fields)
        {
            $data = array(
                            'logo' => $fields['logo'],
                        );

            $this->db->where('id', $this->session->userdata('teams_id'));

            $this->db->update('teams', $data);

            return $this->db->affected_rows()> 0;
        }

        //SET USER PICTURE
        public function SetProfile($fields)
        {
            $data = array(
                            'picture' => $fields['picture'],
                        );

            $this->db->where('id', $this->session->userdata('users_id'));

            $this->db->update('users', $data);
            $this->session->set_userdata('picture',$fields['picture']);

            return $this->db->affected_rows()> 0;
        }


        public function problem_new($fields)
        {
            $data = array(
                            'name'        => $fields['name'],
                            'description' => $fields['the_problem'],
                            'pdf'         => NULL,
                            'background'  => $fields['background'],
                            'keyword'     => $fields['keyword'],
                            'level'       => $fields['level'],
                            'hide'        => $fields['hide'],
                            'inputformat' => $fields['the_input'],
                            'outputformat'=> $fields['the_output'],
                            'sampleinput' => $fields['sample_input'],
                            'sampleoutput'=> $fields['sample_output'],
                        );

            $this->db->insert('problems', $data);
            return $this->db->affected_rows()> 0;
            
        }

        public function problem_deleted($fields)
        {
            $this->db->where('id', $fields['deleted']);

            $this->db->delete('problems'); 

            return $this->db->affected_rows()> 0;
        }

        public function problem_fill($fields)
        {
            $this->db->select('*');
            
            $this->db->from('problems');

            $this->db->where('problems.id', $fields['id']);
            
            return $this->db->get();
        }

        public function FillClarification($fields)
        {
                $SQL= '(SELECT 
                                problems_id,
                                teams_id,
                                marathon_id,
                                teams.name,
                                text,
                                time,
                                false as Jury
                            FROM
                                userclarification
                            JOIN
                                teams on teams.id = teams_id
                            WHERE
                                userclarification.teams_id = '.$this->db->escape($fields['team']).'
                            AND
                                userclarification.marathon_id = '.$this->db->escape($fields['marathon']).'
   

                        UNION ALL

                            SELECT 
                                problems_id,
                                juryclarification.teams_id,
                                juryclarification.marathon_id,
                                users.name,
                                text,
                                time,
                                true as Jury
                            FROM
                                juryclarification
                            JOIN
                                jury on jury.id = jury_id
                            JOIN
                                users on users.id = jury.users_id
                            WHERE
                                juryclarification.teams_id = '.$this->db->escape($fields['team']).'
                            AND
                                juryclarification.marathon_id = '.$this->db->escape($fields['marathon']).')


                        ORDER BY

                        time ASC';
            
            return $this->db->query($SQL); 
        }

        public function FillTeamClarification($fields)
        {
            if($fields['problem']==0)
            {
                $team=0;
            }
            else
                $team=$this->session->userdata('teams_id');

            $SQL=' (SELECT 

                        teams_id,
                        marathon_id,
                        teams.name,
                        problems_id,
                        text,
                        time,
                        false as Jury
                    FROM
                        userclarification
                    JOIN
                        teams on teams.id = teams_id
                    WHERE
                        userclarification.teams_id = '.$team.'
                    AND
                        userclarification.marathon_id = '.$this->db->escape($fields['marathon']).'
                    AND
                        problems_id = '.$this->db->escape($fields['problem']).'


                UNION ALL

                    SELECT 
                        juryclarification.teams_id,
                        juryclarification.marathon_id,
                        users.name,
                        problems_id,
                        text,
                        time,
                        true as Jury
                    FROM
                        juryclarification
                    JOIN
                        jury on jury.id = jury_id
                    JOIN
                        users on users.id = jury.users_id
                    WHERE
                        juryclarification.teams_id = '.$team.'
                    AND
                        juryclarification.marathon_id = '.$this->db->escape($fields['marathon']).'
                    AND
                        problems_id = '.$this->db->escape($fields['problem']).')

                ORDER BY

                time ASC';

            return $this->db->query($SQL); 
        }

        public function problem_edit($fields)
        {
            $data = array(
                            'name'        => $fields['name'],
                            'description' => $fields['the_problem'],
                            'pdf'         => NULL,
                            'background'  => $fields['background'],
                            'keyword'     => $fields['keyword'],
                            'level'       => $fields['level'],
                            'hide'        => $fields['hide'],
                            'inputformat'      => $fields['the_input'],
                            'outputformat'     => $fields['the_output'],
                            'sampleinput'      => $fields['sample_input'],
                            'sampleoutput'     => $fields['sample_output']
                        );

            $this->db->where('id', $fields['id']);

            $this->db->update('problems', $data);
            return $this->db->affected_rows()> 0;
            
        }


        public function repository_new($fields)
        {
            $data = array(
                            'name'        => $fields['name'],
                            'description' => $fields['description']
                        );
            $this->db->insert('repository', $data);

            if($this->db->affected_rows() > 0)
            {
                //GET PROBLEMS ID 
                $id = $this->db->insert_id();

                if(!empty($fields['check_list'])) 
                {
                    foreach($fields['check_list'] as $check) 
                    {
                        $this->db->insert('repositoryid',  array('repository_id' =>  $id,'problems_id' =>  $check));
                    }
                }

               return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

        public function repository_deleted($fields)
        {
            //IF ADMIN
            //IF EXIST 
            $this->db->where('repository_id', $fields['deleted']);
            $this->db->delete('repositoryid');

            $this->db->where('id', $fields['deleted']);
            $this->db->delete('repository');
            
            return ($this->db->affected_rows()> 0);            
        }

        //SET RECEIVE USER UPLOAD PROBLEM
        public function set_received($fields)
        {
            if(!$this->isInReceived($fields))
            {
                $data = array(
                            'users_id'    => $this->session->userdata('users_id'),
                            'filename'    => $fields['name'],
                            'problems_id' => $fields['id'],
                            'answer_id' => 0
                        );
                $this->db->set('time', 'NOW()');

                $this->db->insert('received', $data);
                return $this->db->affected_rows() > 0;

            }
            else
            {
                return FALSE;
            }
        }

        //SET INPUT - OUTPUT TESTCASES
        public function set_TestCases($fields)
        {

            if($fields['typeid'] == 0)
            {
                $data = array(
                        'problems_id' => $fields['problemid'],
                        'filename'    => $fields['name'],
                        'md5'         => $fields['md5']
                    );

                $this->db->insert('inputcase', $data);
            }
            else
            {
                $data = array(
                        'problems_id' => $fields['problemid'],
                        'filename'    => $fields['name'],
                        'inputcase_id'=> $fields['inputid'],
                        'md5' => $fields['md5']
                    );

                $this->db->insert('outputcase', $data);
            }

            
            return $this->db->affected_rows() > 0;
        }

        //GET PROBLEM LIST
        public function get_Cases($fields)
        {
            $Cases= NULL;
            $this->db->select('*');
            $this->db->select('inputcase.id AS inputcase_id');
            $this->db->select('outputcase.id AS outputcase_id');
            $this->db->select('inputcase.md5 AS inputcase_md5');
            $this->db->select('outputcase.md5 AS outputcase_md5');
            $this->db->select('inputcase.filename AS inputcase_filename');
            $this->db->select('outputcase.filename AS outputcase_filename');
            $this->db->select('inputcase.problems_id AS inputcase_problems_id');

            $this->db->from('inputcase');

            $this->db->join('outputcase', 'outputcase.inputcase_id  = inputcase.id');

            $this->db->where('inputcase.problems_id',$fields['problem']);


            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {

                $Cases[] = array(
                    'inputcase_problems_id'  => $row['inputcase_problems_id'],
                    'inputcase_id'  => $row['inputcase_id'],
                    'outputcase_id' => $row['outputcase_id'],
                    'inputcase_md5' => $row['inputcase_md5'],
                    'outputcase_md5'      => $row['outputcase_md5'],
                    'inputcase_filename'  => $row['inputcase_filename'],
                    'outputcase_filename' => $row['outputcase_filename']
                );
            }
            return $Cases;

        }

        
        //DELETED PROBLEM CASE
        public function DeletedCases($fields)
        {
            $this->db->where('inputcase_id', $fields['case']);
            $this->db->delete('outputcase');

            $this->db->where('id', $fields['case']);
            $this->db->delete('inputcase');

            return $this->db->affected_rows() > 0;         
        }

        
        //GET BOOL - TEST CASES EXIST
        public function ExistTestCases($fields)
        {
            $data = array(
                            'inputcase_id'  => $fields['inputid']
                            );

            $this->db->from('outputcase');
            $this->db->where($data);

            return $this->db->count_all_results() > 0;
        }
        

        //SET RECEIVE TEAM UPLOAD PROBLEM
        public function set_MarathonReceived($fields)
        {

            $data = array(
                        'teams_id'    => $this->session->userdata('teams_id'),
                        'marathon_id' => $fields['marathon'],
                        'filename'    => $fields['name'],
                        'problems_id' => $fields['problem'],
                        'answer_id'   => 0,
                        'verified'    => false,
                        'jury_id'     => null
                    );
            $this->db->set('time', 'NOW()');
            $this->db->insert('marathonreceived', $data);
            return ($this->db->affected_rows()> 0);
        }

        public function LangNew($fields)
        {
            $data = array(
                            'name'       => $fields['name'],
                            'file'       => $fields['file'],
                            'howcompile' => $fields['compile'],
                            'howrun'     => $fields['run'],
                            'flags'      => $fields['flags']
                        );

            return $this->db->insert('language', $data);

        }

        //GET PROBLEM LIST
        public function get_language()
        {
            $language= NULL;
            $this->db->select('*');
            $this->db->from('language');
            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {

                $language[] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'file' => $row['file'],
                    'compile' => $row['howcompile'],
                    'run' => $row['howrun'],
                    'flags' => $row['flags']
                );
            }
            return $language;

        }

        //DELETED LANGUAGE
        public function LangDeleted($fields)
        {
            $this->db->where('id', $fields['id']);

            return $this->db->delete('language');         
        }

        
        //GET LANGUAGES LIST
        public function get_languages()
        {
            $language= NULL;
            $this->db->select('id,name');
            $this->db->from('language');
            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $language[] = array(
                    'id' => $row['id'],
                    'name' => $row['name']
                );
            }
            return $language;

        }
        
        public function RepoNew($fields)
        {
            $data = array(
                            'maxruntime' => $fields['maxruntime'],
                            'maxram'     => $fields['maxram'],
                            'maxoutput'  => $fields['maxoutput']
                        );

            if($this->db->insert('marathonrepoconfig', $data))
            {
                //GET ID LAST INSERT 
                $id = $this->db->insert_id();

                $data = array(
                            'name' => $fields['name'],
                            'description'     => $fields['description'],
                            'marathonrepoconfig_id'  => $id
                        );

                if($this->db->insert('marathonrepo', $data))
                {
                    //GET ID LAST INSERT 
                    $id = $this->db->insert_id();

                    foreach($fields['languages'] as $check) 
                    {
                        $this->db->insert('allowedlanguage',  array('language_id' =>  $check,'marathonrepo_id' =>  $id));
                    }
                
                    foreach($fields['problems'] as $check) 
                    {
                        $this->db->insert('marathonrepoid',  array('marathonrepo_id' =>  $id,'problems_id' =>  $check));
                    }
                }

                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

        
        public function RepoUpdate($fields)
        {
            $this->db->select('marathonrepoconfig_id');
            $this->db->from('marathonrepo');
            $this->db->where('id',$fields['id']);
            $query =  $this->db->get();
            $row = $query->row_array();

            $data = array(
                            'maxruntime' => $fields['maxruntime'],
                            'maxram'     => $fields['maxram'],
                            'maxoutput'  => $fields['maxoutput']
                        );

            $this->db->where('id',$row['marathonrepoconfig_id']);
            
            if($this->db->update('marathonrepoconfig', $data))
            {

                $data = array(
                            'name' => $fields['name'],
                            'description'     => $fields['description']
                        );

                $this->db->where('id',$fields['id']);

                if($this->db->update('marathonrepo', $data))
                {
                    //DELETED OLD PROBLEMS
                    $this->db->where('marathonrepo_id', $fields['id']);
                    $this->db->delete('allowedlanguage');

                    //ADD NEW PROBLEMS
                    foreach($fields['languages'] as $check) 
                    {
                        $this->db->insert('allowedlanguage',  array('language_id' =>  $check,'marathonrepo_id' =>  $fields['id']));
                    }
                    
                    //DELETED OLD LANGUAGUES
                    $this->db->where('marathonrepo_id', $fields['id']);
                    $this->db->delete('marathonrepoid');

                    //ADD NEW LANGUAGUES
                    foreach($fields['problems'] as $check) 
                    {
                        $this->db->insert('marathonrepoid',  array('marathonrepo_id' =>  $fields['id'],'problems_id' =>  $check));
                    }
                }

                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

        
        //GET REPOSITORY LIST
        public function get_RepoList()
        {
            $repository= NULL;
            $this->db->select('*');
            $this->db->select('marathonrepo.id AS marathonrepo_id');
            $this->db->select('marathonrepoconfig.id AS marathonrepoconfig_id');
            $this->db->from('marathonrepo');
            $this->db->join('marathonrepoconfig', 'marathonrepo.marathonrepoconfig_id  = marathonrepoconfig.id');

            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $repository[] = array(
                    'id'          => $row['marathonrepo_id'],
                    'name'        => $row['name'],
                    'description' => $row['description'],
                    'maxruntime'  => $row['maxruntime'],
                    'maxram'      => $row['maxram'],
                    'maxoutput'   => $row['maxoutput']
                );
            }
            return $repository;

        }

        //GET PROBLEM LIST
        public function get_RepoProblems($fields)
        {
            $problems= NULL;

            $this->db->select('*');
            $this->db->select('problems.id AS problems_id');
            $this->db->select('problems.name AS problems_name');
            $this->db->select('marathonrepo.name AS marathonrepo_name');

            $this->db->from('marathonrepoid');

            $this->db->where('marathonrepoid.marathonrepo_id', $fields['id']);

            $this->db->join('problems', 'problems.id  = marathonrepoid.problems_id');
            $this->db->join('marathonrepo', 'marathonrepo.id  = marathonrepoid.marathonrepo_id');


            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {

                $problems[] = array(
                    'id' => $row['problems_id'],
                    'name' => $row['problems_name'],
                    'level' => $row['level'],
                    'keyword' => $row['keyword'],
                    'repository_name' => $row['marathonrepo_name']
                );
            }
            return $problems;

        }

        //GET MARATHON REPO - PROBLEM LIST
        public function get_MarathonRepo($fields)
        {
            $problems= NULL;

            $this->db->select('*');
            $this->db->select('problems.id AS problems_id');
            $this->db->select('problems.name AS problems_name');
            $this->db->select('marathonrepo.name AS marathonrepo_name');
            $this->db->select('marathon.id AS marathon_id');
            $this->db->select('marathon.name AS marathon_name');
            $this->db->from('marathonrepoid');

            $this->db->join('problems', 'problems.id  = marathonrepoid.problems_id');
            $this->db->join('marathonrepo', 'marathonrepo.id  = marathonrepoid.marathonrepo_id');
            $this->db->join('marathon', 'marathon.marathonrepo_id  = marathonrepoid.marathonrepo_id');

            $this->db->where('marathon.id', $fields['id']);

            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $problems[] = array(
                    'id'      => $row['problems_id'],
                    'name'    => $row['problems_name'],
                    'level'   => $row['level'],
                    'keyword' => $row['keyword'],
                    'repository_name' => $row['marathonrepo_name'],
                    'marathon_id'   => $row['marathon_id'],
                    'marathon_name'   => $row['marathon_name']

                );
            }
            return $problems;

        }

        
        public function RepoDeleted($fields)
        {
            //DELETED REPO FROM allowedlanguage
            $this->db->where('marathonrepo_id', $fields['id']);
            $this->db->delete('allowedlanguage');
            
            //DELETED REPO FROM marathonrepoid
            $this->db->where('marathonrepo_id', $fields['id']); 
            $this->db->delete('marathonrepoid');

            
            //GET marathonrepoconfig_id 
            $this->db->select('marathonrepoconfig_id');
            $this->db->from('marathonrepo');
            $this->db->where('id', $fields['id']);

            $query = $this->db->get();
                
            if ($query->num_rows() > 0)
            {
                $row = $query->row_array();

                //DELETED REPO FROM marathonrepo
                $this->db->where('id', $fields['id']);
                $this->db->delete('marathonrepo');
                
                //DELETED REPO FROM marathonrepoconfig
                $this->db->where('id', $row['marathonrepoconfig_id']);
                $this->db->delete('marathonrepoconfig');

                return $this->db->affected_rows() > 0;
            }
        }   

        //GET REPOCONFIG
        public function get_RepoConfig($fields)
        {
            $RepoConfig= NULL;
            $this->db->select('*');
            $this->db->select('marathonrepoconfig.id AS marathonrepoconfig_id');
            $this->db->from('marathonrepo');
            $this->db->where('marathonrepo.id', $fields['id']);
            $this->db->join('marathonrepoconfig', 'marathonrepo.marathonrepoconfig_id  = marathonrepoconfig.id');

            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $RepoConfig[] = array(
                    'name'        => $row['name'],
                    'description' => $row['description'],
                    'maxruntime'  => $row['maxruntime'],
                    'maxram'      => $row['maxram'],
                    'maxoutput'   => $row['maxoutput']
                );
            }
            return $RepoConfig;

        }

        //GET OLD REPO PROBLEMS
        public function get_OldRepoProblems($fields)
        {
            $OldRepoProblems= NULL;
            $this->db->select('problems_id');
            $this->db->from('marathonrepoid');
            $this->db->where('marathonrepoid.marathonrepo_id', $fields['id']);

            $query =  $this->db->get();

            foreach ($query->result_array() as  $key=>$row)
            {
                $OldRepoProblems[$key] = $row['problems_id'];
            }
            return $OldRepoProblems;

        }

        //GET OLD REPO LANGUAGES
        public function get_OldRepoLanguages($fields)
        {
            $OldRepoLanguages= NULL;
            $this->db->select('language_id');
            $this->db->from('allowedlanguage');
            $this->db->where('allowedlanguage.marathonrepo_id', $fields['id']);

            $query =  $this->db->get();

            foreach ($query->result_array() as  $key=>$row)
            {
                $OldRepoLanguages[$key] = $row['language_id'];
            }
            return $OldRepoLanguages;

        }

        //CREATE MARATHON
        public function NewMarathon($fields)
        {
            $data = array(
                            'name'           => $fields['name'],
                            'description'    => $fields['description'],
                            'date'           => $fields['date'],
                            'duration'       => $fields['duration'],
                            'penalty'        => $fields['penalty'],
                            'startfreeze'    => $fields['startfreeze'],
                            'endfreeze'      => $fields['endfreeze'],
                            'timeshowanswer' => $fields['timeshowanswer'],
                            'marathonrepo_id'=> $fields['repository'],
                            'autostart'      => $fields['autostart']
                        );
            $this->db->insert('marathon', $data);
            if($this->db->affected_rows()> 0)
            {
                //GET ID LAST INSERT 
                $id = $this->db->insert_id();

                foreach($fields['teams'] as $check) 
                {
                    $this->db->insert('teamsallowed',  array('marathon_id' =>  $id,'teams_id' =>  $check));
                }
            
                foreach($fields['jury'] as $check) 
                {
                    $this->db->insert('jury',  array('users_id' =>  $check,'marathon_id' =>  $id));
                }
                

                return ($this->db->affected_rows()> 0);
            }
            else
            {
                return FALSE;
            }
        }

        //EDIT MARATHON
        public function EditMarathon($fields)
        {
            $data = array(
                            'name'           => $fields['name'],
                            'description'    => $fields['description'],
                            'date'           => $fields['date'],
                            'duration'       => $fields['duration'],
                            'penalty'        => $fields['penalty'],
                            'startfreeze'    => $fields['startfreeze'],
                            'endfreeze'      => $fields['endfreeze'],
                            'timeshowanswer' => $fields['timeshowanswer'],
                            'marathonrepo_id'=> $fields['repository']
                        );
            $this->db->where('id', $fields['id']);
            $this->db->update('marathon', $data);
            if($this->db->affected_rows()> 0)
            {
                //DELETED OLD TEAMS
                $this->db->where('marathon_id', $fields['id']);
                $this->db->delete('teamsallowed');

                foreach($fields['teams'] as $check) 
                {
                    $this->db->insert('teamsallowed',  array('marathon_id' =>  $fields['id'],'teams_id' =>  $check));
                }


                $this->db->select('id,users_id');
                $this->db->from('jury');
                $this->db->where('marathon_id', $fields['id']);

                $query =  $this->db->get();

                foreach ($query->result_array() as  $key=>$row)
                {
                    $oldjury[$key] = $row['users_id'];
                    if(!(in_array($row['users_id'], $fields['jury'])))
                    {
                        $data = array(
                            'verified'   => FALSE,
                            'jury_id'    => NULL
                        );

                        $this->db->where('jury_id', $row['id']);
                        $this->db->update('marathonreceived', $data);

                        //DELETED CLARIFICATION JURY
                        $this->db->where('jury_id', $row['id']);
                        $this->db->where('marathon_id', $fields['id']);
                        $this->db->delete('juryclarification');

                        //DELETED OLD JURY
                        $this->db->where('marathon_id', $fields['id']);
                        $this->db->where('users_id', $row['users_id']);
                        $this->db->delete('jury');
                    }
                }
            
                foreach($fields['jury'] as $check) 
                {
                    if(!(in_array($check, $oldjury)))
                    {
                        $this->db->insert('jury',  array('users_id' =>  $check,'marathon_id' => $fields['id']));
                    }
                }

                

                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

        
        //GET MARATHON LIST
        public function get_marathon()
        {
            $marathon= NULL;
            $this->db->select('*');
            $this->db->select('marathon.id AS marathon_id');
            $this->db->select('marathon.name AS marathon_name');
            $this->db->select('marathon.description AS marathon_description');
            $this->db->select('marathonrepo.id AS marathonrepo_id');
            $this->db->select('marathonrepo.name AS marathonrepo_name');

            $this->db->from('marathon');

            $this->db->join('marathonrepo', 'marathon.marathonrepo_id  = marathonrepo.id');
            

            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $marathon[] = array(
                    'id'                => $row['marathon_id'],
                    'name'              => $row['marathon_name'],
                    'description'       => $row['marathon_description'],
                    'date'              => $row['date'],
                    'timeshowanswer'    => $row['timeshowanswer'],
                    'autostart'         => $row['autostart'],
                    'penalty'           => $row['penalty'],
                    'duration'          => $row['duration'],
                    'startfreeze'       => $row['startfreeze'],
                    'endfreeze'         => $row['endfreeze'],
                    'marathonrepo_name' => $row['marathonrepo_name']
                );
            }
            return $marathon;

        }

        
        //GET MARATHON OUTPUT CASES BY PROBLEM
        public function get_marathonReceived($fields)
        {
            $marathonReceived= NULL;

            $this->db->select('*');
            $this->db->select('marathonreceived.id AS marathonreceived_id');
            $this->db->select('problems.name AS problems_name');
            $this->db->select('answer.id AS answer_id');
            $this->db->select('answer.name AS answer_name');
            $this->db->select('marathon.name AS marathon_name');
            $this->db->from('marathonreceived');

            $this->db->join('answer', 'answer.id  = marathonreceived.answer_id');
            $this->db->join('marathon', 'marathon.id  = marathonreceived.marathon_id');
            $this->db->join('problems', 'problems.id  = marathonreceived.problems_id');


            $this->db->where('problems_id', $fields['problem']);
            $this->db->where('marathon_id', $fields['marathon']);


            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $marathonReceived[] = array(
                    'id'           => $row['marathonreceived_id'],
                    'marathon_id'  => $row['marathon_id'],
                    'marathon_name'  => $row['marathon_name'],
                    'teams_id'     => $row['teams_id'],
                    'problems_id'  => $row['problems_id'],
                    'problems_name'  => $row['problems_name'],
                    'answer'       => $row['answer_name'],
                    'filename'     => $row['filename'],
                    'time'         => $row['time'],
                    'verified'     => $row['verified'],
                    'jury_id'      => $row['jury_id']                
                    );
            }
            return $marathonReceived;

        }

        
        //GET PROBLEM OUTPUT BY CASES
        public function get_JudgeProblem($fields)
        {
            $JudgeProblem= NULL;

            $this->db->select('*');
            $this->db->select('marathonreceived.id AS marathonreceived_id');
            $this->db->select('marathoncases.id AS marathoncases_id');
            $this->db->select('outputcase.id AS outputcase_name');
            $this->db->select('marathoncases.filename AS marathoncases_filename');
            $this->db->select('outputcase.filename AS outputcase_filename');

            $this->db->select('answer.id AS answer_id');
            $this->db->select('answer.name AS answer_name');

            $this->db->from('marathoncases');

            $this->db->join('marathonreceived', 'marathonreceived.id  = marathoncases.marathonreceived_id');
            $this->db->join('outputcase', 'outputcase.id  = marathoncases.outputcase_id');
            $this->db->join('answer', 'answer.id  = marathoncases.answer_id');

            $this->db->where('marathonreceived.id', $fields['id']);

            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $JudgeProblem[] = array(
                    'id'            => $row['marathoncases_id'],
                    'problems_id'   => $row['problems_id'],
                    'md5'           => $row['md5'],
                    'md5submit'     => $row['md5submit'],
                    'filename'      => $row['outputcase_filename'],
                    'filenamesubmit'=> $row['marathoncases_filename'],
                    'answer'        => $row['answer_name'],
                    'marathon'      => $row['marathon_id'],
                    'team'          => $row['teams_id'],
                    'marathonreceived'=> $row['marathonreceived_id'],
                    'verified'=> $row['verified']                  
                    );
            }
            return $JudgeProblem;

        }


        
        //GET MARATHON LIST
        public function get_marathonJury()
        {
            $marathon= NULL;
            $this->db->select('*');
            $this->db->select('marathon.id AS marathon_id');
            $this->db->select('marathon.name AS marathon_name');
            $this->db->select('marathon.description AS marathon_description');
            $this->db->select('marathonrepo.id AS marathonrepo_id');
            $this->db->select('marathonrepo.name AS marathonrepo_name');
            $this->db->select('jury.id AS jury_id');

            $this->db->from('marathon');
            
            $this->db->join('marathonrepo', 'marathon.marathonrepo_id  = marathonrepo.id');
            $this->db->join('jury', 'jury.marathon_id  = marathon.id');

            $this->db->where('jury.users_id', $this->session->userdata('users_id'));
   

            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $marathon[] = array(
                    'id'                => $row['marathon_id'],
                    'name'              => $row['marathon_name'],
                    'description'       => $row['marathon_description'],
                    'date'              => $row['date'],
                    'timeshowanswer'    => $row['timeshowanswer'],
                    'autostart'         => $row['autostart'],
                    'penalty'           => $row['penalty'],
                    'duration'          => $row['duration'],
                    'startfreeze'       => $row['startfreeze'],
                    'endfreeze'         => $row['endfreeze'],
                    'marathonrepo_name' => $row['marathonrepo_name']
                );
            }
            return $marathon;

        }

        //DELETED MARATHON
        public function DeletedMarathon($fields)
        {
            $this->db->select('id,users_id');
            $this->db->from('jury');
            $this->db->where('marathon_id', $fields['id']);

            $query =  $this->db->get();

            foreach ($query->result_array() as  $key=>$row)
            {

                $data = array(
                    'verified'   => FALSE,
                    'jury_id'    => NULL
                );

                $this->db->where('jury_id', $row['id']);
                $this->db->update('marathonreceived', $data);

                //DELETED CLARIFICATION JURY
                $this->db->where('jury_id', $row['id']);
                $this->db->where('marathon_id', $fields['id']);
                $this->db->delete('juryclarification');
            }


            //DELETED MARATHON FROM JURY
            $this->db->where('marathon_id', $fields['id']);
            $this->db->delete('jury');
            
            //DELETED MARATHON FROM marathonrepoid
            $this->db->where('marathon_id', $fields['id']); 
            $this->db->delete('teamsallowed');

            //DELETED MARATHON FROM marathonrepo
            $this->db->where('id', $fields['id']);
            $this->db->delete('marathon');
        
            return $this->db->affected_rows()> 0;            
        }   

        //GET REPOCONFIG
        public function get_MarathonConfig($fields)
        {
            $MarathonConfig= NULL;
            $this->db->select('*');
            $this->db->from('marathon');
            $this->db->where('marathon.id', $fields['id']);

            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $MarathonConfig[] = array(
                    'name'              => $row['name'],
                    'description'       => $row['description'],
                    'date'              => $row['date'],
                    'timeshowanswer'    => $row['timeshowanswer'],
                    'autostart'         => $row['autostart'],
                    'marathonrepo_id'   => $row['marathonrepo_id'],
                    'penalty'           => $row['penalty'],
                    'duration'          => $row['duration'],
                    'startfreeze'       => $row['startfreeze'],
                    'endfreeze'         => $row['endfreeze']                   
                );
            }
            return $MarathonConfig;

        }

        
        //GET OLD REPO PROBLEMS
        public function get_OldMarathonTeams($fields)
        {
            $OldMarathonTeams[]=NULL;
            $this->db->select('teams_id');
            $this->db->from('teamsallowed');
            $this->db->where('marathon_id', $fields['id']);

            $query =  $this->db->get();

            foreach ($query->result_array() as  $key=>$row)
            {
                $OldMarathonTeams[$key] = $row['teams_id'];
            }
            return $OldMarathonTeams;

        }

        //GET OLD REPO PROBLEMS
        public function get_OldMarathonJury($fields)
        {
            $OldMarathonJury[]= NULL;
            $this->db->select('users_id');
            $this->db->from('jury');
            $this->db->where('marathon_id', $fields['id']);

            $query =  $this->db->get();

            foreach ($query->result_array() as  $key=>$row)
            {
                $OldMarathonJury[$key] = $row['users_id'];
            }
            return $OldMarathonJury;

        }

        //GET MARATHON ALLOWED LIST
        public function get_marathonAllow()
        {
            $marathon= NULL;
            $this->db->select('*');
            $this->db->select('marathon.id AS marathon_id');
            $this->db->select('marathon.name AS marathon_name');
            $this->db->select('marathon.description AS marathon_description');

            $this->db->from('marathon');

            $this->db->join('teamsallowed', 'teamsallowed.marathon_id  = marathon.id');
            $this->db->where('teamsallowed.teams_id', $this->session->userdata('teams_id'));
            

            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $marathon[] = array(
                    'id'                => $row['marathon_id'],
                    'name'              => $row['marathon_name'],
                    'description'       => $row['marathon_description'],
                    'date'              => $row['date'],
                    'timeshowanswer'    => $row['timeshowanswer'],
                    'autostart'         => $row['autostart'],
                    'penalty'           => $row['penalty'],
                    'duration'          => $row['duration']                
                );
            }
            return $marathon;

        }


        //GET TEAM LEADERBOARD
        public function get_Teamleaderboard()
        {
            $Teamleaderboard= NULL;
            $this->db->select('name,description,level,progress');
            $this->db->from('teams');
            $this->db->order_by('level', 'DESC');
            $this->db->order_by('progress', 'DESC');
            $query =  $this->db->get();

            foreach ($query->result_array() as $key=>$row)
            {

                $Teamleaderboard[] = array(
                    'position' => $key+1,
                    'name' => $row['name'],
                    'description' => $row['description'],
                    'level' => $row['level'],
                    'progress' => $row['progress']
                );
            }
            return $Teamleaderboard;

        }

        public function get_CountCorrectAnswer($fields)
        {
            $data = array(
                            'marathon_id'  => $fields['marathon'],
                            'problems_id'  => $fields['problem'],
                            'teams_id'     => $fields['teams_id'],
                            'answer_id'     => 3
                            );

            $this->db->from('marathonreceived');
            $this->db->where($data);

            return $this->db->count_all_results();
        }

        public function get_CountWrongtAnswer($fields)
        {
            $data = array(
                            'marathon_id'  => $fields['marathon'],
                            'problems_id'  => $fields['problem'],
                            'teams_id'     => $fields['teams_id']
                            );

            $this->db->from('marathonreceived');
            $this->db->where($data);
            $this->db->where('answer_id !=', 3);
            $this->db->where('answer_id !=', 0);
            $this->db->where('answer_id !=',10);

            return $this->db->count_all_results();

        }

        public function get_TimeCorrectAnswer($fields)
        {
            //GET TIME CORRECT ANSWER
            $data = array(
                            'marathon_id'  => $fields['marathon'],
                            'problems_id'  => $fields['problem'],
                            'teams_id'     => $fields['teams_id'],
                            'answer_id'    => 3
                            );

            $this->db->select('time');
            $this->db->from('marathonreceived');
            $this->db->where($data);
            $query =  $this->db->get();

            $row = $query->row_array();
            $CorrectAnswer = $row['time'];

            //GET START DATE FROM MARATHON
            $this->db->select('date');
            $this->db->from('marathon');
            $this->db->where('id', $fields['marathon']);
            $query =  $this->db->get();

            $row = $query->row_array();
            $MarathonStart = $row['date'];

            return round((abs(strtotime($CorrectAnswer) - strtotime($MarathonStart)) / 60),1);
        }

        public function isInFreezeTime($fields)
        {

            //GET START DATE FROM MARATHON
            $this->db->select('date,startfreeze,endfreeze');
            $this->db->from('marathon');
            $this->db->where('id', $fields['marathon']);
            $query =  $this->db->get();

            $row = $query->row_array();
            $MarathonStart = $row['date'];
            $this->load->helper('date');

            date_default_timezone_set(TIMEZONE);
            $MarathonMin = round(abs((time() - strtotime($MarathonStart))/60));
            
            return  (($MarathonMin >$row['startfreeze']) && ($MarathonMin < $row['endfreeze']));
        }

        public function LeaderboardFill($fields)
        {   

            //GET LIST FOR THEAD
            $this->db->select('*');
            $this->db->from('marathon');
            $this->db->where('marathon.id', $fields['marathon']);
            $this->db->join('marathonrepoid', 'marathonrepoid.marathonrepo_id  = marathon.marathonrepo_id'); 
            $this->db->order_by('problems_id', 'ASC');      
            $query =  $this->db->get();
            
            $data['marathon'] = $fields['marathon'];

            $TABLE['tbody']='';

            $TABLE['html'] ='';
            
            $CountWA=0;
            $CountCA=0; 
            $TimeL=0;
            $TimeG=0;
            $flags=TRUE;
            $wrong=0;
            $TABLE['tbody']='';

            $TABLE['html'] ='<th>#</th>
                             <th>Team</th>
                             <th>Score</th>
                             <th>Time</th>';

            $SQL=  "SELECT
                       teams_id,
                       teams.name,
                       SUM(SCORE)AS FINALSCORE,
                       SUM(TIME) AS FINALTIME
                    FROM(
                        (SELECT 
                            marathonreceived.teams_id,
                            marathonreceived.marathon_id,
                            COALESCE(SUM(case when marathonreceived.answer_id  = 3 then 1 else 0 end),0) as SCORE,
                            COALESCE(SUM(case when marathonreceived.answer_id  = 3 then ((EXTRACT(EPOCH FROM marathonreceived.time) - EXTRACT(EPOCH FROM marathon.date))/60)
                                      when ((marathonreceived.answer_id != 3)and(marathonreceived.answer_id != 0)and(marathonreceived.answer_id != 10)) then marathon.penalty else 0 end),0) as TIME
                        FROM 
                            marathonreceived
                        JOIN 
                            marathon ON marathon.id = marathonreceived.marathon_id 
                        WHERE
                            marathonreceived.marathon_id = ".$this->db->escape($data['marathon'])." 
                        GROUP BY
                            marathonreceived.teams_id,
                            marathonreceived.marathon_id)

                    UNION ALL

                        (SELECT 
                            teamsallowed.teams_id,
                            teamsallowed.marathon_id,
                            0 AS SCORE,
                            0 as TIME
                         FROM 
                            teamsallowed
                         WHERE
                            teamsallowed.marathon_id = ".$this->db->escape($data['marathon'])."
                         GROUP BY
                            teamsallowed.teams_id,
                            teamsallowed.marathon_id)) LEADERBOARD
                    JOIN 
                        teams ON teams.id = teams_id
                    GROUP BY
                        teams_id,
                        teams.name
                            
                    ORDER BY
                       FINALSCORE DESC,
                       FINALTIME  ASC";


            $Teams = $this->db->query($SQL);                

            foreach ($Teams->result_array() as $key=>$Teamsrow)
            {
                $data['teams_id'] = $Teamsrow['teams_id'];

                $TABLE['tbody'] .='<tr>
                                        <td><button type="button" '.((($key+1)==1) ? "class='btn btn-warning m-r-sm'": ((($key+1)==2) ? "class='btn btn-info m-r-sm'": ((($key+1)==3) ? "class='btn btn-success m-r-sm'": "class='btn btn-default m-r-sm"))).'>'.($key+1).'</button></td>
                                        <td>'.$Teamsrow['name'].'</td>
                                        <td>'.$Teamsrow['finalscore'].'</td>
                                        <td>'.round($Teamsrow['finaltime'],1).'</td>';

                foreach ($query->result_array() as $key=>$row)
                {
                    $data['problem'] = $row['problems_id'];

                    if($flags)
                    {
                        $TABLE['html'] .='<th>'.$row['problems_id'].'</th>';
                    }

                    if($this->get_CountCorrectAnswer($data) > 0)
                    {
                        $CountCA += 1;
                        $TimeL = $this->get_TimeCorrectAnswer($data);

                    }

                    $wrong=$this->get_CountWrongtAnswer($data);
                    if($wrong > 0)
                    {
                        $TimeL += ($wrong * $row['penalty']);
                    }

                    $TABLE['tbody'].='<td '.(($CountCA>0 && $wrong==0) ? "style='background: #117661; color: #fff;'": ($CountCA>0 ? "style='background: #1ab394; color: #fff;'": ($wrong > 0 ? "style='background: #ed5565; color: #fff;'": ""))).'>'.($CountCA+$wrong).'/'.$TimeL.'</td>';
                    $CountCA=0;
                    $TimeL=0;
                    $wrong=0;
                }

                $flags = FALSE;
                $TABLE['tbody'].='</tr>';

            }


            if ($this->isInFreezeTime($data))
            {
                if($this->getRole() != 0)
                {
                    $session_data = array(
                                        'Leaderboard'   => $TABLE                                
                                    );

                     $this->session->set_userdata($session_data);
                }
            }
            else
            {
                $session_data = array(
                                        'Leaderboard'   => $TABLE                                
                                    );

                $this->session->set_userdata($session_data);
            }
            
  
        }
        
        //SET JURY CLARIFICATION
        public function JuryClarification($fields)
        {

            $this->db->select('id');
            $this->db->from('jury');
            $this->db->where('jury.users_id', $this->session->userdata('users_id'));
            $this->db->where('jury.marathon_id', $fields['marathon']);
            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {

                $data = array(
                            'teams_id'    => $fields['team'],
                            'jury_id'     => $row['id'],
                            'marathon_id' => $fields['marathon'],
                            'text'        => $fields['text'],
                            'problems_id' => $fields['problem']
                        );

                
            }

            $this->db->set('time', 'NOW()');
            $this->db->insert('juryclarification', $data);
            return $this->db->affected_rows() > 0;
        }

        
        //SET JURY CLARIFICATION
        public function UserClarification($fields)
        {

            $data = array(
                        'teams_id'    => $this->session->userdata('teams_id'),
                        'marathon_id' => $fields['marathon'],
                        'text'        => $fields['text'],
                        'problems_id' => $fields['problem']
                    );

            $this->db->set('time', 'NOW()');
            $this->db->insert('userclarification', $data);
            return $this->db->affected_rows() > 0;
        }

        //SET RECEIVED VERIFIED
        public function set_Verified($fields)
        {

            $this->db->select('id');
            $this->db->from('jury');
            $this->db->where('jury.users_id', $this->session->userdata('users_id'));
            $this->db->where('jury.marathon_id', $fields['marathon']);

            $query =  $this->db->get();
            $row = $query->row_array();

            $data = array(
                                'verified' => $fields['verified'],
                                'jury_id' => $row['id']
                        );

            $this->db->where('id',$fields['received']);
            $this->db->update('marathonreceived', $data);
            return $this->db->affected_rows() > 0;
        }


        

        //REJUDGE ALL MARATHON
        public function ReJudgeMarathon($fields)
        {

            $this->db->select('id');
            $this->db->from('marathonreceived');
            $this->db->where('marathonreceived.marathon_id', $fields['marathon']);
            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $this->db->where('marathonreceived_id', $row['id']);
                
                if(!($fields['all']))
                {
                    $this->db->where('answer_id !=', 3);
                }

                $this->db->delete('marathoncases');
            }

            $data = array(
                                'answer_id'=> 0,
                                'verified' => FALSE,
                                'jury_id'  => NULL
                        );

            $this->db->where('marathon_id',$fields['marathon']);

            if(!($fields['all']))
            {
                $this->db->where('answer_id !=', 3);
                $this->db->where('answer_id !=', 0);
            }
            $this->db->update('marathonreceived', $data);

            return $this->db->affected_rows() > 0;
        }


        
        //REJUDGE PROBLEM - MARATHON
        public function ReJudgeProblem($fields)
        {

            $this->db->select('id');
            $this->db->from('marathonreceived');
            $this->db->where('problems_id',$fields['problem']);
            $this->db->where('marathon_id', $fields['marathon']);
            $query =  $this->db->get();

            foreach ($query->result_array() as $row)
            {
                $this->db->where('marathonreceived_id', $row['id']);
                
                if(!($fields['all']))
                {
                    $this->db->where('answer_id !=', 3);
                }

                $this->db->delete('marathoncases');
            }

            $data = array(
                                'answer_id'=> 0,
                                'verified' => FALSE,
                                'jury_id'  => NULL
                        );

            $this->db->where('marathon_id',$fields['marathon']);
            $this->db->where('problems_id',$fields['problem']);

            if(!($fields['all']))
            {
                $this->db->where('answer_id !=', 3);
                $this->db->where('answer_id !=', 0);
            }
            $this->db->update('marathonreceived', $data);

            return $this->db->affected_rows() > 0;
        }

        //REJUDGE SUBMISSION - PROBLEM - MARATHON
        public function ReJudgeSubmission($fields)
        {

            $this->db->where('marathonreceived_id', $fields['received']);
                
            $this->db->delete('marathoncases');


            $data = array(
                                'answer_id'=> 0,
                                'verified' => FALSE,
                                'jury_id'  => NULL
                        );

            $this->db->where('id',$fields['received']);

            $this->db->update('marathonreceived', $data);

            return $this->db->affected_rows() > 0;
        }


        


    }

?>