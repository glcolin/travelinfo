<?php echo $header; ?>
<div id="content">

  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?> 
   
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  <input type="hidden" name="article_id" value="<?php echo isset($this->request->get['article_id'])?$this->request->get['article_id']:""?>" />
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" /> <?php echo $article_info[1]['title']; ?> </h1>
	  
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
			<td> Title:</td>
			<td>
				<?php echo $article_info[$language['language_id']]['title']; ?>
			</td>
		  </tr>
          <tr>
			<td> Content:</td>
			<td>
            <textarea name="article_content[<?php echo $language['language_id']; ?>]" cols="150" rows="7"><?php echo isset($article_info[$language['language_id']]['content']) ? $article_info[$language['language_id']]['content'] : ''; ?></textarea>
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

<!--editor-->
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('article_content[<?php echo $language['language_id']; ?>]', {
	filebrowserBrowseUrl : "elfinder/elfinder.html",
});
<?php }?>
//--></script>

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
//--></script> 

<?php echo $footer; ?>