            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Admin_Role"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Admin"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("Role"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("Admin_Role"); ?></strong>
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
                        <h5><?php echo $this->lang->line("Admin_Role"); ?></h5>
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
                        <th><?php echo $this->lang->line("Email"); ?></th>
                        <th><?php echo $this->lang->line("Role"); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach( (array)$users as $row ): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td>
                                <select class="form-control m-b role" name="role" onchange="set(<?php echo $row['id']; ?>,this);">
                                    <?php foreach( (array)$role as $rol ): ?>
                                        <option <?php if( $row['role']==$rol['id']): ?>selected="selected" <?php endif; ?> value="<?php echo $rol['id']; ?>"><?php echo $rol['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th><?php echo $this->lang->line("Name"); ?></th>
                        <th><?php echo $this->lang->line("Email"); ?></th>
                        <th><?php echo $this->lang->line("Role"); ?></th>
                    </tr>
                    </tfoot>
                    </table>

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



