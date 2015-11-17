<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>JO+ | <?php echo $this->lang->line("Register"); ?></title>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated flipInX">
        <div>
            <div>

                <h1 class="logo-name">JO+</h1>

            </div>
            <h3><?php echo $this->lang->line("Register_to_JO"); ?></h3>
            <?php if(isset($error)) ?><p><?php echo $error;?></p>
            <?php echo form_open('controller/register', 'id="form"'); ?>
                <div class="form-group">
                    <input type="text" id="name" name="name" class="form-control" placeholder="<?php echo $this->lang->line("Name"); ?>" required="">
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" class="form-control" placeholder="<?php echo $this->lang->line("Email"); ?>" required="">
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" autocomplete="off" class="form-control" placeholder="<?php echo $this->lang->line("password"); ?>" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b"><?php echo $this->lang->line("Register"); ?></button>

                <p class="text-muted text-center"><small><?php echo $this->lang->line("Already_have_an_account"); ?></small></p>
                <a class="btn btn-sm btn-white btn-block" href="<?php echo site_url('controller/login'); ?>"><?php echo $this->lang->line("login"); ?></a>
            </form>
            <p class="m-t"> <small><?php echo $this->lang->line("Judge_Online"); ?> &copy; 2015</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <?php if($this->session->userdata('site_lang') == 'Spanish') : ?> <script src="<?php echo base_url(); ?>assets/js/plugins/validate/Spanish_messages.js"></script> <?php endif ?>
    <script src="<?php echo base_url(); ?>assets/js/plugins/validate/jquery.validate.min.js"></script>
    <script>
         $(document).ready(function(){

             $("#form").validate({
                 rules: {
                     name: {
                         required: true,
                         minlength: 5
                     },
                     password: {
                         required: true,
                         minlength: 8
                     },
                     email: {
                         required: true,
                         email: true
                     }
                 }
             });
        });
    </script>


</body>

</html>
