<table border="1">
	<tr>
		<th>ID товара</th><th>Название</th><th>Цена</th><th>Кол-во</th><th>Сумма</th>
		<?foreach($products as $product):?>
			<tr>
				<td><?= $product->id;?></td>
				<td><?= $product->title;?></td>
				<td><?= $product->price;?></td>
				<td><?= $product->qty;?></td>
				<td><?= $product->subtotal?></td>
			</tr>
		<?endforeach;?>
	</tr>
	<tr>
		<td colspan="3">Всего товаров:</td>
		<td><?= $qty;?></td>
	</tr>
	<tr>
		<td colspan="3">На сумму:</td>
		<td><?= $total;?></td>
	</tr>
</table>