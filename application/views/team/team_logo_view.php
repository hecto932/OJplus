            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Custom_Logo"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Team"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("Admin_Team"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("Custom_Logo"); ?></strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title  back-change">
                        <h5><?php echo $this->lang->line("Custom_Logo"); ?></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><?php echo $this->lang->line("Picture"); ?></h4>
                                <div  class="image-crop img-preview-md">
                                    <img class="team" src="<?php echo $this->process->getTeamLogo(); ?>">
                                </div>
                                <p>
                                    <?php echo $this->lang->line("Move_image"); ?>
                                </p>
                                <div class="btn-group">
                                    <label title="Upload image file" for="inputImage" class="btn btn-primary"><input type="file" accept="image/*" name="file" id="inputImage" class="hide"><?php echo $this->lang->line("Upload"); ?> <?php echo $this->lang->line("Image"); ?></label>
                                    <label id="download" class="btn btn-primary"><?php echo $this->lang->line("Set"); ?></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4><?php echo $this->lang->line("Preview_New_Picture"); ?></h4>
                                <div class="img-preview img-preview-md"></div>
                                <p>
                                    <?php echo $this->lang->line("Functions"); ?>
                                </p>
                                <div class="btn-group">
                                    <button class="btn btn-white" id="zoomIn" type="button"><?php echo $this->lang->line("Zoom_In"); ?></button>
                                    <button class="btn btn-white" id="zoomOut" type="button"><?php echo $this->lang->line("Zoom_Out"); ?></button>
                                    <button class="btn btn-white" id="rotateLeft" type="button"><?php echo $this->lang->line("Rotate_Left"); ?></button>
                                    <button class="btn btn-white" id="rotateRight" type="button"><?php echo $this->lang->line("Rotate_Right"); ?></button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        </div>