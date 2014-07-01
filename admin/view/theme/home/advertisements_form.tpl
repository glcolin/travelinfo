<?php echo $header; ?>
<div id="content">

  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?> 
   
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  <input type="hidden" name="advertisement_id" value="<?php echo isset($this->request->get['advertisement_id'])?$this->request->get['advertisement_id']:""?>" />
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" />Advertisement </h1>
	  
      <div class="buttons">
      	<a onclick="$('#form').submit();" class="button">
		<span>Save</span>
		</a>
        <a href="<?php echo  $cancel;?>" class="button">
		<span>Cancel</span>
		</a>
	  </div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general">General</a></div>
		<div id="languages" class="htabs">
			<?php foreach ($languages as $language) { ?>
			<a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />  <?php echo $language['name']; ?></a>
			<?php } ?>
		</div>
		<?php foreach ($languages as $language) { ?>
		<div id="language<?php echo $language['language_id']; ?>">
		<table class="form">
          <tr>
			<td> Advertisement title:</td>
			<td><input name="advertisement_title[<?php echo $language['language_id']; ?>]" value="<?php echo isset($advertisement_info[$language['language_id']]['title']) ? $advertisement_info[$language['language_id']]['title'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			<td> Advertisement link:</td>
			<td><input name="advertisement_link[<?php echo $language['language_id']; ?>]" value="<?php echo isset($advertisement_info[$language['language_id']]['link']) ? $advertisement_info[$language['language_id']]['link'] : ''; ?>" size="100"/>
			</td>
		  </tr>
          <tr>
			<td> Advertisement image:</td>
			<td onclick="select_image('advertisement_image[<?php echo $language['language_id']; ?>]');"><input type="hidden" name="advertisement_image[<?php echo $language['language_id']; ?>]" value="<?php echo isset($advertisement_info[$language['language_id']]['image_url']) ? $advertisement_info[$language['language_id']]['image_url'] : ''; ?>" />
				<img src="<?php echo isset($advertisement_info[$language['language_id']]['image_url']) ? HTTP_HOME.'uploads/images/'.$advertisement_info[$language['language_id']]['image_url'] : ''; ?>"  alt="" data-href="advertisement_image[<?php echo $language['language_id']; ?>]" class="image" />
			</td>
		  </tr>
		</table>
		</div>
		<?php } ?>
    </div>

  </div>
  	</form>
 
</div>
<style>
.content img{ max-width:300px;}
</style>

<!--select image-->
<script type="text/javascript">
var image_category_url="<?php echo HTTP_HOME.'uploads/images/';?>";
function select_image(element){
	window.open ("./view/javascript/ckeditor/elfinder/elfinder_select_image.php?token=<?php echo $token;?>&image="+element,"newwindow","height=500,width=1100,top=" + (window.screen.availHeight-30-500)/2 +",left=" + (window.screen.availWidth-10-1100)/2 +",toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no") ;
}
function image_callback(file,name){
	file=file.replace(image_category_url,'');
	$('[name="' + name+'"]').val(file);
	$('[data-href="'+name+'"]').attr('src', image_category_url+file);
}
</script>

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
//--></script> 
<?php echo $footer; ?>