<div class="box">
            
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>__order_id</th>
        
        <th>__action</th>
        
      </tr>
      </thead>
      <tbody>
      <?while($ord = $order->next() ):?>
      <tr>
      <td><a href="order/update/<?=$ord->id?>/"><?= $ord->id?></a></td>
      
      <td class="btn-group">
        <a href="order/update/<?=$ord->id?>/" class="btn bg-purple"><i class="fa fa-edit"></i></a>
        <a href="order/delete/<?=$ord->id?>/" class="btn bg-maroon"><i class="fa fa-remove"></i></a>
      </td>
      </tr>
      <?endwhile;?>
      </tbody>
      <tfoot>
      <tr>
        <th>__order_id</th>
        <th>__action</th>
      </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>