             <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("List_Marathon"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Jury"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("List_Marathon"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("List_Marathon"); ?></strong>
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
                        <h5><?php echo $this->lang->line("List_Marathon"); ?></h5>
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
                        <th><?php echo $this->lang->line("Name"); ?></th>
                        <th><?php echo $this->lang->line("Description"); ?></th>
                        <th><?php echo $this->lang->line("Repo_Name"); ?></th>
                        <th><?php echo $this->lang->line("Start_Date"); ?></th>
                        <th><?php echo $this->lang->line("Duration"); ?></th>
                        <th><?php echo $this->lang->line("Penalty"); ?></th>
                        <th><?php echo $this->lang->line("Start_Freeze"); ?></th>
                        <th><?php echo $this->lang->line("End_Freeze"); ?></th>
                        <th><?php echo $this->lang->line("Time_Show"); ?></th>
                        <th><?php echo $this->lang->line("Action"); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach((array)$marathon as $row ): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['marathonrepo_name']; ?></td>
                            <td><?php echo $row['date'] ?></td>
                            <td><?php echo $row['duration']; ?></td>
                            <td><?php echo $row['penalty']; ?></td>
                            <td><?php echo $row['startfreeze']; ?></td>
                            <td><?php echo $row['endfreeze']; ?></td>
                            <td><?php echo $row['timeshowanswer']; ?></td>
                            <td>
                                <button onclick="$('#open').val(<?php echo $row['id']; ?>);$('#id').text(<?php echo $row['id']; ?>);$('#marathon').text('<?php echo $row['name']; ?>');" type="button" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#openMarathon"><?php echo $this->lang->line("Open"); ?></button>
                                <button onclick="$('#Claopen').val(<?php echo $row['id']; ?>);$('#Claid').text(<?php echo $row['id']; ?>);$('#Clamarathon').text('<?php echo $row['name']; ?>');" type="button" class="btn btn-outline btn-info" data-toggle="modal" data-target="#openClarification"><?php echo $this->lang->line("Clarification"); ?></button>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th><?php echo $this->lang->line("Name"); ?></th>
                        <th><?php echo $this->lang->line("Description"); ?></th>
                        <th><?php echo $this->lang->line("Repo_Name"); ?></th>
                        <th><?php echo $this->lang->line("Start_Date"); ?></th>
                        <th><?php echo $this->lang->line("Duration"); ?></th>
                        <th><?php echo $this->lang->line("Penalty"); ?></th>
                        <th><?php echo $this->lang->line("Start_Freeze"); ?></th>
                        <th><?php echo $this->lang->line("End_Freeze"); ?></th>
                        <th><?php echo $this->lang->line("Time_Show"); ?></th>
                        <th><?php echo $this->lang->line("Action"); ?></th>
                    </tr>
                    </tfoot>
                    </table>

                    </div>
                </div>
            </div>
            </div>
            <div class="modal inmodal fade" id="openMarathon" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line("Close"); ?></span></button>
                            <h4 class="modal-title"><?php echo $this->lang->line("Open"); ?> <?php echo $this->lang->line("Marathon"); ?></h4>
                        </div>
                        <div class="modal-body"> 
                            <p><strong><?php echo $this->lang->line("Open"); ?> <?php echo $this->lang->line("Marathon"); ?>:</strong></p>
                            <p><strong>Id: <b id="id"></b></strong></p>
                            <p><strong><?php echo $this->lang->line("Name"); ?>: <b id="marathon"></b></strong></p>
                        </div>
                        <?php echo form_open('Jury/Marathon', 'method="POST" class="form-horizontal"');?>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $this->lang->line("Close"); ?></button>
                                <button type="submit" id="open" name="open" value="" class="btn btn-primary"><?php echo $this->lang->line("Open"); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal inmodal fade" id="openClarification" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line("Close"); ?></span></button>
                            <h4 class="modal-title"><?php echo $this->lang->line("Open"); ?> <?php echo $this->lang->line("Clarification"); ?></h4>
                        </div>
                        <div class="modal-body">
                            <p><strong><?php echo $this->lang->line("Marathon"); ?>:</strong></p>
                            <p><strong>Id: <b id="Claid"></b></strong></p>
                            <p><strong><?php echo $this->lang->line("Name"); ?>: <b id="Clamarathon"></b></strong></p>
                        </div>
                        <?php echo form_open('Jury/Clarification', 'method="POST" class="form-horizontal"');?>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $this->lang->line("Close"); ?></button>
                                <button type="submit" id="Claopen" name="open" value="" class="btn btn-info"><?php echo $this->lang->line("Open"); ?></button>
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
