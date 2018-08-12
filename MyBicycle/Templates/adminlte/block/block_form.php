<div class="box box-primary">
	
	<form method="post">
		<div class="box-body">
			<div class="form-group">
				<input type="text" name="name" value="<?= $block->name;?>" class="form-control" placeholder="__block_name" />
			</div>
			<div class="form-group">
				
					<select class="form-control" name="controller">
						<option value="">__block_controller</option>
						<?foreach($controllers as $controller):?>
						<option value="<?= $controller?>"<?if($block->controller==$controller):?> selected<?endif;?>><?= $controller?></option>
						<?endforeach;?>
					</select>
				
			</div>
			<div class="form-group">
				<input type="text" name="position" value="<?= $block->position;?>" class="form-control" placeholder="__block_position" />
			</div>
			<div class="form-group">
				<input type="radio" name="status" value="0" <?if(!$block->status):?>checked<?endif;?>/>__off
				<input type="radio" name="status" value="1" <?if($block->status):?>checked<?endif;?>/>__on
			</div>
		</div>
		<div class="box-footer"><input type="submit" class="btn btn-primary" /></div>
	</form>
</div>