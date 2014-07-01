<?php echo $header; ?>
<div id="content">

  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?> 
   
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  <input type="hidden" name="cruise_id" value="<?php echo isset($this->request->get['cruise_id'])?$this->request->get['cruise_id']:""?>" />
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" />Cruise </h1>
	  
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
			<td> Cruise title:</td>
			<td><input name="cruise_title[<?php echo $language['language_id']; ?>]" value="<?php echo isset($cruise_info[$language['language_id']]['title']) ? $cruise_info[$language['language_id']]['title'] : ''; ?>" size="100"/>
			</td>
		  </tr>
          <tr>
			<td> Cruise intro:</td>
			<td>
            <textarea name="cruise_intro[<?php echo $language['language_id']; ?>]" cols="150" rows="7"><?php echo isset($cruise_info[$language['language_id']]['intro']) ? $cruise_info[$language['language_id']]['intro'] : ''; ?></textarea>
			</td>
		  </tr>
          <tr>
			<td> Cruise category:</td>
			<td>
            <select name="cruise_category[<?php echo $language['language_id']; ?>]">
            <?php foreach($categorys[$language['language_id']] as $category){?>
            	<option value="<?php echo $category['item_id'];?>" <?php echo isset($cruise_info[$language['language_id']]['category'])?($category['item_id']==$cruise_info[$language['language_id']]['category']?'selected="selected"':''):'';?> ><?php echo $category['title'];?></option>
            <?php }?>
            </select>
			</td>
		  </tr>
          <tr>
			<td> Link to other website:</td>
			<td>
            <input name="cruise_website[<?php echo $language['language_id']; ?>]" value="<?php echo isset($cruise_info[$language['language_id']]['website']) ? $cruise_info[$language['language_id']]['website'] : ''; ?>" size="100"/>
			</td>
		  </tr>
          <tr>
			<td> Use custom link:</td>
			<td>
            <select name="cruise_custom_link[<?php echo $language['language_id']; ?>]">
            	<option value="no" <?php echo isset($cruise_info[$language['language_id']]['custom_link'])?($cruise_info[$language['language_id']]['custom_link']=="no"?'selected="selected"':''):'';?> >No</option>
                <option value="yes" <?php echo isset($cruise_info[$language['language_id']]['custom_link'])?($cruise_info[$language['language_id']]['custom_link']=="yes"?'selected="selected"':''):'';?> >Yes</option>
            </select>
			</td>
		  </tr>
          <tr>
			<td> Cruise detail info:</td>
			<td>
            <textarea name="cruise_content[<?php echo $language['language_id']; ?>]" cols="120" rows="15"><?php echo isset($cruise_info[$language['language_id']]['content']) ? $cruise_info[$language['language_id']]['content'] : ''; ?></textarea>
			</td>
		  </tr>
		  <tr>
			<td onclick="select_image('cruise_image[<?php echo $language['language_id']; ?>]');"> Cruise image:<br />(Click here to select image)</td>
			<td><input type="hidden" name="cruise_image[<?php echo $language['language_id']; ?>]" value="<?php echo isset($cruise_info[$language['language_id']]['image_url']) ? $cruise_info[$language['language_id']]['image_url'] : ''; ?>" />
				<img src="<?php echo isset($cruise_info[$language['language_id']]['image_url']) ? HTTP_HOME.'uploads/images/'.$cruise_info[$language['language_id']]['image_url'] : ''; ?>"  alt="" data-href="cruise_image[<?php echo $language['language_id']; ?>]" class="image" />
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

<!--editor-->
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('cruise_content[<?php echo $language['language_id']; ?>]', {
	filebrowserBrowseUrl : "elfinder/elfinder.html",
});
<?php }?>
//--></script>

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
//--></script> 
<?php echo $footer; ?>