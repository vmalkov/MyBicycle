<div class="box box-primary">
	<form method="post">
		<div class="box-body">
			<div class="form-group">
				<input type="text" name="title" value="<?= $category->title;?>" class="form-control" placeholder="__category_title" />
			</div>
			<div class="form-group">

				<select name="category_id" class="form-control">
					<option value="0">-__parent_category-</option>
					<?foreach($parents as $parent):if($parent==$category) continue;?>
					<option value="<?= $parent->id?>"<?if($parent==$category->category):?> selected<?endif;?>><?= $parent->title;?></option>
					<?endforeach;?>
					
				</select>
				
			</div>
		</div>
		<div class="box-footer"><input type="submit" class="btn btn-primary" /></div>
	</form>
</div>