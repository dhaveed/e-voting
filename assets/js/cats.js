$(document).ready(function(){
	var base = "http://graybot.dev/voting-server/server/apis/";
	$.ajax({
		url: base + 'categories',
		method: 'GET',
		success: function(res){
			if(res.status == "success"){
				console.log(JSON.stringify(res.categories));
				for(var i in res.categories){
					$("#categories-container").append(`
						<li class="grid-item">
				        <div class="card card-night"></div>
				        <div class="status">
				        	<p style="word-break: break-all;">
				        		${res.categories[i].name}
				        	</p>
				        	<p style="word-break: break-all;">
				        		Candidates: ${res.categories[i].nominees}
				        	</p>
				        </div>
				     </li>
					`);
				}
			}
		},
		error: function(e,s,x){
			console.log(e);
		}
	})
})