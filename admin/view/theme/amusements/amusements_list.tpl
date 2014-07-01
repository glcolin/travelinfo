<?php echo $header; ?>
<div id="content">
  
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
  	<div class="heading">
      <h1><img src="view/image/product.png" alt="" /> <?php echo "Amusements"; ?></h1>
      <div class="buttons"><a href="<?php echo $insert; ?>" class="button">Add</a><a onclick="delete_action();" class="button">Delete</a></div>
    </div>
	<div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
      <textarea id="sort_string" name="sort_string" style="display:none;"></textarea>
        <table class="list">
          <thead>
            <tr>
            	<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
                <td class="center" width="150px">Image</td>
                <td class="center" width="300px">Title</td>
                <td class="center" width="300px">Category</td>
                <td class="center">Create_date</td>
                <td class="center">Update_date</td>
                <td class="right"><?php echo "Action"; ?></td>
            </tr>
          </thead>
          <tbody>
          	<tr class="filter">
              <td></td>
              <td></td>
              <td></td>
			  <td class="center">
              	<select name="category">
                	<option value=""></option>
              	<?php foreach($categorys as $category_data){?>
                	<option value="<?php echo $category_data['item_id'];?>" <?php echo $category_data['item_id']==$category?'selected="selected"':'';?>><?php echo $category_data['title'];?></option>
                <?php }?>
                </select>
              </td>
              <td></td>
              <td></td>
              <td align="right"><a onclick="filter();" class="button"><?php echo "Filter"; ?></a></td>
            </tr>
          
          <?php if ($amusements) { ?>
          <?php foreach ($amusements as $amusement) { ?>
          	<tr>
            <td style="text-align: center;">
                <input type="checkbox" name="selected[]" value="<?php echo $amusement['info']['id']; ?>" />
                <input type="hidden" name="pid" value="<?php echo $amusement['info']['id']; ?>" />
            </td>
            <td class="center"><img src="<?php echo $amusement['image']?>" style="padding: 1px; border: 1px solid #DDDDDD;"/></td>
            <td class="center"><?php echo $amusement['info']['title']?></td>
            <td class="center"><?php echo $amusement['info']['category_title']?></td>
            <td class="center"><?php echo $amusement['info']['create_date']?></td>
            <td class="center"><?php echo $amusement['info']['update_date']?></td>
            <td class="right"><?php foreach ($amusement['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
          <?php }?>
          <?php }?>
          </tbody>
        </table>
      </form>
     </div>           
  </div>
</div>

<script src="<?php echo HTTP_SERVER?>view/javascript/json.js"></script>
<script type="text/javascript">
$("#form tbody").sortable({
	items: "tr",
	stop: function(){
		save_sort();
	},
	placeholder: "ui-state-highlight",
	helper: "clone",
	tolerance: "pointer"
});

function save_sort(){
	var sort_arr=[];
	$('#form tbody [name="pid"]').each(function(){
		sort_arr.push($(this).val());
	})
	$("#sort_string").val(JSON.encode(sort_arr));
	
	$.ajax({
		type: 'post',
		url : 'index.php?route=amusements/amusements/saveSort',
		dataType : "html",
		data: {
			   sort_string : JSON.encode(sort_arr)
		},
		success: function (data) {
		
		}
	});
}

function delete_action(){
	if($('#form tbody input[type="checkbox"]:checked').size()>0){
		$('form').submit();
	}
	else{
		alert("Please choose an item to delete.");
	}
}

function filter() {
	url = 'index.php?route=amusements/amusements';
	
	var category = $("select[name='category']").attr('value');
	
	if (category) {
		url += '&category=' + encodeURIComponent(category);
	}
	
	location = url;
}
</script>
 
<?php echo $footer; ?>