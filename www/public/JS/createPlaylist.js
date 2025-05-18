document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createPlaylistForm');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const name = form.querySelector('input[name="playlist_name"]').value;
        const image = form.querySelector('input[name="playlist_image"]').files[0];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (!name.trim()) {
            alert('El nombre es obligatorio');
            return;
        }

        const formData = new FormData();
        formData.append('playlist_name', name);
        if (image) {
            formData.append('playlist_image', image);
        }

        const generatedId = crypto.randomUUID();

        const response = await fetch(`/my-playlists/${generatedId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            alert('Playlist creada correctamente');
            window.location.href = '/my-playlists';
        } else {
            alert('Error: ' + (result.error || 'No se pudo crear la playlist'));
        }
    });
});
