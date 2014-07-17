/**
 *	过滤数据
 */ 
function filterItem()
{
	secondfilterItem(global_json_item);
	
//	if(typeof json_item != 'undefined'){
//		secondfilterItem(json_item);
//	}else{
//		json_item = 0;
//		$.getJSON('js/item.json',{}, function(data){
//			json_item = eval(data);
//			secondfilterItem(json_item);
//		});
//	}
}
function secondfilterItem(json_item)
{
	var item_arr = json_item;
	// 分类
	var Category = getConditions($(".tag1 ul li"));
	// 标签
	var itemTags = getConditions($(".tag2 ul li"));
	// 存储新数据的数组
	var new_arr = new Array();
	var k=0;
	// 遍历所有数据进行过滤
	var ilength = item_arr.length;
	for(var i=0; i<ilength; i++){
		var category_state = false;
		var itemTags_state =false;
		// 判断分类是否存在
		if(Category != 0){
			var isex = isExistsArr(Category, item_arr[i]['Category']);
			if(isex){
				category_state = true;
			}else{
				continue;
			}
		}else{
			category_state = true;
		}
		// 判断标签
		if(itemTags != 0){
			var itemShopTags_arr = item_arr[i]['ItemShopTags'].split(',');
			var tags_length = itemShopTags_arr.length;
			for(var j=0; j<tags_length; j++){
				var itex = isExistsArr(itemTags, itemShopTags_arr[j]);
				if(itex){
					itemTags_state = true;
					break;
				}
			}
			if(itemTags_state == false){
				continue;
			}
		}else{
			itemTags_state = true;	
		}
		if(category_state == true && itemTags_state == true){
			new_arr[k] = item_arr[i];
			k++;
		}
	}
	showItemPic(new_arr);
	setMouseOver();
}
/**
 * 过滤图片
 */
function showItemPic(item_arr)
{
	var newPicItem = new Array();
	var ilength = item_arr.length;
	for(var i=0; i<ilength; i++){
		newPicItem[i] = item_arr[i]['name'];
	}
	$(".icon-box li").each(function(){
		var pic_alt = $(this).find(".pic-item").get(0).alt;
		var isExists = isExistsArr(newPicItem, pic_alt);
		if(!isExists){
			$(this).addClass("unselected");
		}else{
			$(this).removeClass("unselected");
		}
	});
}
/**
 *	获取分类
 *	obj dom对象  
 */
function getConditions(obj)
{
	var condition_arr = new Array();
	var i=0;
	var conditions = 0;
	obj.each(function(){
		if($(this).find(".box").css('display') != 'none'){
			condition_arr[i] = $(this).find('.link').html();
			i++;
		}
	});
	if(condition_arr.length > 0 && condition_arr.length < obj.length){
		return  condition_arr;
	}
	return conditions;
}
/**
 *	用于判断值是否存在数组中
 *  arr_obj array  查找的数组above
 *  val  被查找的值
 */
function isExistsArr(arr_obj, val)
{
	if((typeof arr_obj != 'undefined') && (typeof val != 'undefined'))
	{
		var olength = arr_obj.length;
		for(var i=0; i<olength; i++){
			if(val == arr_obj[i]){
				return true;
			}
		}
	}
	return false;
}