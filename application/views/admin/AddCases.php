        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2><?php echo $this->lang->line("Test_Case"); ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a><?php echo $this->lang->line("Problems"); ?></a>
                    </li>
                    <li>
                        <a><?php echo $this->lang->line("Test_Case"); ?></a>
                    </li>
                    <li class="active">
                        <strong><?php echo $this->lang->line("Add"); ?></strong>
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
                            <h5></h5>
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
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line("Problems"); ?>: </label>
                                            <div class="input-group">
                                                <select data-placeholder="Choose a Country..." class="chosen-select" style="width:350px;" tabindex="2" id="problem" name="problem">
                                                    <option value=""><?php echo $this->lang->line("Select"); ?></option>
                                                    <?php foreach( (array)$problems as $row ): ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label id="typename"><?php echo $this->lang->line("Type"); ?> *</label>
                                                    <select class="form-control m-b role" id="type" name="type" >  
                                                        <option value="0" selected><?php echo $this->lang->line("Input"); ?></option>
                                                        <option value="1"><?php echo $this->lang->line("Output"); ?></option>
                                                    </select>
                                                </div> 
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label id="inputname"><?php echo $this->lang->line("Input_Name"); ?> *</label>
                                                    <select type="hidden" class="form-control m-b role" id="input" id="input" name="input" >
                                                          
                                                    </select>
                                                </div> 
                                            </div>       
                                        </div>                   
                                </div>
                                <div class="col-lg-12">
                                    <?php echo form_open('admin/AddCases', 'method="POST" class="dropzone" id="myAwesomeDropzone"');?>
                                        <input id="problemid" name="problemid" value="" type="hidden">
                                        <input id="typeid"    name="typeid" value="" type="hidden">
                                        <input id="inputid"   name="inputid" value="" type="hidden">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
