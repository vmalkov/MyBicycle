<?foreach($categories as $category):?>
<div><?= $category->title;?> <?= $category->category->title?></div>
<?endforeach;?>