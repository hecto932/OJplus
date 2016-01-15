            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Problems_List"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Home"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("Problems"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("Problems_List"); ?></strong>
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
                        <h5><?php echo $this->lang->line("Problems_List"); ?></h5>
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

                    <table class="table table-striped table-bordered table-hover dataTables-example tooltip-demo" >
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th><?php echo $this->lang->line("Trophy"); ?></th>
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
                            <td>
                                <img alt="image" style="height: 40%; <?php if (empty($row['firstplaceid'])): ?> opacity: 0.25; <?php endif ?>" src="<?=base_url();?>assets/img/T1.png" onclick="SetUserID(<?php echo $row['firstplaceid']; ?>)" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row['firstplacename']; ?>">
                                <img alt="image" style="height: 40%; <?php if (empty($row['pionerid']    )): ?> opacity: 0.25; <?php endif ?>"  src="<?=base_url();?>assets/img/T2.png"     onclick="SetUserID(<?php echo $row['pionerid']; ?>)" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row['pionername']; ?>">
                            </td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['level']; ?></td>
                            <td><?php echo $row['keyword']; ?></td>
                            <td>
                                <button class="btn btn-outline btn-info " type="button" onclick="fill(<?php echo $row['id']; ?>)" data-toggle="modal" data-target="#openProblem"><i class="fa fa-paste"></i><?php echo $this->lang->line("Open"); ?></button>
                                <button class="btn btn-outline btn-success " type="button" 
                                        onclick="$('#solve').val(<?php echo $row['id']; ?>);
                                                 $('#id').text(<?php echo $row['id']; ?>);
                                                 $('#problem').text('<?php echo $row['name']; ?>');" 
                                        data-toggle="modal" data-target="#solveProblem"><i class="fa fa-upload"></i>&nbsp;&nbsp;<span class="bold"><?php echo $this->lang->line("Solve"); ?></span></button>
                                <button class="btn btn-outline btn-primary" type="button" 
                                        onclick="$('#problemID').val(<?php echo $row['id']; ?>);
                                                 $('#caseid').text(<?php echo $row['id']; ?>);
                                                 $('#caseproblem').text('<?php echo $row['name']; ?>');" value="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#TestCases"><i class="fa fa-file-zip-o"></i><?php echo $this->lang->line("Cases"); ?></button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th><?php echo $this->lang->line("Trophy"); ?></th>
                        <th><?php echo $this->lang->line("Name"); ?></th>
                        <th><?php echo $this->lang->line("Level"); ?> +</th>
                        <th><?php echo $this->lang->line("Keyword"); ?></th>
                        <th><?php echo $this->lang->line("Action"); ?></th>
                    </tr>
                    </tfoot>
                    </table>

                    </div>
                </div>
            </div>
            </div>
            <div class="modal inmodal fade" id="openProblem" tabindex="-1" role="dialog"  aria-hidden="true">
	            <div class="modal-dialog modal-lg">
	                <div id="modal-content" class="modal-content">
	                    
	                </div>
	            </div>
	        </div>
            <div class="modal inmodal fade" id="TestCases" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line("Close"); ?></span></button>
                            <h4 class="modal-title"><?php echo $this->lang->line("Problem"); ?> <?php echo $this->lang->line("Test_Case"); ?> </h4>
                        </div>
                        <div class="modal-body">
                            <p><strong><?php echo $this->lang->line("You_select_problem"); ?>:</strong></p>
                            <p><strong>Id: <b id="caseid"></b></strong></p>
                            <p><strong><?php echo $this->lang->line("Name"); ?>: <b id="caseproblem"></b></strong></p>
                        </div>
                        <?php echo form_open('user/DownloadCases', 'method="POST" class="form-horizontal"');?>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $this->lang->line("Close"); ?></button>
                                <button type="submit" id="problemID" name="problemID" value="" class="btn btn-outline btn-primary "><?php echo $this->lang->line("Download"); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal inmodal fade" id="solveProblem" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line("Close"); ?></span></button>
                            <h4 class="modal-title"><?php echo $this->lang->line("Solve_Problem"); ?></h4>
                        </div>
                        <div class="modal-body">
                            <p><strong><?php echo $this->lang->line("You_select_problem"); ?>:</strong></p>
                            <p><strong>Id: <b id="id"></b></strong></p>
                            <p><strong><?php echo $this->lang->line("Name"); ?>: <b id="problem"></b></strong></p>
                        </div>
                        <?php echo form_open('user/solve_upload', 'method="POST" class="form-horizontal"');?>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $this->lang->line("Close"); ?></button>
                                <button type="submit" id="solve" name="solve" value="" class="btn btn-outline btn-success "><?php echo $this->lang->line("Solve"); ?></button>
                            </div>
                        </form>
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



