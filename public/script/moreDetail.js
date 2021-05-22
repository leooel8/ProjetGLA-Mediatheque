function moreDetail(mid, format) {
	$.ajax({
		method: "GET",
		url: "model/jsResponse/moreDetail.php",
		dataType: "json",
		data: {
			"mid": mid,
			"format": format
		}
	}).done(function(res) {
		$detail = $("#moreContent")
		$detail.html("<h3>Plus de détail: </h3>")
		switch (format) {
			case "livre":
				$detail.append("<p>Editeur: " + res["editor"] + "</p>")
				$detail.append("<p>Edition: " + res["edition"] + "</p>")
				break;
			case "audio":
				$detail.append("<p>Editeur: " + res["editor"] + "</p>")
				$detail.append("<p>Edition: " + res["edition"] + "</p>")
				$detail.append("<p>Durée: " + res["duration"] + "</p>")
				break;
			case "film":
				$detail.append("<p>Producteur: " + res["productor"] + "</p>")
				$detail.append("<p>Durée: " + res["duration"] + "</p>")
				break;
			case "periodique":
				$detail.append("<p>Editeur: " + res["editor"] + "</p>")
				break;
		}
	}).fail(function(e) {
		console.log("Error: media detail")
		console.log(e)
	})
}