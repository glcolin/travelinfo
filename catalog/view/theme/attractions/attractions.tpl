<?php echo $header; ?>

<div id="wrap">
  <div class="sbbn"><?php if($header_banners_link){?><a href="<?php echo $header_banners_link;?>"><?php }?><img src='./uploads/images/<?php echo $header_banners;?>'  width='960' height='230'/><?php if($header_banners_link){?></a><?php }?></div>
  <div class="contents">
  	<?php echo $column_left;?>
    <div class="artical">
      <div class="breadcrume"> <a href="./index.php"><?php echo $TEXT['home'];?></a> > <a href='./index.php?route=attractions/attractions' ><?php echo $TEXT['attractions'];?></a> > <span class="current"><a href='./index.php?route=attractions/attractions&cid=<?php echo $current_category;?>' ><?php echo $category_title;?></a></span> </div>
      <div class="sbimglist">
        <?php foreach($items as $item){?>
        <?php $item_link=$item['custom_link']=="yes"?$item['website']:'./index.php?route=attractions/attraction&cid='.$current_category.'&item_id='.$item['item_id'];?>
        <div class="newslist"> <a href="<?php echo $item_link;?>"><img src="./uploads/images/<?php echo $item['image_url'];?>" class="mainImg" width="230" height="160"/></a>
          <div class="newsinfo"> <a href="<?php echo $item_link;?>">
            <h4 class="title"><?php echo $item['title'];?></h4>
            </a>
            <div class="listinfo">
              <div style="margin-left:0;padding-left:5px;"><?php echo $item['intro'];?></div>
            </div>
          </div>
        </div>
        <?php }?>
      </div>
      <div class="pagination"><?php echo $pagination; ?></div>
      <!--page end-->
    </div>
  </div>
  <div class="clear"></div>
</div>
<?php echo $footer; ?>