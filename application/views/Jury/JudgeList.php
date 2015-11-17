             <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Verified_Problem"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Jury"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("Judge"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("Verified_Problem"); ?></strong>
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
                        <h5><?php echo $this->lang->line("Verified_Problem"); ?>: <?php echo $received[0]['problems_id']; ?></h5>
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
                        <th>Id</th>
                        <th><?php echo $this->lang->line("Verified_Problem"); ?></th>
                        <th><?php echo $this->lang->line("Marathon"); ?></th>
                        <th><?php echo $this->lang->line("Team"); ?></th>
                        <th><?php echo $this->lang->line("Answer"); ?></th>
                        <th><?php echo $this->lang->line("Time"); ?></th>
                        <th><?php echo $this->lang->line("File_Name"); ?></th>
                        <th><?php echo $this->lang->line("Verify"); ?></th>
                        <th><?php echo $this->lang->line("by_judge"); ?></th>
                        <th><button onclick="$('#marathon').val(<?php echo $received[0]['marathon_id']; ?>);$('#problem').val(<?php echo $received[0]['problems_id']; ?>);$('#Claid').text(<?php echo $received[0]['problems_id']; ?>);$('#Clamarathon').text('<?php echo $received[0]['problems_name']; ?>');" type="button" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#rejudge"><i class="fa fa-legal"></i>ReJudge</button></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach((array)$received as $row ): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['problems_name']; ?></td>
                            <td><?php echo $row['marathon_name']; ?></td>
                            <td><?php echo $row['teams_id']; ?></td>
                            <td><?php echo $row['answer'] ?></td>
                            <td><?php echo $row['time']; ?></td>
                            <td><?php echo $row['filename'] ?></td>
                            <td><?php if($row['verified']=='f'){ echo 'FALSE';}else{echo 'TRUE';} ?></td>
                            <td><?php echo $row['jury_id']; ?></td>
                            <td><button class="btn btn-outline btn-primary openBtn" id="open" type="button" 
                                        onclick="$('#id').val(<?php echo $row['id']; ?>);" ><span class="bold">Open</span></button></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th><?php echo $this->lang->line("Verified_Problem"); ?></th>
                        <th><?php echo $this->lang->line("Problem"); ?></th>
                        <th><?php echo $this->lang->line("Team"); ?></th>
                        <th><?php echo $this->lang->line("Answer"); ?></th>
                        <th><?php echo $this->lang->line("Time"); ?></th>
                        <th><?php echo $this->lang->line("File_Name"); ?></th>
                        <th><?php echo $this->lang->line("Verify"); ?></th>
                        <th><?php echo $this->lang->line("by_judge"); ?></th>
                        <th><button onclick="$('#marathon').val(<?php echo $received[0]['marathon_id']; ?>);$('#problem').val(<?php echo $received[0]['problems_id']; ?>);$('#Claid').text(<?php echo $received[0]['problems_id']; ?>);$('#Clamarathon').text('<?php echo $received[0]['problems_name']; ?>');" type="button" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#rejudge"><i class="fa fa-legal"></i>ReJudge</button></th>
                    </tr>
                    </tfoot>
                    </table>

                    </div>
                </div>
            </div>
            </div>
            <div class="modal inmodal fade" id="openJudge" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line("Close"); ?></span></button>
                        </div>
                        <div class="modal-body">
                        </div>
                        <?php echo form_open('Jury/JudgeProblem', 'method="POST" class="form-horizontal" id="FormOpen"');?>
                            <div class="modal-footer">
                                <input id="id" name="id" value="" type="hidden">
                                <button type="submit" class="btn btn-outline btn-primary"><?php echo $this->lang->line("Open"); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal inmodal fade" id="rejudge" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line("Close"); ?></span></button>
                            <h4 class="modal-title">ReJudge Problem</h4>
                        </div>
                        <div class="modal-body">
                            <p><strong><?php echo $this->lang->line("Problem"); ?>:</strong></p>
                            <p><strong>Id: <b id="Claid"></b></strong></p>
                            <p><strong><?php echo $this->lang->line("Name"); ?>: <b id="Clamarathon"></b></strong></p>
                            <p><strong><?php echo $this->lang->line("Pending_correct"); ?>?<input type="checkbox" class="js-switch js-check-change" data-switchery="true" style="display: none;"></strong></p>
                        </div>
                        <?php echo form_open('Jury/JudgeList', 'method="POST" class="form-horizontal"');?>
                            <div class="modal-footer">
                                <input id="all" name="all" value="" type="hidden">
                                <input id="problem" name="problem" value="" type="hidden">
                                <button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $this->lang->line("Close"); ?></button>
                                <button type="submit" id="marathon" name="marathon" value="" class="btn btn-primary"><?php echo $this->lang->line("ReJudge"); ?></button>
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
