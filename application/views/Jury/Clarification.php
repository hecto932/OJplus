<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $this->lang->line("Clarification"); ?></h2>
        <ol class="breadcrumb">
            <li>
                <a><?php echo $this->lang->line("Jury"); ?></a>
            </li>
            <li>
                <a><?php echo $this->lang->line("Marathon"); ?></a>
            </li>
            <li class="active">
                <strong><?php echo $this->lang->line("Clarification"); ?></strong>
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
                <div class="ibox-content">
                    <strong><?php echo $this->lang->line("Clarification"); ?></strong>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">

                <div class="ibox chat-view">

                    <div class="ibox-title">
                         <?php echo $this->lang->line("Clarification"); ?> <?php echo $this->lang->line("Team"); ?>: <i id="room"></i>
                         <input id="idroom" value="" type="hidden">
                         <input id="idmarathon" value="<?php echo $id; ?>" type="hidden">
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
                                            <img class="chat-avatar" src="<?=base_url();?>assets/img/badge/3.png" alt="" >
                                            <div class="chat-user-name">
                                                <a href="#" onclick="Fill(0,<?php echo $id; ?>);$('#room').text('All');$('#idroom').val(0);$('#send').attr('disabled' , false);"><?php echo $this->lang->line("All"); ?></a>
                                            </div>
                                        </div>
                                    <?php foreach( (array)$teams as $row ): ?>
                                        <div class="chat-user">
                                            <img class="chat-avatar" src="<?php echo $row['logo']; ?>" alt="" >
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
                                        <textarea class="form-control message-input" id="message" name="message" placeholder="Enter message text"></textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="col-md-12">
                                    <select id="problem" class="form-control m-b role" name="autostart" >
                                    <option selected value="0"><?php echo $this->lang->line("General_issue"); ?></option>
                                    <?php foreach( (array)$problems as $row ): ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?>:<?php echo $row['name']; ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                    <button type="button" disabled id="send" class="btn btn-primary"><?php echo $this->lang->line("SEND"); ?></button>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
        </div>

    </div>


</div>
