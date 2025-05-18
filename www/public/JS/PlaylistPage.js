document.addEventListener('DOMContentLoaded', () => {
    const btn = document.querySelector('.add-playlist');
    if (!btn) return;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log('Script cargado');
    btn.addEventListener('click', async () => {
        console.log('Botón clicado');

        const id = btn.dataset.id;
        const name = btn.dataset.name;
        const cover = btn.dataset.cover;

        const formData = new FormData();
        formData.append('playlist_name', name);
        formData.append('cover_url', cover);
        formData.append('is_external', 'true');

        for (let pair of formData.entries()) {
            console.log(`${pair[0]}: ${pair[1]}`);
        }

        const response = await fetch(`/save-from-jamendo/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'X-HTTP-Method-Override': 'PUT'
            },
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            btn.disabled = true;
            btn.textContent = 'Guardado';
        } else {
            alert('Error: ' + (result.error || 'No se pudo guardar'));
        }
    });
});
