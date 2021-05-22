let oldCell = null
let selectedDate = null
let isMorning = null

function selectDate(cell, date, morning) {
	if(oldCell != null) {
		$(oldCell).css("background", "green")
	}

	$(cell).css("background", "rgb(0, 255, 100)")	
	
	oldCell = cell
	selectedDate = date
	isMorning = morning
}

function bookRoom(number, cid) {
	if(selectedDate == null) {
		$(".valid").html()
		$(".error").html("Veuillez sélectionner une date sur le calendrier")
	} else {		
		$.ajax({
		method: "GET",
		url: "model/jsResponse/bookRoom.php",
		dataType: "json",
		data: {
			"number": number,
			"cid": cid,
			"sheduledDate": selectedDate,
			"morning": isMorning
		}
		}).done(function(res) {
			if(res === true) {
				$(oldCell).css("background", "red")
				oldCell = null
				selectedDate = null
				isMorning = null
				$(".error").html("")
				$(".valid").html("Votre réservation à bien été pris en compte pour le " + selectedDate)
			} else {
				$(".valid").html("")
				$(".error").html(res)
			}	
		}).fail(function(e) {
			console.log("Error: booking room")
			console.log(e)
			$(".valid").html("")
			$(".error").html("Une erreur à eu lieu durant votre réservation merci d'essayer plutard")
		})
	}
		
}