             <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Update"); ?> <?php echo $this->lang->line("Marathon"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Marathon"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("Admin_Team"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("Update"); ?> <?php echo $this->lang->line("Marathon"); ?></strong>
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
                            <h5><?php echo $this->lang->line("Update"); ?> <?php echo $this->lang->line("Marathon"); ?></h5>
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
                                <?php echo $this->lang->line("Update"); ?> <?php echo $this->lang->line("Marathon"); ?>
                            </h2>
                            <?php echo form_open('marathon/EditMarathon', 'method="POST" class="wizard-big" id="form"');?>
                                <h1><?php echo $this->lang->line("Information"); ?></h1>
                                <fieldset>
                                    <h2><?php echo $this->lang->line("Update"); ?></h2>                    
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Name"); ?> *</label>
                                                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                                                <input id="name" name="name" type="text" value="<?php echo $config['0']['name']; ?>" class="form-control required">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Description"); ?> *</label>
                                                <input id="description" name="description" type="text" value="<?php echo $config['0']['description']; ?>" class="form-control required">
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
                                        <div class="col-lg-6">
                                            <label><?php echo $this->lang->line("Date_Start"); ?> *</label>
                                            <div class="input-group date timePicker" id="startTime">
                                                <input type='text' name="date" placeholder="<?php echo $config['0']['date'] ?>" value="<?php echo $config['0']['date']; ?>" class="form-control"/>
                                                <span class="input-group-addon"><span class="fa fa-calendar"></span> 
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Marathon_Duration"); ?>(Min) *</label>
                                                <input id="duration" name="duration" value="<?php echo $config['0']['duration']; ?>" type="text" class="form-control number required">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Start_freeze"); ?> (Min) *</label>
                                                <input id="startfreeze" name="startfreeze" value="<?php echo $config['0']['startfreeze']; ?>" placeholder="20" type="text" class="form-control number required">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Auto_Start"); ?> *</label>
                                                <select class="form-control m-b role" name="autostart">
                                                        <option <?php if($config['0']['autostart']=='f'){ echo "selected='selected'"; } ?>value="FALSE">Manual</option>
                                                        <option <?php if($config['0']['autostart']=='t'){ echo "selected='selected'"; } ?> value="TRUE">Auto</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Show_answer"); ?> *</label>
                                                <input id="timeshowanswer" name="timeshowanswer" type="text" value="<?php echo $config['0']['timeshowanswer']; ?>" class="form-control number required">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("Penalty_Wrong_Answer"); ?>(Min) *</label>
                                                <input id="penalty" name="penalty" value="<?php echo $config['0']['penalty']; ?>" type="text" class="form-control number required">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line("End_freeze"); ?> (Min) *</label>
                                                <input id="endfreeze" name="endfreeze"  value="<?php echo $config['0']['endfreeze']; ?>" placeholder="20" type="text" class="form-control number required">
                                            </div> 
                                             
                                        </div>                                           
                                    </div>
                                </fieldset>

                                <h1><?php echo $this->lang->line("Repository"); ?></h1>
                                <fieldset>
	                                <div id="scroll">
	                                	<table class="table table-striped table-bordered table-hover dataTables-repository" >
						                    <thead>
						                    <tr>
						                        <th>Id</th>
						                        <th><?php echo $this->lang->line("Name"); ?></th>
                                                <th><?php echo $this->lang->line("Description"); ?></th>
                                                <th><?php echo $this->lang->line("Max_Run"); ?></th>
                                                <th><?php echo $this->lang->line("Max_Ram"); ?></th>
                                                <th><?php echo $this->lang->line("Max_Output"); ?></th>
                                                <th><?php echo $this->lang->line("Action"); ?></th>
						                    </tr>
						                    </thead>
						                    <tbody>
						                    <?php foreach( (array)$repository as $row ): ?>
						                        <tr>
						                            <td><?php echo $row['id']; ?></td>
						                            <td><?php echo $row['name']; ?></td>
						                            <td><?php echo $row['description']; ?></td>
						                            <td><?php echo $row['maxruntime']; ?></td>
                                                    <td><?php echo $row['maxram']; ?></td>
                                                    <td><?php echo $row['maxoutput']; ?></td>
                                                    <td><div class="form-control radio i-checks"><input type="radio" name="repository" value="<?php echo $row['id']; ?>" required></div></td>	             
						                        </tr>
						                    <?php endforeach; ?>
						                    </tbody>
						                    <tfoot>
						                    <tr>
						                        <th>Id</th>
                                                <th><?php echo $this->lang->line("Name"); ?></th>
                                                <th><?php echo $this->lang->line("Description"); ?></th>
                                                <th><?php echo $this->lang->line("Max_Run"); ?></th>
                                                <th><?php echo $this->lang->line("Max_Ram"); ?></th>
                                                <th><?php echo $this->lang->line("Max_Output"); ?></th>
                                                <th><?php echo $this->lang->line("Action"); ?></th>
						                    </tr>
						                    </tfoot>
						                    </table>
	                                </div>
                                </fieldset>

                                <h1><?php echo $this->lang->line("Allowed_Teams"); ?></h1>
                                <fieldset>
                                <h2><?php echo $this->lang->line("Allowed_Teams"); ?></h2>
                                    <div id="scroll2">
                                        <table class="table table-striped table-bordered table-hover dataTables-teams" >
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th><?php echo $this->lang->line("Name"); ?></th>
                                                <th><?php echo $this->lang->line("Description"); ?></th>
                                                <th><?php echo $this->lang->line("Action"); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach( (array)$teams as $row ): ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['description']; ?></td>
                                                    <td><input type="checkbox" name="teams[]" value="<?php echo $row['id']; ?>" <?php if (in_array($row['id'], $Oldteams)): ?> checked <?php endif; ?> class="js-switch"></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th><?php echo $this->lang->line("Name"); ?></th>
                                                <th><?php echo $this->lang->line("Description"); ?></th>
                                                <th><?php echo $this->lang->line("Action"); ?></th>
                                            </tr>
                                            </tfoot>
                                            </table>
                                    </div>
                                </fieldset>

                                <h1><?php echo $this->lang->line("Jury"); ?></h1>
                                <fieldset>
                                <h2><?php echo $this->lang->line("Allow_Jury"); ?></h2>
                                    <div id="scroll2">
                                        <table class="table table-striped table-bordered table-hover dataTables-jury" >
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th><?php echo $this->lang->line("Name"); ?></th>
                                                <th><?php echo $this->lang->line("Email"); ?></th>
                                                <th><?php echo $this->lang->line("Action"); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach( (array)$jury as $row ): ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><input type="checkbox" name="jury[]" value="<?php echo $row['id']; ?>" <?php if (in_array($row['id'], $Oldjury)): ?> checked <?php endif; ?> class="js-switch"></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th><?php echo $this->lang->line("Name"); ?></th>
                                                <th><?php echo $this->lang->line("Email"); ?></th>
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

