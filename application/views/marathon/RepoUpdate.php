             <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Update"); ?> <?php echo $this->lang->line("Repository"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Marathon"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("Repository"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("Update"); ?> <?php echo $this->lang->line("Repository"); ?></strong>
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
                            <h5><?php echo $this->lang->line("Update"); ?> <?php echo $this->lang->line("Repository"); ?></h5>
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
                                <?php echo $this->lang->line("Update"); ?> <?php echo $this->lang->line("Repository"); ?>
                            </h2>
                            <?php echo form_open('marathon/RepoEdit', 'method="POST" class="wizard-big" id="form"');?>
                                <h1><?php echo $this->lang->line("Information"); ?></h1>
                                <fieldset>
                                    <h2><?php echo $this->lang->line("Information"); ?></h2>                    
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Name"); ?> *</label>
                                                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                                                <input id="name" name="name" type="text" value="<?php echo $config['0']['name']; ?>" class="form-control required">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Description"); ?> *</label>
                                                <input id="description" name="description" value="<?php echo $config['0']['description']; ?>" type="text" class="form-control required">
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
                                    <h2><?php echo $this->lang->line("Configuration"); ?></h2>                    
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Max_Run"); ?> (Sec) *</label>
                                                <input id="maxruntime" name="maxruntime" value="<?php echo $config['0']['maxruntime']; ?>" type="text" class="form-control number required">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Max_Ram"); ?> (Mb) *</label>
                                                <input id="maxram" name="maxram" value="<?php echo $config['0']['maxram']; ?>" type="text" class="form-control number required">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Max_Output"); ?> (Mb) *</label>
                                                <input id="maxoutput" name="maxoutput" value="<?php echo $config['0']['maxoutput']; ?>" type="text" class="form-control number required">
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

                                <h1><?php echo $this->lang->line("Problem"); ?></h1>
                                <fieldset>
	                                <div id="scroll">
	                                	<table class="table table-striped table-bordered table-hover dataTables-problems" >
						                    <thead>
						                    <tr>
						                        <th>Id</th>
						                        <th><?php echo $this->lang->line("Name"); ?></th>
						                        <th><?php echo $this->lang->line("Level"); ?> +</th>
						                        <th><?php echo $this->lang->line("Keyword"); ?></th>
						                        <th><?php echo $this->lang->line("Action"); ?></th>
						                    </tr>
						                    </thead>
						                    <tbody>
						                    <?php foreach( (array)$problems as $row ): ?>
						                        <tr>
						                            <td><?php echo $row['id']; ?></td>
						                            <td><?php echo $row['name']; ?></td>
						                            <td><?php echo $row['level']; ?></td>
						                            <td><?php echo $row['keyword']; ?></td>
						                            <td><input type="checkbox" name="problems[]" value="<?php echo $row['id']; ?>" class="js-switch"<?php if (in_array($row['id'], $Oldproblems)): ?> checked <?php endif; ?>></td>
						                        </tr>
						                    <?php endforeach; ?>
						                    </tbody>
						                    <tfoot>
						                    <tr>
						                        <th>Id</th>
						                        <th><?php echo $this->lang->line("Name"); ?></th>
                                                <th><?php echo $this->lang->line("Level"); ?> +</th>
                                                <th><?php echo $this->lang->line("Keyword"); ?></th>
                                                <th><?php echo $this->lang->line("Action"); ?></th>
						                    </tr>
						                    </tfoot>
						                    </table>
	                                </div>
                                </fieldset>

                                <h1><?php echo $this->lang->line("Language"); ?></h1>
                                <fieldset>
                                <h2><?php echo $this->lang->line("Allow_Language"); ?></h2>
                                    <div id="scroll2">
                                        <table class="table table-striped table-bordered table-hover dataTables-languages" >
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th><?php echo $this->lang->line("Name"); ?></th>
                                                <th><?php echo $this->lang->line("Action"); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach( (array)$languages as $row ): ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><input type="checkbox" name="languages[]" value="<?php echo $row['id']; ?>" class="js-switch" <?php if (in_array($row['id'], $Oldlanguages)): ?> checked <?php endif; ?>></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th><?php echo $this->lang->line("Name"); ?></th>
                                                <th><?php echo $this->lang->line("Action"); ?></th>
                                            </tr>
                                            </tfoot>
                                            </table>
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

