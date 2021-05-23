const input_select_type_div = document.querySelector("#provider_select_type_div")
const input_select_format = document.querySelector("#provider_media_format")
let input_select_type = document.querySelector("#provider_media_type")
const input_optionnel_div = document.querySelector("#provider_optionnel")
let input_contenu_div = document.querySelector("#provider_contenu")

function changeSelectType() {
    let currentFormat = input_select_format.value;

    switch (currentFormat) {
        case 'format_livre':
            this.getSelectToLivre()
            this.setOptionnelToLivre()
            break;
        case 'format_film':
            this.getSelectToFilm()
            this.setOptionnelToFilm()
            break;
        case 'format_audio':
            this.getSelectToAudio()
            this.setOptionnelToAudio()
            break;
        case 'format_periodique':
            this.getSelectToPeriodique()
            this.setOptionnelToPeriodique()
            break;
        default:
            console.log('No such case for the format')
    }
}

function getSelectToLivre() {
    input_select_type_div.removeChild(input_select_type)
    let newSelect = document.createElement('select')
    newSelect.setAttribute("name", "provider_media_type")
    newSelect.id = "provider_media_type"
    let newOption_1 = document.createElement('option')
    newOption_1.value = "type_livre_roman"
    newOption_1.appendChild(document.createTextNode('Roman'))
    newSelect.appendChild(newOption_1)
    let newOption_2 = document.createElement('option')
    newOption_2.value = "type_livre_essai"
    newOption_2.appendChild(document.createTextNode('Essai'))
    newSelect.appendChild(newOption_2)
    let newOption_3 = document.createElement('option')
    newOption_3.value = "type_livre_dictionnaire"
    newOption_3.appendChild(document.createTextNode('Dictionnaire'))
    newSelect.appendChild(newOption_3)
    let newOption_4 = document.createElement('option')
    newOption_4.value = "type_livre_nouvelle"
    newOption_4.appendChild(document.createTextNode('Nouvelle'))
    newSelect.appendChild(newOption_4)
    let newOption_5 = document.createElement('option')
    newOption_5.value = "type_livre_conte"
    newOption_5.appendChild(document.createTextNode('Conte'))
    newSelect.appendChild(newOption_5)
    let newOption_6 = document.createElement('option')
    newOption_6.value = "type_livre_theatre"
    newOption_6.appendChild(document.createTextNode('Théâtre'))
    newSelect.appendChild(newOption_6)
    let newOption_7 = document.createElement('option')
    newOption_7.value = "type_livre_fable"
    newOption_7.appendChild(document.createTextNode('Fable'))
    newSelect.appendChild(newOption_7)
    let newOption_8 = document.createElement('option')
    newOption_8.value = "type_livre_poesie"
    newOption_8.appendChild(document.createTextNode('Poésie'))
    newSelect.appendChild(newOption_8)
    


    input_select_type_div.appendChild(newSelect)
    input_select_type = document.querySelector("#provider_media_type")
}
function getSelectToFilm() {
    input_select_type_div.removeChild(input_select_type)
    let newSelect = document.createElement('select')
    newSelect.setAttribute("name", "provider_media_type")
    newSelect.id = "provider_media_type"

    let newOption_1 = document.createElement('option')
    newOption_1.value = "type_film_long"
    newOption_1.appendChild(document.createTextNode('Long métrage'))
    newSelect.appendChild(newOption_1)
    let newOption_2 = document.createElement('option')
    newOption_2.value = "type_film_court"
    newOption_2.appendChild(document.createTextNode('Court métrage'))
    newSelect.appendChild(newOption_2)
    let newOption_3 = document.createElement('option')
    newOption_3.value = "type_film_moyen"
    newOption_3.appendChild(document.createTextNode('Moyen métrage'))
    newSelect.appendChild(newOption_3)


    input_select_type_div.appendChild(newSelect)
    input_select_type = document.querySelector("#provider_media_type")
}
function getSelectToAudio() {
    input_select_type_div.removeChild(input_select_type)
    let newSelect = document.createElement('select')
    newSelect.setAttribute("name", "provider_media_type")
    newSelect.id = "provider_media_type"

    let newOption_1 = document.createElement('option')
    newOption_1.value = "type_audio_mp3"
    newOption_1.appendChild(document.createTextNode('MP3'))
    newSelect.appendChild(newOption_1)
    let newOption_2 = document.createElement('option')
    newOption_2.value = "type_audio_vinyle"
    newOption_2.appendChild(document.createTextNode('Vinyle'))
    newSelect.appendChild(newOption_2)
    let newOption_3 = document.createElement('option')
    newOption_3.value = "type_audio_cd"
    newOption_3.appendChild(document.createTextNode('CD'))
    newSelect.appendChild(newOption_3)

    input_select_type_div.appendChild(newSelect)
    input_select_type = document.querySelector("#provider_media_type")
}
function getSelectToPeriodique() {
    input_select_type_div.removeChild(input_select_type)
    let newSelect = document.createElement('select')
    newSelect.setAttribute("name", "provider_media_type")
    newSelect.id = "provider_media_type"

    let newOption_1 = document.createElement('option')
    newOption_1.value = "type_periodique_mensuel"
    newOption_1.appendChild(document.createTextNode('Mensuel'))
    newSelect.appendChild(newOption_1)
    let newOption_2 = document.createElement('option')
    newOption_2.value = "type_periodique_quotidien"
    newOption_2.appendChild(document.createTextNode('Quotidien'))
    newSelect.appendChild(newOption_2)
    let newOption_3 = document.createElement('option')
    newOption_3.value = "type_periodique_hebdomadaire"
    newOption_3.appendChild(document.createTextNode('Hebdomadaire'))
    newSelect.appendChild(newOption_3)
    let newOption_4 = document.createElement('option')
    newOption_4.value = "type_periodique_trimenstriel"
    newOption_4.appendChild(document.createTextNode('Trimestriel'))
    newSelect.appendChild(newOption_4)
    let newOption_5 = document.createElement('option')
    newOption_5.value = "type_periodique_semestriel"
    newOption_5.appendChild(document.createTextNode('Semestriel'))
    newSelect.appendChild(newOption_5)
    let newOption_6 = document.createElement('option')
    newOption_6.value = "type_periodique_annuel"
    newOption_6.appendChild(document.createTextNode('Annuel'))
    newSelect.appendChild(newOption_6)

    input_select_type_div.appendChild(newSelect)
    input_select_type = document.querySelector("#provider_media_type")
}

function setOptionnelToLivre() {
    input_optionnel_div.removeChild(input_contenu_div)
    let newDiv = document.createElement('div')
    newDiv.id = "provider_contenu"

    let newLabel_1 = document.createElement('label')
    newLabel_1.setAttribute("for", "provider_media_editor")
    newLabel_1.appendChild(document.createTextNode("Editeur"))
    newDiv.appendChild(newLabel_1)
    let newInput_1 = document.createElement('input')
    newInput_1.setAttribute("type", "text")
    newInput_1.id = "provider_media_editor"
    newInput_1.name = "provider_media_editor"
    newDiv.appendChild(newInput_1)

    let newLabel_2 = document.createElement('label')
    newLabel_2.setAttribute("for", "provider_media_edition")
    newLabel_2.appendChild(document.createTextNode("Edition"))
    newDiv.appendChild(newLabel_2)
    let newInput_2 = document.createElement('input')
    newInput_2.setAttribute("type", "number")
    newInput_2.setAttribute("min", "0")
    newInput_2.setAttribute("step", "1")
    newInput_2.id = "provider_media_edition"
    newInput_2.name = "provider_media_edition"
    newDiv.appendChild(newInput_2)

    input_optionnel_div.appendChild(newDiv)
    input_contenu_div = document.querySelector("#provider_contenu")
}

function setOptionnelToAudio() {
    input_optionnel_div.removeChild(input_contenu_div)
    let newDiv = document.createElement('div')
    newDiv.id = "provider_contenu"

    let newLabel_1 = document.createElement('label')
    newLabel_1.setAttribute("for", "provider_media_editor")
    newLabel_1.appendChild(document.createTextNode("Editeur"))
    newDiv.appendChild(newLabel_1)
    let newInput_1 = document.createElement('input')
    newInput_1.setAttribute("type", "text")
    newInput_1.id = "provider_media_editor"
    newInput_1.name = "provider_media_editor"
    newDiv.appendChild(newInput_1)

    let newLabel_2 = document.createElement('label')
    newLabel_2.setAttribute("for", "provider_media_edition")
    newLabel_2.appendChild(document.createTextNode("Edition"))
    newDiv.appendChild(newLabel_2)
    let newInput_2 = document.createElement('input')
    newInput_2.setAttribute("type", "number")
    newInput_2.setAttribute("min", "0")
    newInput_2.setAttribute("step", "1")
    newInput_2.id = "provider_media_edition"
    newInput_2.name = "provider_media_edition"
    newDiv.appendChild(newInput_2)

    let newLabel_3 = document.createElement('label')
    newLabel_3.setAttribute("for", "provider_duration")
    newLabel_3.appendChild(document.createTextNode("Durée (en minutes)"))
    newDiv.appendChild(newLabel_3)
    let newInput_3 = document.createElement('input')
    newInput_3.setAttribute("type", "number")
    newInput_3.setAttribute("min", "0")
    newInput_3.setAttribute("step", "1")
    newInput_3.id = "provider_media_duration"
    newInput_3.name = "provider_media_duration"
    newInput_3.required = true;
    newDiv.appendChild(newInput_3)

    input_optionnel_div.appendChild(newDiv)
    input_contenu_div = document.querySelector("#provider_contenu")
}

function setOptionnelToFilm() {
    input_optionnel_div.removeChild(input_contenu_div)
    let newDiv = document.createElement('div')
    newDiv.id = "provider_contenu"

    let newLabel_1 = document.createElement('label')
    newLabel_1.setAttribute("for", "provider_media_productor")
    newLabel_1.appendChild(document.createTextNode("Producteur"))
    newDiv.appendChild(newLabel_1)
    let newInput_1 = document.createElement('input')
    newInput_1.setAttribute("type", "text")
    newInput_1.id = "provider_media_productor"
    newInput_1.name = "provider_media_productor"
    newDiv.appendChild(newInput_1)

    let newLabel_2 = document.createElement('label')
    newLabel_2.setAttribute("for", "provider_duration")
    newLabel_2.appendChild(document.createTextNode("Durée (en minutes)"))
    newDiv.appendChild(newLabel_2)
    let newInput_2 = document.createElement('input')
    newInput_2.setAttribute("type", "number")
    newInput_2.setAttribute("min", "1")
    newInput_2.setAttribute("step", "1")
    newInput_2.id = "provider_media_duration"
    newInput_2.name = "provider_media_duration"
    newInput_2.required = true;
    newDiv.appendChild(newInput_2)

    input_optionnel_div.appendChild(newDiv)
    input_contenu_div = document.querySelector("#provider_contenu")
}

function setOptionnelToPeriodique() {
    input_optionnel_div.removeChild(input_contenu_div)
    let newDiv = document.createElement('div')
    newDiv.id = "provider_contenu"

    let newLabel_1 = document.createElement('label')
    newLabel_1.setAttribute("for", "provider_media_editor")
    newLabel_1.appendChild(document.createTextNode("Editeur"))
    newDiv.appendChild(newLabel_1)
    let newInput_1 = document.createElement('input')
    newInput_1.setAttribute("type", "text")
    newInput_1.id = "provider_media_editor"
    newInput_1.name = "provider_media_editor"
    newDiv.appendChild(newInput_1)

    input_optionnel_div.appendChild(newDiv)
    input_contenu_div = document.querySelector("#provider_contenu")
}

//function to store the file
