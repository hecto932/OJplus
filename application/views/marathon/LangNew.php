              <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Create_Language"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Marathon"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("Language"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("New"); ?></strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5><?php echo $this->lang->line("Create_Language"); ?></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <h2>
                                <?php echo $this->lang->line("Create_Language"); ?>
                            </h2>
                            <?php echo form_open('marathon/LangNew', 'method="POST" class="wizard-big" id="form"');?>
                                <h1><?php echo $this->lang->line("Name"); ?></h1>
                                <fieldset>
                                    <h2><?php echo $this->lang->line("Language_Name"); ?></h2>                    
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Name"); ?> *</label>
                                                <input id="name" name="name" type="text" class="form-control required">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="text-center">
                                                <div style="margin-top: 20px">
                                                    <i class="fa fa-sign-in" style="font-size: 180px;color: #e5e5e5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <h1><?php echo $this->lang->line("Configuration"); ?></h1>
                                <fieldset>
	                                <h2><?php echo $this->lang->line("Language_Configuration"); ?></h2>
	                                 <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("How_Compile"); ?> *</label>
                                                <input id="compile" name="compile" type="text" class="form-control required">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("How_Run"); ?> *</label>
                                                <input id="run" name="run" type="text" class="form-control required">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Flags"); ?> *</label>
                                                <input id="flags" name="flags" type="text" class="form-control required">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("File"); ?> *</label>
                                                <input id="file" name="file" type="text" class="form-control required">
                                            </div>
                                        </div>
                                    </div>
	                                
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
<style>
    body.DTTT_Print {
        background: #fff;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#fff;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>

