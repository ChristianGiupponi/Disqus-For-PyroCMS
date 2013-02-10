<section class="title">
	<h4><?php echo lang('disqus.name'); ?></h4>
</section>

<section class="item">
	<div class="content">
	<?php echo form_open('admin/disqus/edit', 'class="crud"');?>
		<div class="tabs">
			<div class="form_inputs" id="disqus">
				<fieldset>
					<ul>
						<li id="disqus_shortname" class="">
							<label for="disqus_short_name">
								<?php echo $settings->title; ?>
								<?php if($settings->description): echo '<small>'.$settings->description.'</small>'; endif; ?>
							</label>

							<div class="input <?php echo 'type-' . $settings->type; ?>">
								<input type="text" name="disqus_short_name" value="<?php echo $settings->value; ?>" id="disqus_short_name" class="text width-20">
							</div>
							<span class="move-handle"></span>
						</li>
					</ul>
				</fieldset>
			</div>
		</div>
		<div class="buttons padding-top">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save') )); ?>
		</div>
	<?php echo form_close(); ?>
	</div>
</section>