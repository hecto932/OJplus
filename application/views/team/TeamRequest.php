             <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Pending_Requests"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Team"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("Pending"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("Pending_Requests"); ?></strong>
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
                        <h5><?php echo $this->lang->line("Pending_Requests"); ?></h5>
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
                        <th><?php echo $this->lang->line("Team_Name"); ?></th>
                        <th><?php echo $this->lang->line("Description"); ?></th>
                        <th><?php echo $this->lang->line("Level"); ?></th>
                        <th><?php echo $this->lang->line("Progress"); ?></th>
                        <th><?php echo $this->lang->line("Time"); ?></th>
                        <th><?php echo $this->lang->line("Action"); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach((array)$request as $row ): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['level']; ?></td>
                            <td><?php echo $row['progress'] ?></td>
                            <td><?php echo $row['time']; ?></td>
                            <td><button class="btn btn-outline btn-primary joinBtn"   type="button" onclick="$('#id').val(<?php echo $row['id']; ?>);" ><span class="bold"><?php echo $this->lang->line("Join"); ?></span></button>
                                <button class="btn btn-outline btn-danger rejectBtn" type="button" onclick="$('#id').val(<?php echo $row['id']; ?>);" ><span class="bold"><?php echo $this->lang->line("Reject"); ?></span></button></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th><?php echo $this->lang->line("Team_Name"); ?></th>
                        <th><?php echo $this->lang->line("Description"); ?></th>
                        <th><?php echo $this->lang->line("Level"); ?></th>
                        <th><?php echo $this->lang->line("Progress"); ?></th>
                        <th><?php echo $this->lang->line("Time"); ?></th>
                        <th><?php echo $this->lang->line("Action"); ?></th>
                    </tr>
                    </tfoot>
                    </table>

                    </div>
                </div>
            </div>
            </div>
            <div class="modal inmodal fade" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <?php echo form_open('team/TeamRequest', 'method="POST" class="form-horizontal" id="FormOpen"');?>
                            <div class="modal-footer">
                            <input id="id" name="id" value="" type="hidden">
                            <input id="join" name="join" value="" type="hidden">
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
