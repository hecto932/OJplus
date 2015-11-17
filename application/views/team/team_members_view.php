            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Members"); ?></h2>
                    <ol class="breadcrumb"> 
                        <li>
                            <a><?php echo $this->lang->line("Team"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("Admin_Team"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("Members"); ?></strong>
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
                            <h5><?php echo $this->lang->line("Members"); ?></h5>
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
                                    <div class="input-group">
                                        <input id="search" type="text" placeholder="<?php echo $this->lang->line("Name"); ?> - <?php echo $this->lang->line("Email"); ?>" onkeyup="lookup(this.value)" class="form-control input-lg">
                                        <div class="input-group-btn">
                                            <button class="btn btn-lg btn-primary" onclick="lookup(this.value)"><?php echo $this->lang->line("Search"); ?></button>
                                        </div>
                                    </div>
                                    <div id="project-list" class="project-list">
                                        <table class="table table-hover">
                                            <tbody id="show_contacts">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>


                <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line("Active_Members"); ?></h5>
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
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach( (array)$active as $row ): ?>
                                <tr>
                                    <td>1</td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td class="text-navy"><?php echo $row['level'];?></td>
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
                        <h5><?php echo $this->lang->line("Pending_Members"); ?></h5>
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

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo $this->lang->line("Name"); ?></th>
                                <th><?php echo $this->lang->line("Email"); ?></th>
                                <th><?php echo $this->lang->line("Level"); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach((array)$request as $row ): ?>
                                    <tr id="pending">
                                        <td>1</td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td class="text-navy"><?php echo $row['level']; ?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>