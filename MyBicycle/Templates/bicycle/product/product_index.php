<?while($prd=$product->next()):?>
<div><?=$prd->title;?> - <a href="cart/add/?id=<?=$prd->id;?>">__add_to_cart</a> </div>
<?endwhile;?>