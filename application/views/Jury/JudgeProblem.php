             <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Diff_Problem"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Jury"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("Diff"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("Diff_Problem"); ?></strong>
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
                            <h5><?php echo $this->lang->line("Contest_Options"); ?></small></h5>
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
                            <div class="text-center">
                                <label><?php echo $this->lang->line("Verified"); ?></label>
                                <input type="checkbox" class="js-switch js-check-change" <?php if ($JudgeProblem[0]['verified'] === 't'): ?> checked <?php endif ?> disable data-switchery="true" style="display: none;">
                                <div class="col-md-3">
                                    <div class="form-group">   
                                        <label><?php echo $this->lang->line("Received"); ?> Id: <?php echo $JudgeProblem[0]['marathonreceived']; ?></label>
                                        <input id="id" value="<?php echo $JudgeProblem[0]['marathonreceived']; ?>" type="hidden">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group"> 
                                        <label><?php echo $this->lang->line("Problem"); ?>: <?php echo $JudgeProblem[0]['problems_id']; ?></label>
                                        <input id="problem" value="<?php echo $JudgeProblem[0]['problems_id']; ?>" type="hidden">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                       <label><?php echo $this->lang->line("Marathon"); ?>: <?php echo $JudgeProblem[0]['marathon']; ?></label>
                                       <input id="marathon" value="<?php echo $JudgeProblem[0]['marathon']; ?>" type="hidden">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line("Diff_Problem"); ?></h5>
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
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th><?php echo $this->lang->line("Problem"); ?></th>
                        <th><?php echo $this->lang->line("Test_Case"); ?> id</th>
                        <th><?php echo $this->lang->line("Test_Case_name"); ?></th>
                        <th><?php echo $this->lang->line("Case_md5"); ?></th>
                        <th><?php echo $this->lang->line("Team_md5"); ?></th>
                        <th><?php echo $this->lang->line("Team_Case_name"); ?></th>
                        <th><?php echo $this->lang->line("Answer"); ?></th>
                        <th><button onclick="$('#marathonid').val(<?php echo $JudgeProblem[0]['marathon']; ?>);$('#received').val(<?php echo $JudgeProblem[0]['marathonreceived']; ?>);$('#Claid').text(<?php echo $JudgeProblem[0]['marathonreceived']; ?>);$('#Clamarathon').text(<?php echo $JudgeProblem[0]['marathon']; ?>);" type="button" class="btn btn-outline btn-primary" data-toggle="modal" <?php if ($JudgeProblem[0]['marathon'] != ""): ?> data-target="#rejudge" <?php endif ?><i class="fa fa-legal"></i><?php echo $this->lang->line("ReJudge"); ?></button></th>
                    </tr>
                    </thead>                        
                    <tbody>
                    <?php foreach( (array)$JudgeProblem as $row ): ?>
                        <tr>
                            <td><?php echo $row['problems_id']; ?></td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['filename']; ?></td>
                            <td><?php echo $row['md5']; ?></td>
                            <td><?php echo $row['md5submit']; ?></td>
                            <td><?php echo $row['filenamesubmit']; ?></td>
                            <td><?php echo $row['answer']; ?></td>
                            <td>
                                <button class="btn btn-outline btn-danger open" onclick="GetText(<?php echo $row['marathon']; ?>,<?php echo $row['team']; ?>,<?php echo $row['problems_id']; ?>,'<?php echo $row['filename']; ?>','<?php echo $row['filenamesubmit']; ?>');" type="button" data-toggle="modal" data-target="#openDiff"><span class="bold"><?php echo $this->lang->line("Diff"); ?></span></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                        <tfoot>
                            <tr>
                                <th><?php echo $this->lang->line("Problem"); ?></th>
                                <th><?php echo $this->lang->line("Test_Case"); ?> id</th>
                                <th><?php echo $this->lang->line("Test_Case_name"); ?></th>
                                <th><?php echo $this->lang->line("Case_md5"); ?></th>
                                <th><?php echo $this->lang->line("Team_md5"); ?></th>
                                <th><?php echo $this->lang->line("Team_Case_name"); ?></th>
                                <th><?php echo $this->lang->line("Answer"); ?></th>
                                <th><button onclick="$('#marathonid').val(<?php echo $JudgeProblem[0]['marathon']; ?>);$('#received').val(<?php echo $JudgeProblem[0]['marathonreceived']; ?>);$('#Claid').text(<?php echo $JudgeProblem[0]['marathonreceived']; ?>);$('#Clamarathon').text(<?php echo $JudgeProblem[0]['marathon']; ?>);" type="button" class="btn btn-outline btn-primary" data-toggle="modal" <?php if ($JudgeProblem[0]['marathon'] != ""): ?> data-target="#rejudge" <?php endif ?><i class="fa fa-legal"></i><?php echo $this->lang->line("ReJudge"); ?></button></th>
                            </tr>
                        </tfoot>
                    </table>

                    </div>
                </div>
            </div>
            </div>
            <div class="modal inmodal fade" id="openDiff" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title"><?php echo $this->lang->line("Diff"); ?></h4>
                        </div>
                        <div class="modal-body">

                            <div class="row diff-wrapper2">
                                <div class="col-md-4">
                                    <h4><?php echo $this->lang->line("Output_Name"); ?></h4>
                                    <textarea class="form-control diff-textarea" id="original" rows="6"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <h4><?php echo $this->lang->line("Diff"); ?></h4>
                                    <div class="diff2"></div>
                                </div>
                                <div class="col-md-4">
                                    <h4><?php echo $this->lang->line("Team_Output"); ?></h4>
                                    <textarea class="form-control diff-textarea" id="changed" rows="6"></textarea>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $this->lang->line("Close"); ?></button>
                            <button type="button" id="diff" class="btn btn-danger" ><?php echo $this->lang->line("Diff"); ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal inmodal fade" id="rejudge" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title"><?php echo $this->lang->line("ReJudge"); ?> <?php echo $this->lang->line("Submission"); ?></h4>
                        </div>
                        <div class="modal-body">
                            <p><strong><?php echo $this->lang->line("Submission"); ?>:</strong></p>
                            <p><strong>Id: <b id="Claid"></b></strong></p>
                            <p><strong><?php echo $this->lang->line("Marathon"); ?>: <b id="Clamarathon"></b></strong></p>
                        </div>
                        <?php echo form_open('Jury/JudgeProblem', 'method="POST" class="form-horizontal"');?>
                            <div class="modal-footer">
                                <input id="received" name="received" value="" type="hidden">
                                <button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $this->lang->line("Close"); ?></button>
                                <button type="submit" id="marathonid" name="marathon" value="" class="btn btn-primary"><?php echo $this->lang->line("ReJudge"); ?></button>
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



