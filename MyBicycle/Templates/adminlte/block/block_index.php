<div class="box">
            
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>__block_id</th>
        <th>__block_name</th>
        <th>__block_controller</th>
        <th>__block_template</th>
        <th>__block_position</th>
        <th>__action</th>
        
      </tr>
      </thead>
      <tbody>
      <?while($blk = $block->next()):?>
      <tr>
      <td><?= $blk->id?></td>
      <td><a href="block/update/<?=$blk->id?>/"><?= $blk->name?></a></td>
      <td><?=$blk->controller;?></td>
      <td><?=$blk->template;?></td>
      <td><?=$blk->position;?></td>
      <td class="btn-group">
        <a href="block/update/<?=$blk->id?>/" class="btn bg-purple"><i class="fa fa-edit"></i></a>
        <a href="block/delete/<?=$blk->id?>/" class="btn bg-maroon"><i class="fa fa-remove"></i></a>
      </td>
      </tr>
      <?endwhile;?>
      </tbody>
      <tfoot>
      <tr>
        <th>__block_id</th>
        <th>__block_name</th>
        <th>__block_controller</th>
        <th>__block_template</th>
        <th>__block_position</th>
        <th>__action</th>
      </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>