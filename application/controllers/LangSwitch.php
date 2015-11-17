<?php
class LangSwitch extends MY_Controller
{
    public function __construct() 
    {
        parent::__construct();
        
    }
 
    function switchLanguage($language = "") 
    {
        $language = ($language != "") ? $language : "English";
        $this->session->set_userdata('site_lang', $language);
        redirect('controller/index');
    }

    function switchLanguageLogin($language = "") 
    {
        $language = ($language != "") ? $language : "English";
        $this->session->set_userdata('site_lang', $language);
       
        redirect($this->login());
    }

}