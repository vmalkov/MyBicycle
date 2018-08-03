<?if(isset($category)):?>
<div class="box"><div class="box-body">
	<table class="table table-bordered">
	<tr>
		<th>__title</th>
		<th>__parent_category</th>
		<th>__action</th>
	</tr>
	<?foreach($category as $item):?>
	<tr>
		<td>
			<a href="category/update/<?= $item->id?>/"><?= $item->title;?></a></td>
		<td><?= $item->category?$item->category->title:'';?></td>
		<td class="text-right"><a href="category/delete/<?= $item->id?>/"><i class="fa fa-times" /></a></td>
	</tr>
	<?endforeach;?>
	</table>
</div></div>
<?endif;?>