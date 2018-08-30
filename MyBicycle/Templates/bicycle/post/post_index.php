<?while($pst=$post->next()):?>
<div><a href="post/read/<?=$pst->id?>/"><?=$pst->title?></a></div>
<div><?=$pst->text?></div>
<div><?=$pst->category->title?></div>
<?endwhile;?>