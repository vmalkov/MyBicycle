<div class="box">
            
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>__post_id</th>
        <th>__post_title</th>
        <th>__post_category</th>
        <th>__action</th>
        
      </tr>
      </thead>
      <tbody>
      <?while($pst = $post->next() ):?>
      <tr>
      <td><?= $pst->id?></td>
      <td><a href="post/update/<?=$pst->id?>/"><?= $pst->title?></a></td>
      <td><a href="category/update/<?=$pst->category->id?>/"><?= $pst->category->title?></a></td>
      
      <td class="btn-group">
        <a href="post/update/<?=$pst->id?>/" class="btn bg-purple"><i class="fa fa-edit"></i></a>
        <a href="post/delete/<?=$pst->id?>/" class="btn bg-maroon"><i class="fa fa-remove"></i></a>
      </td>
      </tr>
      <?endwhile;?>
      </tbody>
      <tfoot>
      <tr>
        <th>__post_id</th>
        <th>__post_title</th>
        <th>__post_category</th>
        <th>__action</th>
      </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>