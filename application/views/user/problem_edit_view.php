            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Problem_Edit"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Problems"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("Edit"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("Problem_Edit"); ?></strong>
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
                            <h5><?php echo $this->lang->line("Problem_Edit"); ?></h5>
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
                            <?php echo form_open('user/problem_edit_check', 'method="POST" class="wizard-big" id="form"');?>
                                <h1><?php echo $this->lang->line("Information"); ?></h1>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-8">
                                        <?php foreach( $problems as $row ): ?>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Name"); ?> *</label>
                                                <input id="id" name="id" value="<?php echo $row['id']; ?>" type="hidden">
                                                <input id="name" name="name" type="text" value="<?php echo $row['name']; ?>" class="form-control required">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Background"); ?></label>
                                                <input id="background" name="background" value="<?php echo $row['background']; ?>" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Keyword"); ?></label>
                                                <input id="keyword" name="keyword" value="<?php echo $row['keyword']; ?>" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Level"); ?> *</label>
                                                <input id="level" name="level" value="<?php echo $row['level']; ?>" type="text" class="form-control required number" >
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Hide"); ?> *</label>
                                                <select class="form-control m-b role" id="hide" name="hide">
                                                        <option <?php if( $row['hide'] == 'f'): ?> selected="selected" <?php endif; ?> value="FALSE">False</option>
                                                        <option <?php if( $row['hide'] == 't'): ?>  selected="selected" <?php endif; ?> value="TRUE">True</option>

                                                </select>
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
                                <h1><?php echo $this->lang->line("The_Problem"); ?></h1>
                                <fieldset>
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5><?php echo $this->lang->line("The_Problem"); ?></h5>
                                        </div>
                                        <div class="ibox-content no-padding">
                                            <input id="the_problem" name="the_problem" value="" type="hidden">
                                            <div class="the_problem summernote">
                                            	<?php echo $row['description']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <h1><?php echo $this->lang->line("The_Input"); ?></h1>
                                <fieldset>
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5><?php echo $this->lang->line("The_Input"); ?></h5>
                                        </div>
                                        <div class="ibox-content no-padding">
                                            <input id="the_input" name="the_input" value="" type="hidden">
                                            <div class="the_input summernote">
                                            	<?php echo $row['inputformat']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <h1><?php echo $this->lang->line("The_Output"); ?></h1>
                                <fieldset>
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5><?php echo $this->lang->line("The_Output"); ?></h5>
                                        </div>
                                        <div class="ibox-content no-padding">
                                            <input id="the_output" name="the_output" value="" type="hidden">
                                            <div class="the_output summernote">
                                            	<?php echo $row['outputformat']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <h1><?php echo $this->lang->line("Sample_Input"); ?></h1>
                                <fieldset>
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5><?php echo $this->lang->line("Sample_Input"); ?></h5>
                                        </div>
                                        <div class="ibox-content no-padding">
                                            <input id="sample_input" name="sample_input" value="" type="hidden">
                                            <div class="sample_input summernote">
                                            	<?php echo $row['inputcase']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <h1><?php echo $this->lang->line("Sample_Output"); ?></h1>
                                <fieldset>
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5><?php echo $this->lang->line("Sample_Output"); ?></h5>
                                        </div>
                                        <div class="ibox-content no-padding">
                                            <input id="sample_output" name="sample_output" value="" type="hidden">
                                            <div class="sample_output summernote">
                                            	<?php echo $row['outputcase']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <?php endforeach; ?>
                            </form>
                        </div>
                    </div>
                    </div>

                </div>
            </div>