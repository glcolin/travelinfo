<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>America Travel Info</title>
<?php if(!isset($_GET['route']) || $_GET['route']=="common/home"){?>
<link href="./catalog/view/css/style.css" rel="stylesheet" type="text/css" />
<?php }else{?>
<link href="./catalog/view/css/substyle.css" rel="stylesheet" type="text/css" />
<?php }?>
<link rel="stylesheet" href="./catalog/view/css/marquee.css"  type="text/css"/>
<script type="text/javascript" src="./catalog/view/js/jquery-1.7.min.js"></script>
<script type="text/javascript" src="./catalog/view/js/marquee.js"></script>
<script type="text/javascript">
$(function(){
	$(".header .language").click(function(){
		$.ajax({
			type: 'post',
			url : 'index.php?route=common/ajax/select_language',
			dataType : "text",
			data: {
				   language : $(this).find("a").attr("data")
			},
			success: function (data) {
				if(data=="1"){
					location.reload();
				}
			}
		});
	});
});
</script>
</head>
<body>
<div class="header">
  <div class="language"> <a href="#" data="2">简体</a> </div>
  <div class="language"> <a href="#" data="3">繁体</a> </div>
  <div class="language"> <a href="#" data="1">English</a> </div>
  <div class="logo2">
	<img class="nomargin" src="./catalog/view/images/header.jpg" alt="America Travel Info" border="0" width="960"  style="margin-top:10px;" />
  </div>
  <!--
  <div class="logo">
    <h1><a href="#"><img class="nomargin" src="./catalog/view/images/logo.jpg" alt="America Travel Info" border="0" width="300" height="100" /></a></h1>
  </div>
  <div class="top_ads"> <a href="#"><img class="nomargin" src="./uploads/images/<?php echo isset($top_banner['image_url'])?$top_banner['image_url']:'';?>" border="0" /></a> </div>
  -->
  <div class="clear"></div>
</div>
<!--header end-->
<!--menu start-->
<div class="nav">
  <div id="wrap">
    <ul class="menu">
      <li <?php echo ($current_page==""||$current_page=="common/home")?'class="current"':'';?>><a href="./index.php"><?php echo $TEXT['home'];?></a></li>
      <li <?php echo $current_page=="attractions"?'class="current"':'';?>><a href="./index.php?route=attractions/attractions"><?php echo $TEXT['attractions'];?></a></li>
      <li <?php echo $current_page=="amusements"?'class="current"':'';?>><a href="./index.php?route=amusements/amusements"><?php echo $TEXT['amusement'];?></a></li>
      <li <?php echo $current_page=="restaurants"?'class="current"':'';?>><a href="./index.php?route=restaurants/restaurants"><?php echo $TEXT['restaurants'];?></a></li>
      <li <?php echo $current_page=="tours"?'class="current"':'';?>><a href="./index.php?route=tours/tours"><?php echo $TEXT['tours'];?></a></li>
      <li <?php echo $current_page=="hotels"?'class="current"':'';?>><a href="./index.php?route=hotels/hotels"><?php echo $TEXT['hotels'];?></a></li>
      <li <?php echo $current_page=="transportations"?'class="current"':'';?>><a href="./index.php?route=transportations/transportations"><?php echo $TEXT['transportations'];?></a></li>
      <li <?php echo $current_page=="shoppings"?'class="current"':'';?>><a href="./index.php?route=shoppings/shoppings"><?php echo $TEXT['shopping'];?></a></li>
      <li class="lastmenu <?php echo $current_page=="cruises"?'current':'';?>" ><a href="./index.php?route=cruises/cruises"><?php echo $TEXT['cruise'];?></a></li>
    </ul>
  </div>
</div>
<!--menu end-->
