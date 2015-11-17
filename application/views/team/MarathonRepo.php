             <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $this->lang->line("Marathon_Problems"); ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a><?php echo $this->lang->line("Team"); ?></a>
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
                            <button class="btn btn-outline btn-primary " type="button" onclick="leaderboard(<?php echo $problems['0']['marathon_id']; ?>)" data-toggle="modal" data-target="#clarification" data-target="#"><i class="fa fa-cubes"></i><?php echo $this->lang->line("Clarification"); ?></button>
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
                                <button class="btn btn-outline btn-success " type="button" 
                                        onclick="$('#marathon').val(<?php echo $row['marathon_id']; ?>);
                                                 $('#problem').val(<?php echo $row['id']; ?>);
                                                 $('#name').text('<?php echo 'Problem:'.$row['id']; ?>');" 
                                        data-toggle="modal" data-target="#solve"><i class="fa fa-upload"></i>&nbsp;&nbsp;<span class="bold"><?php echo $this->lang->line("Solve"); ?></span></button>

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
                                    <button class="btn btn-outline btn-primary " type="button" onclick="leaderboard(<?php echo $problems['0']['marathon_id']; ?>)" data-toggle="modal" data-target="#clarification" data-target="#"><i class="fa fa-cubes"></i><?php echo $this->lang->line("Clarification"); ?></button>
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
            <div class="modal inmodal fade" id="clarification" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="ibox-title">
                        <h5><?php echo $this->lang->line("Problem"); ?>: <i id="room"></i></h5>
                        <input id="idroom" value="" type="hidden">
                        <input id="idmarathon" value="<?php echo $id; ?>" type="hidden">

                        <div class="ibox-tools">
                            <a class="close-link">
                                <i class="fa fa-times" data-dismiss="modal"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-9 ">
                                <div id="chat" class="chat-discussion">

                                </div>
                            </div>
                            <div class="col-md-3">      
                                <div class="chat-users">
                                    <div class="users-list">
                                    <div class="chat-user">
                                            <div class="chat-user-name">
                                                <a href="#" onclick="Fill(0,<?php echo $id; ?>);$('#room').text('All');$('#idroom').val(0);$('#send').attr('disabled' , true);"><?php echo $this->lang->line("All"); ?></a>
                                            </div>
                                        </div>
                                    <?php foreach( (array)$problem as $row ): ?>
                                        <div class="chat-user">
                                            <div class="chat-user-name">
                                                <a href="#" onclick="Fill(<?php echo $row['id']; ?>,<?php echo $id; ?>);$('#room').text('<?php echo $row['name']; ?>');$('#idroom').val(<?php echo $row['id']; ?>);$('#send').attr('disabled' , false);"><?php echo $row['name']; ?></a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="chat-message-form">
                                    <div class="form-group">
                                        <textarea class="form-control message-input" id="message" name="message" placeholder="<?php echo $this->lang->line("Enter_message"); ?>"></textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="col-md-12">
                                    <button class="btn btn-primary  dim btn-large-dim btn-outline" id="send" disabled type="button"><i class="fa fa-send-o"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="modal-leaderboard" class="modal-content">
                        
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



