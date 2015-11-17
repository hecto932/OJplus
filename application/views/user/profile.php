            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Profile"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Home"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("Profile"); ?></strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div> 
            </div> 
        <div class="wrapper wrapper-content">
            <div class="row animated fadeInRight">
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="widget-head-color-box navy-bg p-lg text-center">
                            <div class="m-b-md">
                                <h2 class="no-margins">
                                    <?php echo $user['0']['name']; ?>
                                </h2>
                            </div>
                            <img src="<?php echo $user['0']['picture']; ?>" class="img-circle-profile circle-border m-b-md" alt="profile">
                        </div>
                        <div class="widget-text-box">
                            <h4 class="media-heading"><?php echo $user['0']['name']; ?></h4>
                            <p><?php echo $user['0']['email']; ?></p>
                        </div>
  
                    </div>     
                    <div class="col-md-6">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <i class="fa fa-trophy fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span><?php echo $this->lang->line("User_level"); ?></span>
                                    <h2 class="font-bold"><?php echo $this->session->userdata('level');?></h2>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <i class="fa fa-shield fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span><?php echo $this->lang->line("Team_level"); ?></span>
                                    <h2 class="font-bold"><?php echo $team['0']['level']; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($this->session->userdata('ProfileID') == $this->session->userdata('users_id')): ?>
                    <div class="col-md-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content" id="ibox-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4><?php echo $this->lang->line("Picture"); ?></h4>
                                        <div  class="image-crop img-preview-md">
                                            <img class="pic" src="">
                                        </div>
                                        <p>
                                           <?php echo $this->lang->line("Move_image"); ?>.
                                        </p>
                                        <div class="btn-group">
                                            <label title="Upload image file" for="inputImage" class="btn btn-primary"><input type="file" accept="image/*" name="file" id="inputImage" class="hide"><?php echo $this->lang->line("Upload"); ?></label>
                                            <label id="download" class="btn btn-primary"><?php echo $this->lang->line("Set"); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4><?php echo $this->lang->line("Upload"); ?></h4>
                                        <div class="img-preview img-preview-md"></div>
                                        <p>
                                            <?php echo $this->lang->line("Preview_New_Picture"); ?>.
                                        </p>
                                        <div class="btn-group">
                                            <button class="btn btn-white" id="zoomIn"  type="button"><?php echo $this->lang->line("Zoom_In"); ?></button>
                                            <button class="btn btn-white" id="zoomOut" type="button"><?php echo $this->lang->line("Zoom_Out"); ?></button>
                                            <button class="btn btn-white" id="rotateLeft"  type="button"><?php echo $this->lang->line("Rotate_Left"); ?></button>
                                            <button class="btn btn-white" id="rotateRight" type="button"><?php echo $this->lang->line("Rotate_Right"); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                   
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <h4><?php echo $this->lang->line("ChangePassword"); ?></h4>
                                <?php echo form_open('User/ChangePassword', 'id="ChangePassword" method="POST" class="form-horizontal"');?>
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-md-4"><input type="password" id="password"  name="password"  placeholder="<?php echo $this->lang->line("Newpassword"); ?>" class="form-control requiered"></div>
                                                <div class="col-md-4"><input type="password" id="Rpassword" name="Rpassword" placeholder="<?php echo $this->lang->line("RepeatNewPassword"); ?>" class="form-control requiered"></div>
                                                <div class="col-md-4"><button class="btn btn-primary" type="submit"><?php echo $this->lang->line("ChangePassword"); ?></button></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <div class="col-md-6" <?php if ($this->session->userdata('ProfileID') != $this->session->userdata('users_id')): ?> style="margin-bottom: 9px;" <?php endif ?>>
                    <div class="col-lg-6">
                        <div class="widget white-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-cubes fa-4x"></i>
                            <h1 class="m-xs"><?php echo $FirstPlace; ?></h1>
                            <h3 class="font-bold no-margins">
                                <?php echo $this->lang->line("1stPlace"); ?>
                            </h3>
                            <small><?php echo $this->lang->line("Problem"); ?></small>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="widget white-bg p-lg text-center">
                            <div class="m-b-md">
                                <i class="fa fa-cubes fa-4x"></i>
                                <h1 class="m-xs"><?php echo $SecondPlace; ?></h1>
                                <h3 class="font-bold no-margins">
                                    <?php echo $this->lang->line("2ndPlace"); ?>
                                </h3>
                                <small><?php echo $this->lang->line("Problem"); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-lg-6">
                        <div class="widget navy-bg p-lg text-center">
                            <div class="m-b-md">
                                <i class="fa fa-check fa-4x"></i>
                                <h1 class="m-xs"><?php echo $Correct; ?></h1>
                                <h3 class="font-bold no-margins">
                                    <?php echo $this->lang->line("Correct"); ?>
                                </h3>
                                <small><?php echo $this->lang->line("Problem"); ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="widget yellow-bg p-lg text-center">
                            <div class="m-b-md">
                                <i class="fa fa-paper-plane-o fa-4x"></i>
                                <h1 class="m-xs"><?php echo $Submission; ?></h1>
                                <h3 class="font-bold no-margins">
                                    <?php echo $this->lang->line("Submission"); ?>
                                </h3>
                                <small><?php echo $this->lang->line("Problem"); ?></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <h2 class="text-center"><?php echo $this->lang->line("Trophy"); ?></h2>
                    <div class="row tooltip-demo">
                        <div class="col-md-3 TrophyMedals" <?php if ($Trophy['FirstPlace']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/T1.png" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line("1stPlaceProblem"); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 TrophyMedals" <?php if ($Trophy['Pioner']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/T2.png" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line("Pioneer"); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 TrophyMedals" <?php if ($Trophy['Perfectionnist']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/T3.png" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line("Perfectionist"); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 TrophyMedals" <?php if ($Trophy['Crazy']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/T4.png" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line("CrazySubmissions"); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 TrophyMedals" <?php if ($Trophy['Obsessive']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/T5.png" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line("Obsessive"); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 TrophyMedals" <?php if ($Trophy['User']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/T6.png" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line("BestUser"); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 TrophyMedals" <?php if ($Trophy['Team']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/T7.png" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line("BestTeam"); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 TrophyMedals" <?php if ($Trophy['Elite']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/T8.png" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line("Elite"); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="text-center"><?php echo $this->lang->line("Medals"); ?></h2>
                    <div class="row tooltip-demo">
                        <div class="col-md-3 TrophyMedals" <?php if ($Medals['Picture']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/M1.png" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line("UpdatedProfilePicture"); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 TrophyMedals" <?php if ($Medals['Team']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/M2.png" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line("CreateorJoinaTeam"); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 TrophyMedals" <?php if ($Medals['Submission']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/M3.png" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line("1CorrectSubmission"); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 TrophyMedals" <?php if ($Medals['Marathon']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/M4.png" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line("ParticipatedinaMarathon"); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 TrophyMedals" <?php if ($Medals['WinMarathon']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/M5.png" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line("WinaMarathon"); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 TrophyMedals" <?php if ($Medals['Medals6']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/M6.png" data-toggle="tooltip" data-placement="bottom" title="5  <?php echo $this->lang->line("CorrectSubmission"); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 TrophyMedals" <?php if ($Medals['Medals7']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/M7.png" data-toggle="tooltip" data-placement="bottom" title="10 <?php echo $this->lang->line("CorrectSubmission"); ?>">
                            </div>
                        </div>
                        <div class="col-md-3 TrophyMedals" <?php if ($Medals['Medals8']): ?> style="opacity: 1;" <?php endif ?>>
                            <div class="ibox-content text-center">
                                <img alt="image" src="<?=base_url();?>assets/img/M8.png" data-toggle="tooltip" data-placement="bottom" title="50 <?php echo $this->lang->line("CorrectSubmission"); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                  
            </div>
        </div>



