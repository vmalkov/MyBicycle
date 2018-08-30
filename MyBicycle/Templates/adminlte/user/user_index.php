<div class="box">
            
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>__user_id</th>
        <th>__user_email</th>
        <th>__user_roles</th>
        <th>__action</th>
        
      </tr>
      </thead>
      <tbody>
      <?foreach($user as $usr):?>
      <tr>
      <td><?= $usr->id?></td>
      <td><a href="user/update/<?=$usr->id?>/"><?= $usr->email?></a></td>
      <td><?= implode(',' ,array_map(function($r){return $r->name;},$usr->sharedRoleList));?></td>
      <td class="btn-group">
        <a href="user/update/<?=$usr->id?>/" class="btn bg-purple"><i class="fa fa-edit"></i></a>
        <a href="user/delete/<?=$usr->id?>/" class="btn bg-maroon"><i class="fa fa-remove"></i></a>
      </td>
      </tr>
      <?endforeach;?>
      </tbody>
      <tfoot>
      <tr>
        <th>__user_id</th>
        <th>__user_email</th>
        <th>__user_roles</th>
        <th>__action</th>
      </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>