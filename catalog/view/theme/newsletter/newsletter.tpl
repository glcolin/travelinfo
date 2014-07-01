<?php echo $header; ?>

<div id="wrap">
	<div class="contents">
		<div class="artical2">
			<div class="breadcrume">
				<a href="index.php">Home</a> > 
				<a href="index.php?route=newsletter/newsletter">Newsletter</a>
			</div>
			<div class="articaldetail2">
				
				<p>Please leave your name and your email, then we will send you our newsletter to your email everytime there is promotion in  our company...</p>
				
				<form id="provideInfoForm" name="provideInfoForm" action="/proc.php?a=handleProvideInfoForm&t=079ca17e619c739f6be743a776e5be9637a50f93&=&lang=eng" method="POST" enctype="multipart/form-data">
					<div class="ctmessage">
						<input type="text" name="name" onfocus="if(this.value == 'Name*') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Name*'; }" value="Name*" class="input-form" /><br/>
						<input type="text" name="email" onfocus="if(this.value == 'Email*') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Email*'; }" value="Email*" class="input-form" /><br/>
						
						<input type="submit" value="SUBSCRIBE NOW" class="send" style="cursor: pointer;"/>
					</div>
				</form>
			
			</div>
				
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php echo $footer; ?>