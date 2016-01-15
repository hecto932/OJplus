            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("User_Leaderboard"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Home"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("Users"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("leaderboard"); ?></strong>
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
                        <h5><?php echo $this->lang->line("User_Leaderboard"); ?></h5>
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
                        <th>#</th>
                        <th><?php echo $this->lang->line("Name"); ?></th>
                        <th><?php echo $this->lang->line("Email"); ?></th>
                        <th><?php echo $this->lang->line("Level"); ?></th>
                        <th><?php echo $this->lang->line("Next_Level"); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach( (array)$leaderboard as $key=>$row ): ?>
                        <tr>
                            <td align="center"><button type="button"  class="btn <?php if($key ==0)echo 'btn-warning'; if($key ==1)echo 'btn-info'; if($key ==2)echo 'btn-success'; if($key >2)echo 'btn-default';?> m-r-sm"><?php echo $row['position']; ?></button></td>
                            <td><a onclick="SetUserID(<?php echo $row['users_id']; ?>)"><?php echo $row['name']; ?></a></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><i class="fa fa-trophy"></i> <?php echo $row['level']; ?></td>
                            <td class="project-completion">
                                <small><?php echo $row['progress']; ?>%</small>
                                <div class="progress progress-mini">
                                    <div style="width: <?php echo $row['progress']; ?>%;" class="progress-bar"></div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line("Name"); ?></th>
                        <th><?php echo $this->lang->line("Email"); ?></th>
                        <th><?php echo $this->lang->line("Level"); ?></th>
                        <th><?php echo $this->lang->line("Next_Level"); ?></th>
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



