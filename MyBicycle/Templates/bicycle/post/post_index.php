<?if(isset($post)) foreach($post as $item):?>
<div><?= $item->title;?></div>
<div><?= $item->text;?></div>
<div><?= $item->category->title;?></div>
<?endforeach;?>