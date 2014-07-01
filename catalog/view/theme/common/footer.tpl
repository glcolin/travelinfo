<!--bottom start-->
<div class="bottom">
  <!--links start-->
  <div class="links">
	&nbsp;
    <!--<p>Friendly links:</p>-->
    <?php foreach($friendlinks as $friendlink){?>
    <a href="<?php echo $friendlink['link']?>" ><?php echo $friendlink['title']?></a> | 
    <?php }?>
  </div>
  <!--links end-->
  <!--b-bottom start-->
  <div class="b-bottom">
    <div class="left">
      <div class="copyright">
        <p>Copyright &copy; 2013 Ameirica Travel Info Inc.</p>
      </div>
      <div class="clear"></div>
    </div>
    <div class="right"> <a href="index.php?route=articles/article&id=1" >About us</a> | <a href="index.php?route=articles/article&id=2" >Contact us</a> | <a href="index.php?route=articles/article&id=3" >Privacy Policy</a> | <a href="index.php?route=articles/article&id=4" >Terms & Conditions</a> | <a href="index.php?route=newsletter/newsletter" style="color:red;">News Letter</a> </div>
  </div>
  <!--b-bottom end-->
  <div class="clear"></div>
</div>
<!--bottom end-->

<!--footer js-->
</body></html>