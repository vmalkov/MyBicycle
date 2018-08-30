<div class="box box-primary">
	<form method="post" enctype="multipart/form-data">
		<div class="box-body">
			<div class="form-group">
				<input name="title" value="<?= $post->title?>" placeholder="__post_title" class="form-control" />
			</div>
			<div class="form-group"><textarea style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;" name="text" placeholder="__post_text"><?= $post->text?></textarea></div>
			<div class="form-group">
	
				<select name="category_id" class="form-control">
					<option value="">__post_category</option>
					<?foreach($categories as $c):?>
					<option value="<?= $c->id?>"<?if($post->category==$c):?> selected<?endif;?>><?= $c->title;?></option>
					<?endforeach;?>
					
				</select>
			</div>
			<div class="form-group">
				<div class="row">
				<div class="col-sm-4">
				<label><input type="radio" name="status" value="0" <?if(!$post->status):?>checked<?endif;?>/>__off</label>
				<label><input type="radio" name="status" value="1" <?if($post->status):?>checked<?endif;?>/>__on</label>
				</div>
				<div class="col-sm-6">
				<label>__post_image</label>
				<?if($post->image):?>
				<img width="100" src="../uploads/post/<?=$post->image;?>" />
				<input type="checkbox" name="deleteImage" value="1" /> Удалить
				<?endif;?>
				<input type="file" name="image" />
				</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
				<div class="input-group-addon">
	            	<i class="fa fa-calendar"></i>
	            </div>
				<input type="text" name="date" class="form-control" value="<?= $post->date?>" />
				</div>
			</div>
			<div class="form-group">
	
				<select name="user_id" class="form-control">
					<option value="">__post_user</option>
					<?foreach($users as $u):?>
					<option value="<?= $u->id?>"<?if($post->user==$u):?> selected<?endif;?>><?= $u->email;?></option>
					<?endforeach;?>
					
				</select>
			</div>
		</div>
		<div class="box-footer"><input type="submit" class="btn btn-primary" /> </div>
	</form>
</div>
<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>


<script src="bower_components/moment/min/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
  $(function () {
    $("[name=date]").datetimepicker({format:"YYYY-MM-DD HH:mm:ss",locale:'ru'});
  })
</script>