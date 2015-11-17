            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Edit_Team"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Home"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("Admin_Team"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("Edit_Team"); ?></strong>
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
                        <div class="ibox-title">
                            <h5><?php echo $this->lang->line("Edit_Team"); ?></h5>
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
                            <?php echo form_open('team/team_edit_check', 'method="POST" class="form-horizontal"');?>
                                <div class="form-group"><label class="col-sm-2 control-label"><?php echo $this->lang->line("Name"); ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="name" value="<?php echo $team['0']['name']; ?>"></div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label"><?php echo $this->lang->line("Description"); ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="description" value="<?php echo $team['0']['description']; ?>"> </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-danger"  type="button" data-toggle="modal" data-target="#myModal6"><?php echo $this->lang->line("Deleted_Team"); ?></button>
                                        <button class="btn btn-primary" type="submit"><?php echo $this->lang->line("Save"); ?> <?php echo $this->lang->line("Changes"); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line("Close"); ?></span></button>
                            <h4 class="modal-title"><?php echo $this->lang->line("Deleted_Team"); ?></h4>
                        </div>
                        <div class="modal-body">
                            <p><strong><?php echo $this->lang->line("Are_you_sure"); ?> <?php echo $this->lang->line("Deleted_Team"); ?> <?php echo $team['0']['name']; ?>?</strong></p>
                        </div>
                        <?php echo form_open('team/team_deleted', 'method="POST" class="form-horizontal"');?>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $this->lang->line("Close"); ?></button>
                                <button type="submit" name="deleted" value="true" class="btn btn-danger"><?php echo $this->lang->line("Deleted"); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>