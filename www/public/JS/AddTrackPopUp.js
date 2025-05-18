
//ajax put function
$(document).ready(function() {
    $('#playlists').submit(function(event) {
        event.preventDefault();
        let payload = {
            idTrack: $('input[name=trackId]').val(),
            idPlaylist: $('select[name=playlist]').val()
        };
        console.log($('input[name=trackId]').val());
        console.log($('select[name=playlist]').val());

        let url = '/my-playlists/'+payload.idPlaylist+'/track/'+payload.idTrack;

        $.ajax({
            type: 'PUT',
            url: url,
            contentType: 'application/json;charset=utf-8',
            data: JSON.stringify(payload),
            dataType: 'json'
        })
            .done(function (data){
                $('#response').html('<p class="success">' + data.responseData + '</p>');
            })
            .fail(function (jqXHR){
                //let errors = jqXHR.responseJSON.errors;
                //let errorHtml = '<ul>';
                //$.each(errors, function(field, error) {
                //    errorHtml += '<li>' + error + '</li>';
                //});
                //errorHtml += '</ul>';
                //$('#response').html('<p class="error">Errors occurred:</p>');
            });
    });
});

//shows the popup and assigns the correct track id
function openPopUp(trackID){
    let popup = document.getElementById("popUp");
    popup.classList.remove("popUp-close");
    popup.classList.add("popUp-open");
    let trackId = document.getElementById("trackId");
    trackId.value = trackID;
}

//hides the popup
function closePopUp(){
    let popup = document.getElementById("popUp");
    popup.classList.remove("popUp-open")
    popup.classList.add("popUp-close");
}


