<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">__HEADER_COMPONENTS</li>
  <!-- Optionally, you can add icons to the links -->
  <?if($components) foreach($components as $component):?>
  <li<?if($component['active']):?> class="active"<?endif;?>><a href="<?=$component['href']?>"><i class="fa fa-link"></i> <span><?=$component['title']?></span></a></li>
  <?endforeach;?>

  <li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="#">Link in level 2</a></li>
      <li><a href="#">Link in level 2</a></li>
    </ul>
  </li>
</ul>
<!-- /.sidebar-menu -->