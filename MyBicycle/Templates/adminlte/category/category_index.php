<div class="box">
            
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
	<tr>
		<th>__category_id</th>
		<th>__category_title</th>
		<th>__parent_category</th>
		<th>__action</th>
	</tr>
	</thead>
	<tbody>
	<?while($item=$category->next()):?>
	<tr>
		<td><?=$item->id?></td>
		<td>
			<a href="category/update/<?= $item->id?>/"><?= $item->title;?></a></td>
		<td><?= $item->category?$item->category->title:'';?></td>
		<td class="btn-group">
        <a href="category/update/<?=$item->id?>/" class="btn bg-purple"><i class="fa fa-edit"></i></a>
        <a href="category/delete/<?=$item->id?>/" class="btn bg-maroon"><i class="fa fa-remove"></i></a>
      	</td>
	</tr>
	<?endwhile;?>
	</tbody>
      <tfoot>
      <tr>
      	<th>__category_id</th>
        <th>__category_title</th>
		<th>__parent_category</th>
		<th>__action</th>
      </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>