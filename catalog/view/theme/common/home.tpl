<?php echo $header; ?>
<script>
	//call marquee plugin
	$(function() {
		jQuery("#marquee").JQueryMarquee({
			isEqual:false,
			loop: 0,
			direction: 'left',
			scrollAmount:1,
			scrollDelay:50
		});
	});
</script>
<div id="wrap">
  <div class="bn">
  	<?php foreach($header_banners as $header_banner){?>
    <div class="bn1">
      <div class="bnimg"><a href="<?php echo $header_banner['link']?>"><img src="./uploads/images/<?php echo $header_banner['image_url']?>" width="240" height="320" alt="Vacations" /></a></div>
      <div class="bnname"> 
      <a class="bnnamet bnupper" href="<?php echo $header_banner['link']?>"><?php echo $header_banner['title']?></a><br />
      <a class="bnmore bnmore-en" href="<?php echo $header_banner['link']?>"><?php echo $TEXT['learn_more'];?></a></div>
    </div>
    <?php }?>
    <div class="clear"></div>
  </div>
  <!-- bn end-->
  <div class="clear"></div>
  <!--ads-->
  <div class="ads">
    
        <h2><?php echo $TEXT['advertisement'];?></h2>

      <div id="marquee">
          <ul style="height:150px;">
          	<?php foreach($advertisements as $advertisement){?>
            <li>
              <a href="<?php echo $advertisement['link']?>"><img src="./uploads/images/<?php echo $advertisement['image_url']?>" border="0" height="140" width="200" /></a>
            </li>
            <?php }?>
          </ul>
      </div>


  </div>
  <div class="clear"></div>
  <!-- ads end -->
  <div class="list">
    <div class="list_left">
      <h2><?php echo $TEXT['attractions'];?><span><a href="./index.php?route=attractions/attractions"><?php echo $TEXT['more'];?> >></a></span></h2>
      <div class="photos"> 
          <?php $i=0;?>
          <?php foreach($attractions_data as $attraction_data){?>
            <?php if($i<=2){?>
                <a href="./index.php?route=attractions/attraction&cid=<?php echo $attraction_data['category'];?>&item_id=<?php echo $attraction_data['item_id'];?>"><img <?php echo $i==2?'class="last"':'';?> src="./uploads/images/<?php echo $attraction_data['image_url'];?>" /></a>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
      <div class="articles">
      	  <?php $i=0;?>
          <?php foreach($attractions_data as $attraction_data){?>
            <?php if($i<=6){?>
                <p><a href="./index.php?route=attractions/attraction&cid=<?php echo $attraction_data['category'];?>&item_id=<?php echo $attraction_data['item_id'];?>"><?php echo $attraction_data['title'];?></a></p>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
    </div>
    <div class="list_right">
      <h2><?php echo $TEXT['amusement'];?><span><a href="./index.php?route=amusements/amusements"><?php echo $TEXT['more'];?> >></a></span></h2>
      <div class="photos">
      	  <?php $i=0;?>
          <?php foreach($amusements_data as $amusement_data){?>
            <?php if($i<=2){?>
                <a href="./index.php?route=amusements/amusement&cid=<?php echo $amusement_data['category'];?>&item_id=<?php echo $amusement_data['item_id'];?>"><img <?php echo $i==2?'class="last"':'';?> src="./uploads/images/<?php echo $amusement_data['image_url'];?>" /></a>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
      <div class="articles">
          <?php $i=0;?>
          <?php foreach($amusements_data as $amusement_data){?>
            <?php if($i<=6){?>
                <p><a href="./index.php?route=amusements/amusement&cid=<?php echo $amusement_data['category'];?>&item_id=<?php echo $amusement_data['item_id'];?>"><?php echo $amusement_data['title'];?></a></p>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
    </div>
    <div class="clear"></div>
  </div>
  <!-- list end -->
  <div class="clear"></div>
  <div class="list">
    <div class="list_left">
      <h2><?php echo $TEXT['restaurants'];?><span><a href="./index.php?route=restaurants/restaurants"><?php echo $TEXT['more'];?> >></a></span></h2>
      <div class="photos">
          <?php $i=0;?>  
          <?php foreach($restaurants_data as $restaurant_data){?>
            <?php if($i<=2){?>
                <a href="./index.php?route=resturants/resturant&cid=<?php echo $restaurant_data['category'];?>&item_id=<?php echo $restaurant_data['item_id'];?>"><img <?php echo $i==2?'class="last"':'';?> src="./uploads/images/<?php echo $restaurant_data['image_url'];?>" /></a>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
      <div class="articles">
          <?php $i=0;?>
          <?php foreach($restaurants_data as $restaurant_data){?>
            <?php if($i<=6){?>
                <p><a href="./index.php?route=resturants/resturant&cid=<?php echo $restaurant_data['category'];?>&item_id=<?php echo $restaurant_data['item_id'];?>"><?php echo $restaurant_data['title'];?></a></p>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
    </div>
    <div class="list_right">
      <h2><?php echo $TEXT['tours'];?><span><a href="./index.php?route=tours/tours"><?php echo $TEXT['more'];?> >></a></span></h2>
      <div class="photos">
      	  <?php $i=0;?>
          <?php foreach($tours_data as $tour_data){?>
            <?php if($i<=2){?>
                <a href="./index.php?route=tours/tour&cid=<?php echo $tour_data['category'];?>&item_id=<?php echo $tour_data['item_id'];?>"><img <?php echo $i==2?'class="last"':'';?> src="./uploads/images/<?php echo $tour_data['image_url'];?>" /></a>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
      <div class="articles">
          <?php $i=0;?>
          <?php foreach($tours_data as $tour_data){?>
            <?php if($i<=6){?>
                <p><a href="./index.php?route=tours/tour&cid=<?php echo $tour_data['category'];?>&item_id=<?php echo $tour_data['item_id'];?>"><?php echo $tour_data['title'];?></a></p>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
    </div>
    <div class="clear"></div>
  </div>
  <!-- list end -->
  <div class="clear"></div>
  <div class="ads_mid"> <a target="_blank" href="<?php echo $content_banners[0]['link'];?>"><img src="./uploads/images/<?php echo $content_banners[0]['image_url'];?>" border="0"></a> </div>
  <div class="list">
    <div class="list_left">
      <h2><?php echo $TEXT['hotels'];?><span><a href="./index.php?route=hotels/hotels"><?php echo $TEXT['more'];?> >></a></span></h2>
      <div class="photos">
      	  <?php $i=0;?>
          <?php foreach($hotels_data as $hotel_data){?>
            <?php if($i<=2){?>
                <a href="./index.php?route=hotels/hotel&cid=<?php echo $hotel_data['category'];?>&item_id=<?php echo $hotel_data['item_id'];?>"><img <?php echo $i==2?'class="last"':'';?> src="./uploads/images/<?php echo $hotel_data['image_url'];?>" /></a>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
      <div class="articles">
          <?php $i=0;?>
          <?php foreach($hotels_data as $hotel_data){?>
            <?php if($i<=6){?>
                <p><a href="./index.php?route=hotels/hotel&cid=<?php echo $hotel_data['category'];?>&item_id=<?php echo $hotel_data['item_id'];?>"><?php echo $hotel_data['title'];?></a></p>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
    </div>
    <div class="list_right">
      <h2><?php echo $TEXT['transportations'];?><span><a href="./index.php?route=transportations/transportations"><?php echo $TEXT['more'];?> >></a></span></h2>
      <div class="photos">
      	  <?php $i=0;?>
          <?php foreach($transportations_data as $transportation_data){?>
            <?php if($i<=2){?>
                <a href="./index.php?route=transportations/transportation&cid=<?php echo $transportation_data['category'];?>&item_id=<?php echo $transportation_data['item_id'];?>"><img <?php echo $i==2?'class="last"':'';?> src="./uploads/images/<?php echo $transportation_data['image_url'];?>" /></a>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
      <div class="articles">
          <?php $i=0;?>
          <?php foreach($transportations_data as $transportation_data){?>
            <?php if($i<=6){?>
                <p><a href="./index.php?route=transportations/transportation&cid=<?php echo $transportation_data['category'];?>&item_id=<?php echo $transportation_data['item_id'];?>"><?php echo $transportation_data['title'];?></a></p>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
    </div>
    <div class="clear"></div>
  </div>
  <!-- list end -->
  <div class="clear"></div>
  <div class="list">
    <div class="list_left">
      <h2><?php echo $TEXT['shopping'];?><span><a href="./index.php?route=shoppings/shoppings"><?php echo $TEXT['more'];?> >></a></span></h2>
      <div class="photos">
      	  <?php $i=0;?>
          <?php foreach($shoppings_data as $shopping_data){?>
            <?php if($i<=2){?>
                <a href="./index.php?route=shoppings/shopping&cid=<?php echo $shopping_data['category'];?>&item_id=<?php echo $shopping_data['item_id'];?>"><img <?php echo $i==2?'class="last"':'';?> src="./uploads/images/<?php echo $shopping_data['image_url'];?>" /></a>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
      <div class="articles">
          <?php $i=0;?>
          <?php foreach($shoppings_data as $shopping_data){?>
            <?php if($i<=6){?>
                <p><a href="./index.php?route=shoppings/shopping&cid=<?php echo $shopping_data['category'];?>&item_id=<?php echo $shopping_data['item_id'];?>"><?php echo $shopping_data['title'];?></a></p>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
    </div>
    <div class="list_right">
      <h2><?php echo $TEXT['cruise'];?><span><a href="./index.php?route=cruises/cruises"><?php echo $TEXT['more'];?> >></a></span></h2>
      <div class="photos">
      	  <?php $i=0;?>
          <?php foreach($cruises_data as $cruise_data){?>
            <?php if($i<=2){?>
                <a href="./index.php?route=cruises/cruise&cid=<?php echo $cruise_data['category'];?>&item_id=<?php echo $cruise_data['item_id'];?>"><img <?php echo $i==2?'class="last"':'';?> src="./uploads/images/<?php echo $cruise_data['image_url'];?>" /></a>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
      <div class="articles">
          <?php $i=0;?>
          <?php foreach($cruises_data as $cruise_data){?>
            <?php if($i<=6){?>
                <p><a href="./index.php?route=cruises/cruise&cid=<?php echo $cruise_data['category'];?>&item_id=<?php echo $cruise_data['item_id'];?>"><?php echo $cruise_data['title'];?></a></p>
            <?php }else{ break;}?>
          <?php $i++;?>
          <?php }?>
      </div>
    </div>
    <div class="clear"></div>
  </div>
  <!-- list end -->
  <div class="clear"></div>
  <div class="ads_mid"> <a target="_blank" href="<?php echo $content_banners[1]['link'];?>"><img src="./uploads/images/<?php echo $content_banners[1]['image_url'];?>" border="0"></a> </div>
</div>

<?php echo $footer; ?>