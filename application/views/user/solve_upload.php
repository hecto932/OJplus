        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2><?php echo $this->lang->line("File_upload"); ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a><?php echo $this->lang->line("Home"); ?></a>
                    </li>
                    <li>
                        <a><?php echo $this->lang->line("Solve"); ?></a>
                    </li>
                    <li class="active">
                        <strong><?php echo $this->lang->line("File_upload"); ?></strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line("Problem"); ?>:<?php echo $id;?></h5>
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
                        <?php echo form_open('user/do_upload', 'method="POST" class="dropzone" id="myAwesomeDropzone"');?>
                            <input id="name" name="name" value="<?php echo $id;?>" type="hidden">
                        </form>
                        <div>
                            
                        </div>

                    </div>
                </div>
            </div>
            </div>

            </div>
