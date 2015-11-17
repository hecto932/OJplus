<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Judge | <?php echo $this->lang->line("Lock"); ?></title>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="lock-word animated fadeInDown">
    <span class="first-word" <?php if ($this->session->userdata('site_lang') == 'English'): ?> style="margin-right: 300px;" <?php endif ?> ><?php echo $this->lang->line("LOCKED"); ?></span><span><?php echo $this->lang->line("SCREEN"); ?></span>
</div>
    <div class="middle-box text-center lockscreen animated flipInX">
        <div>
            <div class="m-b-md">
            <img alt="image" class="img-circle circle-border" style="height: 90px; width: 90px;" src="<?php echo $this->session->userdata('picture');?>">
            </div>
            <h3><?php echo $this->session->userdata('name');?></h3>
            <?php if(isset($error)) ?><p><?php echo $error;?></p>
            <?php echo form_open('controller/Unlock'); ?>
                <div class="form-group">
                    <input type="password" id="password" name="password" autocomplete="off" class="form-control" placeholder="******" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width"><?php echo $this->lang->line("Unlock"); ?></button>
                <p class="text-muted text-center"><small><?php echo $this->lang->line("Not"); ?> <?php echo $this->session->userdata('name');?>?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="<?php echo site_url('controller/logout'); ?>"><?php echo $this->lang->line("Log_out"); ?></a>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

</body>

</html>

