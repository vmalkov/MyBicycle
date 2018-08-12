<div class="box box-primary">
	<form method="post">
		<div class="box-body">
			<div class="form-group">
				<input type="text" name="email" value="<?= $user->email;?>" class="form-control" placeholder="__email" />
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="__password" />
			</div>
			<div class="form-group">
				<input type="password" name="password2" class="form-control" placeholder="__password2">
			</div>

			<div class="form-group">

				<?foreach($roles as $role):?>
				<div><input type="checkbox" name="role_id[]" value="<?=$role->id?>" <?if(in_array($role->id,$user->getRoles())):?>checked<?endif;?> /> __<?=$role->name?></div>
				<?endforeach;?>
				
			</div>
		</div>
		<div class="box-footer"><input type="submit" class="btn btn-primary" /></div>
	</form>
</div>