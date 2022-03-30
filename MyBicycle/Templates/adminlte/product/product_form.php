<div class="box box-primary">
	<form method="post" enctype="multipart/form-data">
		<div class="box-body">
			<div class="form-group">
				<input name="title" value="<?= $product->title?>" placeholder="__product_title" class="form-control" />
				<input name="post_id" value="<?= $product->post_id?>" placeholder="__post_id" class="form-control" />
			</div>
			<?foreach($keys as $key):?>
			<div class="form-group">
				
				<input type="text" name="gamekey_cost[<?=$key->id?>]" placeholder="__key_cost" class="form-control" value="<?= $key->cost;?>" />
				<input type="text" name="gamekey_value[<?=$key->id?>]" placeholder="__key_value" class="form-control" value="<?= $key->value;?>" />
				
			</div>
			<?endforeach;?>
			
			<input type="text" name="gamekey_cost[]" placeholder="__key_cost" class="form-control" />
			<input type="text" name="gamekey_value[]" placeholder="__key_value" class="form-control" />
		</div>
		<div class="box-footer"><input type="submit" class="btn btn-primary" /> </div>
	</form>
</div>