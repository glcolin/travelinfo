<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="UTF-8" />
<title><?php echo isset($title)?$title:'Title'; ?></title>
<?php if (isset($description)) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if (isset($keywords)) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if (isset($styles)) { ?>
	<?php foreach ($styles as $style) { ?>
	<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
	<?php } ?>
<?php } ?>
<link rel="stylesheet" type="text/css" href="view/stylesheet/stylesheet.css" />
<script type="text/javascript" src="view/javascript/jquery/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-1.10.3.custom.min.js"></script>
<link type="text/css" href="view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="view/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="view/javascript/common.js"></script>
<?php if (isset($scripts)) { ?>
	<?php foreach ($scripts as $script) { ?>
	<script type="text/javascript" src="<?php echo $script; ?>"></script>
	<?php } ?>
<?php } ?>
<link type="text/css" href="view/stylesheet/login.css" rel="stylesheet" />
</head>
<body>

<div id="container">
	<div id="header">
		<div class="div1">
			<div class="div2">
				<img src="view/image/logo.png" onClick="location = index.php" />
			</div>
			<div class="div3">
				<?php if(isset($login)){ ?>
					<img src="view/image/lock.png" alt="" style="position: relative; top: 3px;" />
					<?php if($login == 0){ ?>
						You are not yet logged in.
					<?php } ?>
					
					<?php if($login == 1){ ?>
						You are logged in as <?php echo $login_username;?>.
					<?php } ?>
					
				<?php } ?>
			</div>
		</div>
	</div><!-- end header -->
	<?php if ($login == 1) { ?>
	<div id="menu" >
		<ul class="left" style="display: none;">
			<li id="home">
				<a class="top" href="index.php?route=common/home">Home</a>
                <ul>
                	<li><a href="index.php?route=home/banners">Banners</a></li>
                    <li><a href="index.php?route=home/advertisements">Advertisements</a></li>
                    <li><a href="index.php?route=home/friendlinks">Friend links</a></li>
				</ul>
			</li>
			<li id="attractions">
            	<a class="top">Attractions</a>
            	<ul>
                	<li><a href="index.php?route=attractions/banners">Banners</a></li>
					<li><a href="index.php?route=attractions/attractions">Attractions</a></li>
                    <li><a href="index.php?route=attractions/categorys">Categorys</a></li>
				</ul>
            </li>
            <li id="amusements">
            	<a class="top">Amusements</a>
            	<ul>
                	<li><a href="index.php?route=amusements/banners">Banners</a></li>
					<li><a href="index.php?route=amusements/amusements">Amusements</a></li>
                    <li><a href="index.php?route=amusements/categorys">Categorys</a></li>
				</ul>
            </li>
            <li id="restaurants">
            	<a class="top">Restaurants</a>
            	<ul>
                	<li><a href="index.php?route=restaurants/banners">Banners</a></li>
					<li><a href="index.php?route=restaurants/restaurants">Restaurants</a></li>
                    <li><a href="index.php?route=restaurants/categorys">Categorys</a></li>
				</ul>
            </li>
            <li id="tours">
            	<a class="top">Tours</a>
            	<ul>
                	<li><a href="index.php?route=tours/banners">Banners</a></li>
					<li><a href="index.php?route=tours/tours">Tours</a></li>
                    <li><a href="index.php?route=tours/categorys">Categorys</a></li>
				</ul>
            </li>
            <li id="hotels">
            	<a class="top">Hotels</a>
            	<ul>
                	<li><a href="index.php?route=hotels/banners">Banners</a></li>
					<li><a href="index.php?route=hotels/hotels">Hotels</a></li>
                    <li><a href="index.php?route=hotels/categorys">Categorys</a></li>
				</ul>
            </li>
            <li id="transportations">
            	<a class="top">Transportations</a>
            	<ul>
                	<li><a href="index.php?route=transportations/banners">Banners</a></li>
					<li><a href="index.php?route=transportations/transportations">Transportations</a></li>
                    <li><a href="index.php?route=transportations/categorys">Categorys</a></li>
				</ul>
            </li>
            <li id="shoppings">
            	<a class="top">Shopping</a>
            	<ul>
                	<li><a href="index.php?route=shoppings/banners">Banners</a></li>
					<li><a href="index.php?route=shoppings/shoppings">Shopping Addresses</a></li>
                    <li><a href="index.php?route=shoppings/categorys">Categorys</a></li>
				</ul>
            </li>
            <li id="cruises">
            	<a class="top">Cruises</a>
            	<ul>
                	<li><a href="index.php?route=cruises/banners">Banners</a></li>
					<li><a href="index.php?route=cruises/cruises">Cruises</a></li>
                    <li><a href="index.php?route=cruises/categorys">Categorys</a></li>
				</ul>
            </li>
			<li id="informations">
            	<a class="top" href="index.php?route=articles/articles">Informations</a>
            </li>
            <li id="system">
            	<a class="top">System</a>
				<ul>
					<li><a href="index.php?route=tool/backup">Database Backup</a></li>
					<li><a href="index.php?route=tool/reset">Reset Password</a></li>
				</ul>
			</li>
		</ul>
		
		<ul class="right" style="display: none;">
			<li id="store"><a href="../index.php" target="_blank" class="top">View Front</a></li>
			<li><a class="top" href="index.php?route=common/logout">Logout</a></li>
		</ul>
	</div><!-- end menu -->
    <?php }?>