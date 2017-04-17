$(document).ready(function(){
	$('.sign').hide();

 	$('.sign-up').click(function(){
		$('.log').hide();
		$('.sign').show();
	});

	$('.login').click(function(){
		$('.sign').hide();
		$('.log').show();
	});

	$('#login-form').on('submit', function(evt){
		evt.preventDefault();
	});

	

	$('#login-btn').on('click', function(){
		var formData = {
			matricnumber: $('#matnum').val(),
			password: $('#pwd').val()
		}

		/*var doLogin = ajaxHandler.post('login', formData);
		console.log(doLogin);*/

		console.log(ajaxHandler.get('session'));


		/*$.ajax({
			url: "http://localhost/voting-server/server/apis/login",
			method: 'POST',
			dataType:'json',
			data: JSON.stringify(formData),
			success: function(res){
				var msg = JSON.stringify(res.message);
				$('.hide').removeClass();
				$('#login-msg').text(msg);				
				$('#login-msg').removeClass('alert-warning');
				$('#login-msg').addClass('alert-success');
			},
			error: function(x){
				var msg = JSON.stringify(res.message)
			console.log(JSON.stringify(e));
				$('#login-msg').text(msg);
				$('#login-msg').removeClass('alert-warning');
				$('#login-msg').addClass('alert-danger');
			}
        });*/



	});

	$('#reg-form').on('submit', function(evt){
		evt.preventDefault();
	})

	$('#reg-btn').on('click', function(){
		var regForm = {
			fullname: $('#reg-name').val(),
			matricnumber: $('#reg-matnum').val(),
			email: $('#reg-email').val(),
			password: $('#reg-pwd').val()
		}

		/*$.ajax({
			method: "POST",
			url: "http://localhost/voting-server/server/apis/join",
			dataType: 'JSON',
			data: regForm,
			success: function(res){
				console.log(res);
				$('#reg-msg').html(res);
			},
			error: function(res){
				console.log(res);
				$('#reg-msg').html(res);
				$('#reg-msg').removeClass('alert-warning');
				$('#reg-msg').addClass('alert-danger');
			}
		});*/

		$.ajax({
			url: "http://localhost/voting-server/server/apis/join",
			method: 'POST',
			dataType:'json',
			data: JSON.stringify(regForm),
			success: function(res){
				var msg = JSON.stringify(res.message);
				$('.hidden').removeClass();
				$('#reg-msg').text(msg);
				console.log(res);
			},
			error: function(x,s,e){
				var msg = JSON.stringify(e.message);
			console.log(e);
				$('#reg-msg').text(msg);
				$('#reg-msg').removeClass('alert-warning');
				$('#reg-msg').addClass('alert-danger');
			}
        });
	});



	//----------- Ajax haendler -----
	$('#getCategories').click(function(){
		ajaxHandler.get('categories');
	});
});