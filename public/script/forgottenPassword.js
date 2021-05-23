function forgottenPassword() {
	email = $("#mail").val()
	
	console.log("test: " + email);
	
	$.ajax({
		method: "GET",
		url: "model/jsResponse/forgottenPassword.php",
		dataType: "json",
		data: {
			"email": email
		}
	}).done(function(res) {
		if(res === true) {
			$(".error").html("")
			$(".valid").html("Un email à été envoyé à votre adresse email si elle existe")
		} else {
			$(".valid").html("")
			$(".error").html(res)
		}	
	}).fail(function(e) {
		console.log("Error: authenticate")
		console.log(e)
		$(".valid").html("")
		$(".error").html("Une erreur à eu lieu durant votre l'envoie du mail merci d'essayer plutard")
	})
}