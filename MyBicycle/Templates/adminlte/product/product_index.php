<div class="box">
            
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>__product_id</th>
        <th>__product_title</th>
        <th>__post_title</th>
        <th>__action</th>
        
      </tr>
      </thead>
      <tbody>
      <?while($prd = $product->next() ):?>
      <tr>
      <td><?= $prd->id?></td>
      <td><a href="product/update/<?=$prd->id?>/"><?= $prd->title?></a></td>
      <td><a href="post/update/<?=$prd->post->id?>/"><?= $prd->post->title?></a></td>
      <td class="btn-group">
        <a href="product/update/<?=$prd->id?>/" class="btn bg-purple"><i class="fa fa-edit"></i></a>
        <a href="product/delete/<?=$prd->id?>/" class="btn bg-maroon"><i class="fa fa-remove"></i></a>
      </td>
      </tr>
      <?endwhile;?>
      </tbody>
      <tfoot>
      <tr>
        <th>__product_id</th>
        <th>__product_title</th>
        <th>__post_title</th>
        <th>__action</th>
      </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>