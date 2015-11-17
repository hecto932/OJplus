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
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
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
                            <td><button onclick="$('#edit').val(<?php echo $row['id']; ?>);$('#id').text(<?php echo $row['id']; ?>);$('#problem').text('<?php echo $row['name']; ?>');" type="button" class="btn btn-outline btn-warning" data-toggle="modal" data-target="#editProblem">Edit</button></td>
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
                </div>
            </div>
            </div>
            <div class="modal inmodal fade" id="editProblem" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line("Close"); ?></span></button>
                            <h4 class="modal-title"><?php echo $this->lang->line("Are_you_sure"); ?> <?php echo $this->lang->line("problem"); ?></h4>
                        </div>
                        <div class="modal-body">
                            <p><strong><?php echo $this->lang->line("Edit"); ?><?php echo $this->lang->line("Edit"); ?> <?php echo $this->lang->line("problem"); ?>:</strong></p>
                            <p><strong>Id: <b id="id"></b></strong></p>
                            <p><strong><?php echo $this->lang->line("Name"); ?>: <b id="problem"></b></strong></p>
                        </div>
                        <?php echo form_open('user/problem_edit_view', 'method="POST" class="form-horizontal"');?>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $this->lang->line("Close"); ?></button>
                                <button type="submit" id="edit" name="edit" value="" class="btn btn-warning"><?php echo $this->lang->line("Edit"); ?></button>
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
