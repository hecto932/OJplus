<div class="footer">
            <div>
                <strong><?php echo $this->lang->line("Judge_Online"); ?></strong> &copy; 2015-2016
            </div>
        </div>

    </div>
</div>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-2.1.1.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/inspinia.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/plugins/pace/pace.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/plugins/toastr/toastr.min.js"></script>
<?php if(isset($includes_for_layout['js']) AND count($includes_for_layout['js']) > 0): ?>
	<?php foreach($includes_for_layout['js'] as $js): ?>
		<?php if($js['options'] === NULL OR $js['options'] == 'footer'): ?>
			<script type="text/javascript" src="<?php echo $js['file']; ?>"></script>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
</body>
</html>
