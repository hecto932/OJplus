<!DOCTYPE html> 
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo $title_for_layout; ?></title>

    <link href="<?=base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" >
    <link href="<?=base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" >
    <link href="<?=base_url();?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet" >
    <link href="<?=base_url();?>assets/css/animate.css" rel="stylesheet" >
    <link href="<?=base_url();?>assets/css/style.css" rel="stylesheet" >
	
	<?php if(isset($includes_for_layout['css']) AND count($includes_for_layout['css']) > 0): ?>
		<?php foreach($includes_for_layout['css'] as $css): ?>
			<link href="<?php echo $css['file']; ?>" rel="stylesheet" >
		<?php endforeach; ?>
	<?php endif; ?>
	
	<?php if(isset($includes_for_layout['js']) AND count($includes_for_layout['js']) > 0): ?>
		<?php foreach($includes_for_layout['js'] as $js): ?>
			<?php if($js['options'] !== NULL AND $js['options'] == 'header'): ?>
				<script type="text/javascript" src="<?php echo $js['file']; ?>"></script>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
	
</head>
<body class="fixed-sidebar">

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> 
                        <span>
                            <img id="picture" alt="image" class="img-circle-dash" src="<?php echo $this->session->userdata('picture');?>"/>
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> 
                                <span class="block m-t-xs"> 
                                    <strong class="font-bold"><?php echo $this->session->userdata('name');?></strong>
                                </span> 
                                <span class="text-muted text-xs block"><?php echo $this->session->userdata('country');?>
                                    <b class="caret"></b>
                                </span>
                            </span> 
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="#" onclick="SetUserID(<?php echo $this->session->userdata('users_id');?>)"><?php echo $this->lang->line("Profile"); ?></a></li>
                            <li><a href="<?php echo site_url('user/leaderboard'); ?>"><?php echo $this->lang->line("leaderboard"); ?></a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url('controller/lock'); ?>"><?php echo $this->lang->line("Lockscreen"); ?></a></li>
                        </ul>
                        <input type="hidden" name="<?= $name; ?>" value="<?= $hash; ?>" />
                    </div>
                    <div class="logo-element">
                        JO+
                    </div>
                </li>
                <li <?php  if ( $url=$this->uri->segment(2)=='index' ): ?> class="active" <?php endif; ?>>
                    <a href="<?php echo site_url('controller/index'); ?>"><i class="fa fa-home"></i> <span class="nav-label"><?php echo $this->lang->line("Main"); ?></span></a>
                </li>

                <li <?php if ( $_SERVER['REQUEST_URI'] == base_url().'user/problem_list' ): ?> class="active" <?php endif; ?>>
                    <a href="<?php echo site_url('user/problem_list'); ?>"><i class="fa fa-list"></i> <span class="nav-label"><?php echo $this->lang->line("Problems_List"); ?></span></a>
                </li>
                <?php if($this->process->CheckRole(0) || $this->process->CheckRole(2) || $this->process->CheckRole(3)) : ?>
                <li <?php $url=$this->uri->segment(2); if ( ($url=='problem_new')||($url=='problem_edit') || ($url=='problem_deleted')||($url=='AddCases') ||($url=='AdminCases') ): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-cloud-upload"></i> <span class="nav-label"><?php echo $this->lang->line("Problems"); ?></span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo site_url('user/problem_new'); ?>"><?php echo $this->lang->line("New"); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('user/problem_edit'); ?>"><?php echo $this->lang->line("Edit"); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('user/problem_deleted'); ?>"><?php echo $this->lang->line("Deleted"); ?></a>
                        </li>
                        <li <?php $url=$this->uri->segment(2); if ( ($url=='AddCases')||($url=='AdminCases')): ?> class="active" <?php endif; ?>>
                            <a href="#"><?php echo $this->lang->line("Test_Cases"); ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="<?php echo site_url('admin/AddCases'); ?>"><?php echo $this->lang->line("Add"); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('admin/AdminCases'); ?>"><?php echo $this->lang->line("Deleted"); ?></a>
                                </li>
                            </ul>
                        </li>
                    </ul>   
                </li>

                <li <?php $url=$this->uri->segment(2); if ( ($url=='repository_new')||($url=='repository_list') || ($url=='repository_deleted') ): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-outdent"></i> <span class="nav-label"><?php echo $this->lang->line("Repository"); ?></span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo site_url('user/repository_new'); ?>"><?php echo $this->lang->line("New"); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('user/repository_list'); ?>"><?php echo $this->lang->line("List"); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('user/repository_deleted'); ?>"><?php echo $this->lang->line("Deleted"); ?></a>
                        </li>
                    </ul>   
                </li>
                <?php endif; ?>
                
                <li <?php $url=$this->uri->segment(2); if (($url=='team_create_view')|| ($url=='team_logo_view')||($url=='MarathonList') || ($url=='team_members_view')||(($url=$this->uri->segment(1)=='team') && $url=='leaderboard') ||($url=='team_edit_view') ||($url=='DeletedCases')||($url=='TeamRequest')): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-shield"></i> <span class="nav-label"><?php echo $this->lang->line("Team"); ?></span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php if($this->process->isInATeam()) : ?>
                            <li>
                                <a href="<?php echo site_url('team/MarathonList'); ?>"><?php echo $this->lang->line("Marathon"); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('team/leaderboard'); ?>"><?php echo $this->lang->line("leaderboard"); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(($this->process->isInATeam()) && (! $this->process->isATeamAdmin())) : ?>
                            <li>
                                <a href="<?php echo site_url('team/TeamOut'); ?>"><?php echo $this->lang->line("Leave_Team"); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if(!$this->process->isInATeam()) : ?>
                            <li>
                                <a href="<?php echo site_url('team/team_create_view'); ?>"><?php echo $this->lang->line("Create_Team"); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('team/TeamRequest'); ?>"><?php echo $this->lang->line("Pending_Requests"); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if($this->process->isATeamAdmin()) : ?>
                            <ul class="nav nav-second-level">
                                <li <?php $url=$this->uri->segment(2); if (($url=='team_members_view')|| ($url=='team_logo_view')||($url=='team_edit_view') ): ?> class="active" <?php endif; ?>>
                                    <a href="#"><?php echo $this->lang->line("Admin_Team"); ?><span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo site_url('team/team_members_view'); ?>"><?php echo $this->lang->line("Members"); ?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('team/team_logo_view'); ?>"><?php echo $this->lang->line("Custom_Logo"); ?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('team/team_edit_view'); ?>"><?php echo $this->lang->line("Edit_Team"); ?></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        <?php endif; ?>
                    </ul>   
                </li>
                <?php if($this->process->CheckRole(0) || $this->process->CheckRole(3)) : ?>
                <li <?php $url=$this->uri->segment(2); if (($url=='NewMarathon')||($url=='ListMarathon')||($url=='EditMarathon')||($url=='DeletedMarathon')||($url=='LangNew')||($url=='LangList')||($url=='LangDeleted')||
                                                           ($url=='RepoNew')||($url=='RepoList') ||($url=='RepoEdit') ||($url=='RepoDeleted')): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-code"></i> <span class="nav-label"><?php echo $this->lang->line("Marathon"); ?></span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li <?php $url=$this->uri->segment(2); if (($url=='NewMarathon')||($url=='ListMarathon')||($url=='EditMarathon')||($url=='DeletedMarathon')): ?> class="active" <?php endif; ?>>
                            <a href="#"><?php echo $this->lang->line("Admin"); ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="<?php echo site_url('marathon/NewMarathon'); ?>"><?php echo $this->lang->line("New"); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('marathon/ListMarathon'); ?>"><?php echo $this->lang->line("List"); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('marathon/EditMarathon'); ?>"><?php echo $this->lang->line("Edit"); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('marathon/DeletedMarathon'); ?>"><?php echo $this->lang->line("Deleted"); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li <?php $url=$this->uri->segment(2); if (($url=='LangNew')|| ($url=='LangList')||($url=='LangDeleted') ): ?> class="active" <?php endif; ?>>
                            <a href="#"><?php echo $this->lang->line("Language"); ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="<?php echo site_url('marathon/LangNew'); ?>"><?php echo $this->lang->line("New"); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('marathon/LangList'); ?>"><?php echo $this->lang->line("List"); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('marathon/LangDeleted'); ?>"><?php echo $this->lang->line("Deleted"); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li <?php $url=$this->uri->segment(2); if (($url=='RepoNew')|| ($url=='RepoList')|| ($url=='RepoEdit')||($url=='RepoDeleted') ): ?> class="active" <?php endif; ?>>
                            <a href="#"><?php echo $this->lang->line("Repository"); ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="<?php echo site_url('marathon/RepoNew'); ?>"><?php echo $this->lang->line("New"); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('marathon/RepoList'); ?>"><?php echo $this->lang->line("List"); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('marathon/RepoEdit'); ?>"><?php echo $this->lang->line("Edit"); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('marathon/RepoDeleted'); ?>"><?php echo $this->lang->line("Deleted"); ?></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
                <?php if($this->process->CheckRole(0) || $this->process->CheckRole(2) || $this->process->CheckRole(3)) : ?>
                <li <?php  if (($url=$this->uri->segment(2)=='Marathon')): ?> class="active" <?php endif; ?>>
                    <a href="<?php echo site_url('Jury/Marathon'); ?>"><i class="fa fa-legal"></i> <span class="nav-label"><?php echo $this->lang->line("Jury"); ?></span></a>
                </li>
                <?php endif; ?>
                <?php if($this->process->CheckRole(0)) : ?>
                <li <?php $url=$this->uri->segment(2); if (($url=='role') || ($url=='ServerStatus')): ?> class="active" <?php endif; ?>>
                    <a href="<?php echo site_url('user/role'); ?>"><i class="fa fa-lock"></i> <span class="nav-label"><?php echo $this->lang->line("Admin"); ?></span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo site_url('admin/role'); ?>"><?php echo $this->lang->line("Role"); ?></a></li>
                        <li><a href="<?php echo site_url('admin/ServerStatus'); ?>"><?php echo $this->lang->line("Server_Status"); ?></a></li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <?php echo $this->lang->line("Language"); ?>
                        </a>
                        <ul class="dropdown-menu animated fadeIn m-t-xs">
                            <li><a href="<?php echo site_url('LangSwitch/switchLanguage/English'); ?>"><?php echo $this->lang->line("English"); ?></a></li>
                            <li><a href="<?php echo site_url('LangSwitch/switchLanguage/Spanish'); ?>"><?php echo $this->lang->line("Spanish"); ?></a></li>
                            <input type="hidden" id="Lang" value="<?php echo $this->session->userdata('site_lang');?>" />
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo site_url('controller/logout'); ?>"><i class="fa fa-sign-out"></i><?php echo $this->lang->line("Log_out"); ?></a>
                    </li>
                </ul>
            </nav>
        </div>
