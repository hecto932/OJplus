    <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Server_Status"); ?></h2>
                    <ol class="breadcrumb">
                        <li class="active">
                            <a><?php echo $this->lang->line("Main"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("Admin"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("Server_Status"); ?></strong>
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
                                <span class="label label-primary pull-right">Distro</span>
                                <h5><?php echo $this->lang->line("Hostname"); ?></h5>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins" id="Hostname"></h3>
                                <div class="stat-percent font-bold text-navy"><i class="fa fa-desktop"></i></div>
                                <small><?php echo $this->lang->line("Hostname"); ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Version</span>
                                <h5><?php echo $this->lang->line("Kernel"); ?></h5>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins" id="Kernel"></h3>
                                <div class="stat-percent font-bold text-info"><i class="fa fa-terminal"></i></div>
                                <small><?php echo $this->lang->line("Kernel"); ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">Ip</span>
                                <h5><?php echo $this->lang->line("Listening_IP"); ?></h5>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins" id="ListeningIP"></h3>
                                <div class="stat-percent font-bold text-navy"><i class="fa fa-cloud"></i></div>
                                <small><?php echo $this->lang->line("Listening_IP"); ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right"><?php echo $this->lang->line("Time"); ?></span>
                                <h5><?php echo $this->lang->line("Uptime"); ?></h5>
                            </div>
                            <div class="ibox-content">
                                <h3 class="no-margins" id="Uptime"></h3>
                                <div class="stat-percent font-bold text-info"><i class="fa fa-clock-o"></i></div>
                                <small><?php echo $this->lang->line("Uptime"); ?></small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5><?php echo $this->lang->line("Memory"); ?></h5>
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
                                        <th><?php echo $this->lang->line("Type"); ?></th>
                                        <th><?php echo $this->lang->line("Usage"); ?></th>
                                        <th><?php echo $this->lang->line("Free"); ?></th>
                                        <th><?php echo $this->lang->line("Used"); ?></th>
                                        <th><?php echo $this->lang->line("Size"); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="Memory"></tr>
                                        <tr id="Swap"></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5><?php echo $this->lang->line("Network"); ?></h5>
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
                                        <th><?php echo $this->lang->line("Device"); ?></th>
                                        <th><?php echo $this->lang->line("Received"); ?></th>
                                        <th><?php echo $this->lang->line("Sent"); ?></th>
                                        <th><?php echo $this->lang->line("Err"); ?></th>
                                        <th><?php echo $this->lang->line("Drop"); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody id="Network">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5><?php echo $this->lang->line("Disk"); ?></h5>
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
                                        <th><?php echo $this->lang->line("Name"); ?></th>
                                        <th><?php echo $this->lang->line("Type"); ?></th>
                                        <th><?php echo $this->lang->line("Usage"); ?></th>
                                        <th><?php echo $this->lang->line("Free"); ?></th>
                                        <th><?php echo $this->lang->line("Used"); ?></th>
                                        <th><?php echo $this->lang->line("Size"); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody id="Disk">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        
