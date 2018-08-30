<div class="box box-primary">
	<form method="post" enctype="multipart/form-data">
		<div class="box-body">
			<div class="form-group">
				<input name="title" value="<?= $product->title?>" placeholder="__product_title" class="form-control" />
			</div>
			<div>
				<input type="text" name="price" placeholder="__product_price" class="form-control" value="<?= $product->price;?>" />
			</div>
		</div>
		<div class="box-footer"><input type="submit" class="btn btn-primary" /> </div>
	</form>
</div>