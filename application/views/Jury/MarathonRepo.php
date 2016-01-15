             <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Marathon_Problems"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Jury"); ?></a>
                        </li>
                        <li>
                            <a><?php echo $this->lang->line("Marathon"); ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $this->lang->line("Marathon_Problems"); ?></strong>
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
                        <h5><?php echo $problems['0']['marathon_name']; ?> - <?php echo $problems['0']['repository_name']; ?></h5>
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
                        <th>
                            <button class="btn btn-outline btn-warning " type="button" onclick="leaderboard(<?php echo $problems['0']['marathon_id']; ?>)" data-toggle="modal" data-target="#leaderboard" data-target="#"><i class="fa fa-cubes"></i><?php echo $this->lang->line("leaderboard"); ?></button>
                            <button onclick="$('#marathonid').val(<?php echo $problems['0']['marathon_id']; ?>);$('#Claid').text(<?php echo $problems['0']['marathon_id']; ?>);$('#Clamarathon').text('<?php echo  $problems['0']['name']; ?>');" type="button" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#rejudge"><i class="fa fa-legal"></i><?php echo $this->lang->line("ReJudge"); ?></button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach( (array)$problems as $row ): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['level']; ?></td>
                            <td><?php echo $row['keyword']; ?></td>
                            <td>
                                <button class="btn btn-outline btn-info " type="button" onclick="fill(<?php echo $row['id']; ?>)" data-toggle="modal" data-target="#openProblem"><i class="fa fa-paste"></i><?php echo $this->lang->line("Open"); ?></button>
                                                               
                                <button class="btn btn-outline btn-primary " type="button" 
                                        onclick="$('#marathonJudge').val(<?php echo $problems['0']['marathon_id']; ?>);
                                                 $('#problemJudge').val('<?php echo $row['id']; ?>');
                                                 $('#idJudge').text('<?php echo $row['id']; ?>');
                                                 $('#nameJudge').text('<?php echo $row['name']; ?>');" 
                                        data-toggle="modal" data-target="#openJudge"><i class="fa fa-legal"></i>&nbsp;&nbsp;<span class="bold"></i><?php echo $this->lang->line("Judge"); ?></span></button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th><?php echo $this->lang->line("Name"); ?></th>
                                <th><?php echo $this->lang->line("Level"); ?> +</th>
                                <th><?php echo $this->lang->line("Keyword"); ?></th>
                                <th>
                                    <button class="btn btn-outline btn-warning " type="button" onclick="leaderboard(<?php echo $problems['0']['marathon_id']; ?>)" data-toggle="modal" data-target="#leaderboard" data-target="#"><i class="fa fa-cubes"></i><?php echo $this->lang->line("leaderboard"); ?></button>
                                    <button onclick="$('#marathonid').val(<?php echo $problems['0']['marathon_id']; ?>);$('#Claid').text(<?php echo $problems['0']['marathon_id']; ?>);$('#Clamarathon').text('<?php echo  $problems['0']['name']; ?>');" type="button" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#rejudge"><i class="fa fa-legal"></i><?php echo $this->lang->line("ReJudge"); ?></button>
                                </th>
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
            
            <div class="modal inmodal fade" id="solve" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div id="modal-content" class="modal-content">
                        <div class="ibox-title">
                        <h5><?php echo $this->lang->line("Marathon"); ?>: <?php echo $problems['0']['marathon_name']; ?> - <i id="name"></i></h5>
                            <div class="ibox-tools">
                                <a class="close-link">
                                    <i class="fa fa-times" data-dismiss="modal"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div class="ibox-content">
                            <?php echo form_open('team/MarathonSolve', 'method="POST" class="dropzone" id="myAwesomeDropzone"');?>
                                <input id="marathon" name="marathon" value="" type="hidden">
                                <input id="problem"  name="problem"  value="" type="hidden">
                            </form>  
                        </div>
                    </div>
                </div>  
            </div>
            <div class="modal inmodal fade" id="leaderboard" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line("leaderboard"); ?>: <?php echo $problems['0']['marathon_name']; ?></h5>
                        <div class="ibox-tools">
                            <a class="close-link">
                                <i class="fa fa-times" data-dismiss="modal"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-striped table-bordered table-hover dataTables-leaderboard" >
                            <thead>
                                <tr id="thead">
                                    
                                  
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                    <div id="modal-leaderboard" class="modal-content">
                        
                    </div>
                </div>
            </div>
            <div class="modal inmodal fade" id="openJudge" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title"><?php echo $this->lang->line("Judge"); ?> <?php echo $this->lang->line("Problem"); ?></h4>
                        </div>
                        <div class="modal-body">
                            <p><strong><?php echo $this->lang->line("You_select_problem"); ?>:</strong></p>
                            <p><strong>Id: <b id="idJudge"></b></strong></p>
                            <p><strong><?php echo $this->lang->line("Name"); ?>: <b id="nameJudge"></b></strong></p>
                        </div>
                        <?php echo form_open('Jury/JudgeList', 'method="POST" class="form-horizontal"');?>
                            <div class="modal-footer">
                                <input id="marathonJudge" name="marathonJudge" value="" type="hidden">
                                <button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $this->lang->line("Close"); ?></button>
                                <button type="submit" id="problemJudge" name="problemJudge" value="" class="btn btn-outline btn-primary "><?php echo $this->lang->line("Judge"); ?></button>
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
                            <h4 class="modal-title"><?php echo $this->lang->line("ReJudge"); ?> Marathon</h4>
                        </div>
                        <div class="modal-body">
                            <p><strong><?php echo $this->lang->line("Marathon"); ?>:</strong></p>
                            <p><strong>Id: <b id="Claid"></b></strong></p>
                            <p><strong><?php echo $this->lang->line("Name"); ?>: <b id="Clamarathon"></b></strong></p>
                            <p><strong><?php echo $this->lang->line("Pending_correct"); ?>?<input type="checkbox" class="js-switch js-check-change" data-switchery="true" style="display: none;"></strong></p>
                        </div>
                        <?php echo form_open('Jury/Marathon', 'method="POST" class="form-horizontal"');?>
                            <div class="modal-footer">
                                <input id="all" name="all" value="" type="hidden">
                                <button type="button" class="btn btn-white" data-dismiss="modal"><?php echo $this->lang->line("Close"); ?></button>
                                <button type="submit" id="marathonid" name="marathon" value="" class="btn btn-primary"><?php echo $this->lang->line("ReJudge"); ?></button>
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



