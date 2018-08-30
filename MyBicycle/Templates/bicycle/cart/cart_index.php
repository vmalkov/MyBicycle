<table border="1">
	<tr>
		<th>ID товара</th><th>Цена</th><th>Кол-во</th><th>Сумма</th>
		<?foreach($cart->get() as $product):?>
			<tr>
				<td><?= $product->id;?></td>
				<td><?= $product->price;?></td>
				<td><?= $product->qty;?></td>
				<td><?= $product->subtotal?></td>
			</tr>
		<?endforeach;?>
	</tr>
	<tr>
		<td colspan="3">Всего товаров:</td>
		<td><?= $cart->qty();?></td>
	</tr>
	<tr>
		<td colspan="3">На сумму:</td>
		<td><?= $cart->total();?></td>
	</tr>
</table>