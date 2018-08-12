<div class="box box-primary">
	<form method="post">
		<div class="box-body">
			<div class="form-group">
				<input type="text" name="name" value="<?= $role->name;?>" class="form-control" placeholder="__role_name" />
			</div>
			<div class="form-group">
				
					<?foreach($permissions as $permission):?>
					<div><input type="checkbox" name="permissions[]" value="<?=$permission;?>" class="" <?if(($rolePerms=json_decode($role->permissions))&&in_array($permission,$rolePerms)):?> checked<?endif;?> /> <?=$permission?></div>
					<?endforeach;?>	
				
			</div>
			
		</div>
		<div class="box-footer"><input type="submit" class="btn btn-primary" /></div>
	</form>
</div>