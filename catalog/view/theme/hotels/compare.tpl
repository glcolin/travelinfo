<?php echo $header; ?>

<div id="wrap">
  <div class="sbbn"> <?php if($header_banners_link){?><a href="<?php echo $header_banners_link;?>"><?php }?><img src='./uploads/images/<?php echo $header_banners;?>'  width='960' height='230'/><?php if($header_banners_link){?></a><?php }?> </div>
  <div class="contents"> 
      <div class="breadcrume"> <a href="./index.php"><?php echo $TEXT['home'];?></a> > <a href='./index.php?route=hotels/hotels' ><?php echo $TEXT['hotels'];?></a> > <span class="current"><a href='./index.php?route=hotels/hotels&cid=<?php echo $current_category;?>' ><?php echo $category_title;?></a></span> </div>
      <div class="table">
        <ul class="row1 nobgrow ">
          <li class="compname noborder Name" style="height: 40px;"><?php echo $TEXT['name'];?></li>
          <li class="comptitle Name" style="height: 40px;"><a style="text-decoration: none; color: #830A11;" target="_blank" href="<?php echo isset($items[0]['title_link'])?$items[0]['title_link']:"";?>"><?php echo isset($items[0]['title'])?$items[0]['title']:"";?></a></li>
          <li class="comptitle Name" style="height: 40px;"><a style="text-decoration: none; color: #830A11;" target="_blank" href="<?php echo isset($items[1]['title_link'])?$items[1]['title_link']:"";?>"><?php echo isset($items[1]['title'])?$items[1]['title']:"";?></a></li>
          <li class="comptitle width270 Name" style="height: 40px;"><a style="text-decoration: none; color: #830A11;" target="_blank" href="<?php echo isset($items[2]['title_link'])?$items[2]['title_link']:"";?>"><?php echo isset($items[2]['title'])?$items[2]['title']:"";?></a></li>
        </ul>
        <ul class="bgrow ">
          <li class="compname noborder Category" style="height: 40px;"><?php echo $TEXT['rating'];?></li>
          <li class="compcontents Category" style="height: 40px;">
          	<?php if(isset($items[0]['rating']) && $items[0]['rating']){?>
            <ul class="rating">
                <?php for($i=0;$i<=$items[0]['rating'];$i++){?>
                    <li><img src="./catalog/view/images/star-red.gif"></li>
                <?php }?>    
            </ul>
            <?php }?>  
          </li>
          <li class="compcontents Category" style="height: 40px;">
          	<?php if(isset($items[1]['rating']) && $items[1]['rating']){?>
            <ul class="rating">
                <?php for($i=0;$i<=$items[1]['rating'];$i++){?>
                    <li><img src="./catalog/view/images/star-red.gif"></li>
                <?php }?>    
            </ul>
            <?php }?>
          </li>
          <li class="compcontents width271 Category" style="height: 40px;">
          	<?php if(isset($items[2]['rating']) && $items[2]['rating']){?>
            <ul class="rating">
                <?php for($i=0;$i<=$items[2]['rating'];$i++){?>
                    <li><img src="./catalog/view/images/star-red.gif"></li>
                <?php }?>    
            </ul>
            <?php }?>
          </li>
        </ul>
        <ul class="nobgrow ">
          <li class="compname noborder Price" style="height: 40px;"><?php echo $TEXT['price'];?></li>
          <li class="compcontents Price" style="height: 40px;"><?php echo isset($items[0]['price'])?$items[0]['price']:"";?></li>
          <li class="compcontents Price" style="height: 40px;"><?php echo isset($items[1]['price'])?$items[1]['price']:"";?></li>
          <li class="compcontents width271 Price" style="height: 40px;"><?php echo isset($items[2]['price'])?$items[2]['price']:"";?></li>
        </ul>
        <ul class="bgrow ">
          <li class="compname noborder Address" style="height: 136px;"><?php echo $TEXT['address'];?></li>
          <li class="compcontents Address" style="height: 136px;"><?php echo isset($items[0]['address'])?$items[0]['address']:"";?></li>
          <li class="compcontents Address" style="height: 136px;"><?php echo isset($items[1]['address'])?$items[1]['address']:"";?></li>
          <li class="compcontents width271 Address" style="height: 136px;"><?php echo isset($items[2]['address'])?$items[2]['address']:"";?></li>
        </ul>
        <ul class="nobgrow ">
          <li class="compname noborder Description" style="height: 360px;"><?php echo $TEXT['description'];?></li>
          <li class="compcontents Description" style="height: 360px;"><?php echo isset($items[0]['content'])?htmlspecialchars_decode($items[0]['content']):"";?></li>
          <li class="compcontents Description" style="height: 360px;"><?php echo isset($items[1]['content'])?htmlspecialchars_decode($items[1]['content']):"";?></li>
          <li class="compcontents width271 Description" style="height: 360px;"><?php echo isset($items[2]['content'])?htmlspecialchars_decode($items[2]['content']):"";?></li>
        </ul>
        <ul class="bgrow ">
          <li class="compname noborder Image" style="height: 154px;"><?php echo $TEXT['image'];?></li>
          <li class="compcontents Image" style="height: 154px;"><?php echo isset($items[0]['image_url'])?'<a target="_blank" href="./uploads/images/'.$items[0]['image_url'].'"><img width="240" height="130" src="./uploads/images/'.$items[0]['image_url'].'"></a>':"";?></li>
          <li class="compcontents Image" style="height: 154px;"><?php echo isset($items[1]['image_url'])?'<a target="_blank" href="./uploads/images/'.$items[1]['image_url'].'"><img width="240" height="130" src="./uploads/images/'.$items[1]['image_url'].'"></a>':"";?></li>
          <li class="compcontents width271 Image" style="height: 154px;"><?php echo isset($items[2]['image_url'])?'<a target="_blank" href="./uploads/images/'.$items[2]['image_url'].'"><img width="240" height="130" src="./uploads/images/'.$items[2]['image_url'].'"></a>':"";?></li>
        </ul>
      </div>
      <!--page end-->
  </div>
  <div class="clear"></div>
</div>
<?php echo $footer; ?>