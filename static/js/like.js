function like_click(id){
	var data = Object();
	data["id"] = id;
	var json = JSON.stringify(data);
	$.post("./phplib/ajax.php", {
		"method":"aj_like",
		"args": json
	},function(data, status){
		console.log(data);
		var result = JSON.parse(data);
		if (result['code'] == 0){
			var num = parseInt($('#like_num' + id).text()) + 1;
			$('#like_num' + id).text(num);
		}
	});
}