var ajaxHandler = {};
var serviceBase = "http://localhost/voting-server/server/apis/";

ajaxHandler.get = function(uri){
	var test;
	var resource = $.ajax({
		url: serviceBase + uri,
		method: "GET",
		success: function(res){
			console.log(res);
			test = res;
			console.log(test);
		},
		error: function(x){
			console.log(x);
			test = x;

		}
	});
	
	return resource;
};

ajaxHandler.post = function(uri, obj){
	var resp;
	return $.ajax({
		url: serviceBase + uri,
		method: "POST",
		dataType: "JSON",
		data: JSON.stringify(obj),
		success: function(res){
			// return res;
			resp = res;
			return resp;
		},
		error: function(x,s,e){
			// return x;
			resp = x;
			return resp;
		}
	});/*
	console.log(resp);
	return resource*/
}