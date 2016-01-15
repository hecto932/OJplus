    <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Welcome"); ?></h2>
                    <ol class="breadcrumb">
                        <li class="active">
                            <a><?php echo $this->lang->line("Main"); ?></a>
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
                                <h5><?php echo $this->lang->line("Users"); ?></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $TotalUsers ?></h1>
                                <div class="stat-percent font-bold text-info"><i class="fa fa-users"></i></div>
                                <small><?php echo $this->lang->line("Users"); ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Total</span>
                                <h5><?php echo $this->lang->line("Teams"); ?></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $TotalTeams; ?></h1>
                                <div class="stat-percent font-bold text-info"><i class="fa fa-shield"></i></div>
                                <small><?php echo $this->lang->line("Teams"); ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">Total</span>
                                <h5><?php echo $this->lang->line("Problems"); ?></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $TotalProblems; ?></h1>
                                <div class="stat-percent font-bold text-navy"><i class="fa fa-list"></i></div>
                                <small><?php echo $this->lang->line("Problems"); ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">Total</span>
                                <h5><?php echo $this->lang->line("Repositories"); ?></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo $TotalRepositories; ?></h1>
                                <div class="stat-percent font-bold text-navy"><i class="fa fa-outdent"></i></div>
                                <small><?php echo $this->lang->line("Repositories"); ?></small>
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
                                        <h5><?php echo $this->lang->line("Top_5_Users"); ?></h5>
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
                                        <h5><?php echo $this->lang->line("Top_5_Team"); ?></h5>
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
                                        <h5><?php echo $this->lang->line("Submission"); ?></h5>
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
                                                        <th><?php echo $this->lang->line("Email"); ?></th>
                                                        <th><?php echo $this->lang->line("Problem"); ?></th>
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
                                                            <td><?php echo $row['email']; ?></td>
                                                            <td><?php echo $row['problem']; ?></td>
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
                                                        <th><?php echo $this->lang->line("Email"); ?></th>
                                                        <th><?php echo $this->lang->line("Problem"); ?></th>
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