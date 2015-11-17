<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>JO+ | <?php echo $this->lang->line("Forgot_password"); ?></title>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div>
                    <h1 class="logo-name" style="margin-left: 20%;">JO+</h1>
                </div>

                <div class="ibox-content">

                    <h2 class="font-bold"><?php echo $this->lang->line("Forgot_password"); ?></h2>

                    <p>
                        <?php echo $this->lang->line("Text_Password_Reset"); ?>
                    </p>

                    <div class="row">

                        <div class="col-lg-12">
                            <?php echo form_open('controller/ForgotPassword', 'id="form" class="m-t" role="form"'); ?>
                                <div class="form-group">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="<?php echo $this->lang->line("Email"); ?>" required="">
                                </div>

                                <button type="submit" class="btn btn-primary block full-width m-b"><?php echo $this->lang->line("Send_new_password"); ?></button>
                                <a class="btn btn-sm btn-white btn-block" href="<?php echo site_url('controller/login'); ?>"><?php echo $this->lang->line("login"); ?></a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                <?php echo $this->lang->line("Judge_Online"); ?>
            </div>
            <div class="col-md-6 text-right">
               <small>© 2015-2016</small>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.js"></script>
    <?php if($this->session->userdata('site_lang') == 'Spanish') : ?> <script src="<?php echo base_url(); ?>assets/js/plugins/validate/Spanish_messages.js"></script> <?php endif ?>
    <script src="<?php echo base_url(); ?>assets/js/plugins/validate/jquery.validate.min.js"></script>
    <script>
         $(document).ready(function(){

             $("#form").validate({
                 rules: {
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
