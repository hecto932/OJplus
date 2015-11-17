            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("New_Problem"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Problems"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("New"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("New_Problem"); ?></strong>
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
                            <h5><?php echo $this->lang->line("New_Problem"); ?></h5>
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
                            <?php echo form_open('user/problem_new_check', 'method="POST" class="wizard-big" id="form"');?>
                                <h1>Name</h1>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Name"); ?> *</label>
                                                <input id="name" name="name" type="text" placeholder="The 3n + 1 problem" class="form-control required">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Background"); ?></label>
                                                <input id="background" name="background" placeholder="Problems in Computer Science are often classified as belonging to a certain class of problems (e.g., NP, Unsolvable, Recursive)" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Keyword"); ?></label>
                                                <input id="keyword" name="keyword" placeholder="Trees, Tree traversal, Lowest common ancestor" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Level"); ?> *</label>
                                                <input id="level" name="level" placeholder="15" type="text" class="form-control required number" >
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Hide"); ?> *</label>
                                                <select class="form-control m-b role" id="hide" name="hide">
                                                        <option selected="selected" value="FALSE">False</option>
                                                        <option value="TRUE">True</option>
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
                                            <div class="the_problem summernote"></div>
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
                                            <div class="the_input summernote"></div>
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
                                            <div class="the_output summernote"></div>
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
                                            <div class="sample_input summernote"></div>
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
                                            <div class="sample_output summernote"></div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    </div>

                </div>
            </div>