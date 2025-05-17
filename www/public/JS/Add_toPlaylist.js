const MESSAGES = {
    en: {
        nameRequired: 'The playlist needs a name.',
        imageType:    'Only JPG or PNG images are allowed.',
        imageSize:    'Image is too large (max 2 MB).',
        unexpected:   'An unexpected error occurred. Please try again.',
        networkError: 'Network error—please check your connection and try again.',
        created:      '🎉 Playlist created successfully!'
    },
    es: {
        nameRequired: 'La lista necesita un nombre.',
        imageType:    'Solo se permiten imágenes JPG o PNG.',
        imageSize:    'La imagen es demasiado grande (máx. 2 MB).',
        unexpected:   'Ocurrió un error inesperado. Por favor, inténtalo de nuevo.',
        networkError: 'Error de red: comprueba tu conexión e inténtalo de nuevo.',
        created:      '🎉 Lista creada correctamente!'
    },
};

//Habilite different languages.
const browserLang = (navigator.language || navigator.userLanguage || 'en').substr(0,2);
const LOCALE = MESSAGES[browserLang] ? browserLang : 'en';


// The DOM must be fully loaded before running the method.
document.addEventListener('DOMContentLoaded', () => {

    //The references from the form elements are taken to check them.
    const formularyCreate = document.getElementById('createPlaylistForm');
    const isSuccess = document.getElementById('success-message');
    const nameError= document.getElementById('playlistName-error');
    const imageError= document.getElementById('playlistImage-error');

    //We control that only the page with the defined form triggers the action.
    if (!formularyCreate) return;

    //Submit event of the form is intercepted to further analysis.
    formularyCreate.addEventListener('submit', async (ev) => {
        ev.preventDefault();
        isSuccess.textContent = '';
        nameError.textContent  = '';
        imageError.textContent = '';

        //The values of the different parts are taken.
        const nameInput = formularyCreate.querySelector('input[name="playlistname"]');
        const fileInput = formularyCreate.querySelector('input[name="playlist_image"]');
        const postedName= nameInput.value.trim();
        const postedFile = fileInput.files[0];

        //At the start is not error.
        let isError = false;

        //Check that the name is not empty.
        if (!postedName) {
            nameError.textContent = MESSAGES[LOCALE].nameRequired;
            isError = true;
        }

        //we validate if the file is correct it can be empty.
        if (postedFile) {
            //We check the extension.
            const okTypes = ['image/jpeg', 'image/png'];
            if (!okTypes.includes(postedFile.type)) {
                imageError.textContent = MESSAGES[LOCALE].imageType;
                isError = true;
            }
            //We check the size.
            if (postedFile.size > 2 * 1024 * 1024) {
                imageError.textContent = MESSAGES[LOCALE].imageSize;
                isError = true;
            }
        }

        //If there are errors we don't send AJAX
        if (isError) {
            return;
        }

        document.getElementById('playlistName-error').textContent  = '';
        document.getElementById('playlistImage-error').textContent = '';

        const formData = new FormData(formularyCreate);

        try {
            const formResponse = await fetch(formularyCreate.action, {method: 'POST', body: formData, headers: {'Accept': 'application/json'}});
            const validate = await formResponse.json();

            //In case the server has responded with errors HTTP 4--.
            if (!formResponse.ok) {
                if (validate.errors) {
                    Object.entries(validate.errors).forEach(([values, message]) => {
                        const formField = values.replace(/_errors$/, '')
                        const idValue = formField.charAt(0).toUpperCase() + formField.slice(1) + '-error';
                        const formElement = document.getElementById(idValue);
                        if (formElement) formElement.textContent = message;
                    });

                    //Fallback if unexpected error happened.
                } else {
                    alert(MESSAGES[LOCALE].unexpected);
                }
            } else {
                //The user succeed creating the playlist.
                isSuccess.textContent = MESSAGES[LOCALE].created;
                formularyCreate.reset();
            }
        } catch (err) {
            console.error('AJAX error:', err);
            alert(MESSAGES[LOCALE].unexpected);
        }
    });
});
