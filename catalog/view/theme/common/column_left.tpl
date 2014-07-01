<div class="sidebar">
  <p><?php echo $TEXT['search'];?></p>
  <ul>
    <li><input id="search" name="search" class="search" type="text" value="<?php echo $search?>"/><img class="search_btn" src="catalog/view/images/search_btn.jpg" width="30" height="22" border="0" onclick="window.location.href='./index.php?route=<?php echo $route;?>&search='+document.getElementById('search').value"/></li>
  </ul>
  
  <p><?php echo $TEXT[$class_title]?></p>
  <ul>
    <?php foreach($categorys as $category){?>
    <li <?php echo $category['item_id']==$current_category?'class="current"':''?>> <a href="./index.php?route=<?php echo $route;?>&cid=<?php echo $category['item_id'];?>"><?php echo $category['title'];?></a> </li>
    <?php }?>
  </ul>
  
  <?php foreach($left_banners as $left_banner){?>
  	<a target="_blank" href="<?php echo $left_banner['link'];?>"><img style="width:100%; margin-bottom:10px;" src="./uploads/images/<?php echo $left_banner['image_url'];?>" /></a>
  <?php }?>
  
</div>
