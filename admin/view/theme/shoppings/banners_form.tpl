<?php echo $header; ?>
<div id="content">

  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?> 
   
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  <input type="hidden" name="banner_id" value="<?php echo isset($this->request->get['banner_id'])?$this->request->get['banner_id']:""?>" />
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" />Banner </h1>
	  
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
			<td> Banner title:</td>
			<td><input name="banner_title[<?php echo $language['language_id']; ?>]" value="<?php echo isset($banner_info[$language['language_id']]['title']) ? $banner_info[$language['language_id']]['title'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			<td> Banner link:</td>
			<td><input name="banner_link[<?php echo $language['language_id']; ?>]" value="<?php echo isset($banner_info[$language['language_id']]['link']) ? $banner_info[$language['language_id']]['link'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			<td> Banner position:</td>
			<td>
            <select name="banner_position[<?php echo $language['language_id']; ?>]">
            	<option value="left" <?php echo isset($banner_info[$language['language_id']]['position'])?($banner_info[$language['language_id']]['position']=='left'?'selected="selected"':''):''?>>Left</option>
                <option value="top" <?php echo isset($banner_info[$language['language_id']]['position'])?($banner_info[$language['language_id']]['position']=='top'?'selected="selected"':''):''?>>Top</option>
                <option value="header" <?php echo isset($banner_info[$language['language_id']]['position'])?($banner_info[$language['language_id']]['position']=='header'?'selected="selected"':''):''?>>Header</option>
            </select>
			</td>
		  </tr>
          <tr>
			<td onclick="select_image('banner_image[<?php echo $language['language_id']; ?>]');"> Banner image:<br />(Click here to select image)</td>
			<td onclick="select_image('banner_image[<?php echo $language['language_id']; ?>]');"><input type="hidden" name="banner_image[<?php echo $language['language_id']; ?>]" value="<?php echo isset($banner_info[$language['language_id']]['image_url']) ? $banner_info[$language['language_id']]['image_url'] : ''; ?>" />
				<img src="<?php echo isset($banner_info[$language['language_id']]['image_url']) ? HTTP_HOME.'uploads/images/'.$banner_info[$language['language_id']]['image_url'] : ''; ?>"  alt="" data-href="banner_image[<?php echo $language['language_id']; ?>]" class="image" />
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