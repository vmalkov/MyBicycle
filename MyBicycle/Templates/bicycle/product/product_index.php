<?while($prd=$product->next()):?>
<div><a href="product/read/<?=$prd->id?>"><?=$prd->title;?></a> - Цена: <?=$prd->price;?> - <a target="_blank" href="cart/add/?id=<?=$prd->id;?>">__add_to_cart</a> </div>
<?endwhile;?>