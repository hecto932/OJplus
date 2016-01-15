    <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Welcome"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Main"); ?></a>
                        </li>
                        <li class="active">
                            <a><?php echo $this->lang->line("Stats"); ?></a>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
    <div class="wrapper wrapper-content">
        <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Total</span>
                                <h5><?php echo $this->lang->line("Problems_Solve"); ?></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $ProblemStats['CantProblem']; ?></h1>
                                <div class="stat-percent font-bold text-info"><?php echo $ProblemStats['Percentage']; ?>%<i class="fa fa-level-up"></i></div>
                                <small><?php echo $this->lang->line("Problems"); ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Total</span>
                                <h5><?php echo $this->lang->line("Marathon_Allowed"); ?></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $marathon; ?></h1>
                                <div class="stat-percent font-bold text-success"><i class="fa fa-code"></i></div>
                                <small><?php echo $this->lang->line("Marathon"); ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">Total</span>
                                <h5><?php echo $this->lang->line("Level"); ?></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $this->session->userdata('level');?></h1>
                                <div class="stat-percent font-bold text-navy"><i class="fa fa-trophy"></i></div>
                                <small><?php echo $this->lang->line("Good_Job"); ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">Total</span>
                                <h5><?php echo $this->lang->line("Progress"); ?></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $this->session->userdata('progress');?>%</h1>
                                <div class="stat-percent font-bold text-navy"><i class="fa fa-level-up"></i></div>
                                <small><?php echo $this->lang->line("Next_Level"); ?></small>
                            </div>
                        </div>
            </div>
        </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Top 5 <?php echo $this->lang->line("Users"); ?></h5>
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
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo $this->lang->line("Name"); ?></th>
                                                <th><?php echo $this->lang->line("Email"); ?></th>
                                                <th><?php echo $this->lang->line("Level"); ?></th>
                                                <th><?php echo $this->lang->line("Progress"); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach((array)$TopUsers as $row ): ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['level']; ?></td>
                                                <td><?php echo $row['progress']; ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Top 5 <?php echo $this->lang->line("Teams"); ?></h5>
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
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo $this->lang->line("Name"); ?></th>
                                                <th><?php echo $this->lang->line("Description"); ?></th>
                                                <th><?php echo $this->lang->line("Level"); ?></th>
                                                <th><?php echo $this->lang->line("Progress"); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach((array)$TopTeam as $row ): ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['description']; ?></td>
                                                <td><?php echo $row['level']; ?></td>
                                                <td><?php echo $row['progress']; ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5><?php echo $this->lang->line("Problems_Submission"); ?></h5>
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

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th><?php echo $this->lang->line("Name"); ?></th>
                                                        <th><?php echo $this->lang->line("Level"); ?> +</th>
                                                        <th><?php echo $this->lang->line("Time"); ?></th>
                                                        <th><?php echo $this->lang->line("Answer"); ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach((array)$Submission as $row ): ?>
                                                        <tr>
                                                            <td><?php echo $row['id']; ?></td>
                                                            <td><?php echo $row['name']; ?></td>
                                                            <td><?php echo $row['level']; ?></td>
                                                            <td><?php echo $row['time'] ?></td>
                                                            <td><span class="label <?php if($row['answer'] =='CORRECT'){echo 'label-primary';}else{echo 'label-default';} ?> "><?php echo $row['answer']; ?></span></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th><?php echo $this->lang->line("Name"); ?></th>
                                                        <th><?php echo $this->lang->line("Level"); ?> +</th>
                                                        <th><?php echo $this->lang->line("Time"); ?></th>
                                                        <th><?php echo $this->lang->line("Answer"); ?></th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                </div>
        
