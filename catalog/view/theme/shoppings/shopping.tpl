<?php echo $header; ?>

<div id="wrap">
  <div class="sbbn"> <?php if($header_banners_link){?><a href="<?php echo $header_banners_link;?>"><?php }?><img src='./uploads/images/<?php echo $header_banners;?>'  width='960' height='230'/><?php if($header_banners_link){?></a><?php }?> </div>
  <div class="contents"> <?php echo $column_left;?>
    <div class="artical">
      <div class="breadcrume"> <a href="./index.php"><?php echo $TEXT['home'];?></a> > <a href='./index.php?route=shoppings/shoppings' ><?php echo $TEXT['shopping'];?></a> > <span class="current"><a href='./index.php?route=shoppings/shoppings&cid=<?php echo $current_category;?>' ><?php echo $category_title;?></a></span> </div>
      <div class="sbimglist">
        <div class="newslist shoppinglist"> <a target="_blank" href="./uploads/images/<?php echo $item['image_url'];?>"><img width="240" height="130" src="./uploads/images/<?php echo $item['image_url'];?>"></a>
          <div class="newsinfo">
            <h4 class="title" style="text-decoration: none;"><?php echo $item['title'];?></h4>
            <div class="clear"></div>
            <div class="listinfo">
              <p class="listinfot"><?php echo $TEXT['description'];?>:</p>
              <div class="description"><?php echo $item['intro'];?></div>
            </div>
            <div class="compare"></div>
          </div>
        </div>
        <div class="clear"></div>
        <div class="articalbody">
          <p class="bodytitle"><?php echo $TEXT['detail_information'];?>:</p>
          <?php echo htmlspecialchars_decode($item['content']);?><br>
        </div>
      </div>
      <!--page end-->
    </div>
  </div>
  <div class="clear"></div>
</div>
<?php echo $footer; ?>