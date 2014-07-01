$(function(){
	var ids_str=$("#compare_ids").val();
	set_select_compare_items(ids_str);

	$('input[name="compare_options"]').click(function(){
		var object=$(this);
		$.ajax({
			type: 'post',
			url : 'index.php?route=common/ajax/set_compare_id',
			dataType : "text",
			data: {
				   class_type : $("#class_type").val(),
				   id : object.val(),
				   status : object.attr('checked')
			},
			success: function (data) {
				if(data!="false"){
					$("#compare_ids").val(data);
					set_select_compare_items(data);
				}
				else{
					object.removeAttr("checked");
					alert("You can't compare more than 3 items.");
				}
			}
		});
	});
	
	$(".compareNowButton").click(function(){
		window.location.href = "./index.php?route=" + $("#class_type").val() + "/compare&ids=" + $("#compare_ids").val();
	});
})

function set_select_compare_items(ids_str){
	var ids=ids_str.split(',');
	
	if(ids_str){
		$(".ids_count").text(ids.length);
	}
	else{
		$(".ids_count").text(0);
	}
	
	$.each($('input[name="compare_options"]'), function(i,val){ 
		if(in_array($(val).val(),ids)){  
			$(val).attr("checked", true);
		}
	});
}

function in_array(search_value,search_array){
	var sign=false;
	$.each(search_array, function(i,val){  
		if(search_value==val){
			sign=true;
			return false;
		}
	});
	return sign;
}