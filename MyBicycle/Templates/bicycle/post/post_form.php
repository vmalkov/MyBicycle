<form method="post">
<div><input name="title" value="<?= $title?>" /></div>
<div><textarea name="text"><?= $text?></textarea></div>
<div>
	
	<select name="category_id">
		<?foreach($categories as $c):?>
		<option value="<?= $c->id?>"<?if($category==$c):?> selected<?endif;?>><?= $c->title;?></option>
		<?endforeach;?>
		
	</select>
</div>
<div><input type="submit" /> </div>
</form>