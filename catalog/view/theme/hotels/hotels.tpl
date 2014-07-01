<?php echo $header; ?>
<script type="text/javascript" src="./catalog/view/js/goodtour.js"></script>

<div id="wrap">
  <div class="sbbn"> <?php if($header_banners_link){?><a href="<?php echo $header_banners_link;?>"><?php }?><img src='./uploads/images/<?php echo $header_banners;?>'  width='960' height='230'/><?php if($header_banners_link){?></a><?php }?> </div>
  <div class="contents"> <?php echo $column_left;?>
    <div class="artical">
      <div class="breadcrume"> <a href="./index.php"><?php echo $TEXT['home'];?></a> > <a href='./index.php?route=hotels/hotels' ><?php echo $TEXT['hotels'];?></a> > <span class="current"><a href='./index.php?route=hotels/hotels&cid=<?php echo $current_category;?>' ><?php echo $category_title;?></a></span> </div>
      <div class="sbimglist">
        <?php foreach($items as $item){?>
        <?php $item_link=$item['custom_link']=="yes"?$item['website']:'./index.php?route=hotels/hotel&cid='.$current_category.'&item_id='.$item['item_id'];?>
        <div class="newslist"> <a href="<?php echo $item_link;?>"><img src="./uploads/images/<?php echo $item['image_url'];?>" class="mainImg" width="230" height="160"/></a>
          <div class="newsinfo"> <a href="<?php echo $item_link;?>">
            <h4 class="title"><?php echo $item['title'];?></h4>
            </a>
            <div class="listinfo">
              <p class="listinfot width100" style="margin-right:0;"><?php echo $TEXT['rating'];?>:</p>
              <div style="text-indent:0;padding-left:100px;">
              	<?php if($item['rating']){?>
              	<ul class="rating">
                	<?php for($i=0;$i<=$item['rating'];$i++){?>
                        <li><img src="./catalog/view/images/star-red.gif"></li>
                    <?php }?>    
                </ul>
                <?php }?>  
              </div>
            </div>
            <div class="listinfo">
              <p class="listinfot width100" style="margin-right:0;"><?php echo $TEXT['address'];?>:</p>
              <div style="text-indent:0;padding-left:100px;"><?php echo $item['address'];?></div>
            </div>
            <div class="listinfo">
              <p class="listinfot width100" style="margin-right:0;"><?php echo $TEXT['price'];?>:</p>
              <div style="text-indent:0;padding-left:100px;"><?php echo $item['price'];?></div>
            </div>
            <div class="listinfo">
              <p class="listinfot width100" style="margin-right:0;"><?php echo $TEXT['description'];?>:</p>
              <div style="text-indent:0;padding-left:100px;"><?php echo $item['intro'];?></div>
            </div>
          </div>
          <div class="compare"> <a class="compareNowButton"><?php echo $TEXT['compare_now'];?> (<span class="ids_count"></span>)</a>
            <div class="addcompare">
              <input type="checkbox" name="compare_options" class="checkbox compare_options" value="<?php echo $item['item_id'];?>">
              <a class="addcom"><?php echo $TEXT['add_to_compare'];?></a> </div>
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
<input type="hidden" id="class_type" value="hotels" />
<input type="hidden" id="compare_ids" value="<?php echo implode(',',$ids);?>" />
<?php echo $footer; ?>