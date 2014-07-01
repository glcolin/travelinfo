<?php echo $header; ?>
<div id="content">

  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?> 
   
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
  <input type="hidden" name="friendlink_id" value="<?php echo isset($this->request->get['friendlink_id'])?$this->request->get['friendlink_id']:""?>" />
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" />Friendlink </h1>
	  
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
			<td> Friendlink title:</td>
			<td><input name="friendlink_title[<?php echo $language['language_id']; ?>]" value="<?php echo isset($friendlink_info[$language['language_id']]['title']) ? $friendlink_info[$language['language_id']]['title'] : ''; ?>"/>
			</td>
		  </tr>
          <tr>
			<td> Friendlink link:</td>
			<td><input name="friendlink_link[<?php echo $language['language_id']; ?>]" value="<?php echo isset($friendlink_info[$language['language_id']]['link']) ? $friendlink_info[$language['language_id']]['link'] : ''; ?>" size="100"/>
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

<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
//--></script> 
<?php echo $footer; ?>