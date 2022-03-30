<div class="box">
            
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>__role_id</th>
        <th>__role_name</th>
        
        <th>__action</th>
        
      </tr>
      </thead>
      <tbody>
      <?while($rle = $role->next()):?>
      <tr>
      <td><?= $rle->id?></td>
      <td><a href="role/update/<?=$rle->id?>/"><?= $rle->name?></a></td>
      
      <td class="btn-group">
        <a href="role/update/<?=$rle->id?>/" class="btn bg-purple"><i class="fa fa-edit"></i></a>
        <a href="role/delete/<?=$rle->id?>/" class="btn bg-maroon"><i class="fa fa-remove"></i></a>
      </td>
      </tr>
      <?endwhile;?>
      </tbody>
      <tfoot>
      <tr>
        <th>__role_id</th>
        <th>__role_name</th>

        <th>__action</th>
      </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>