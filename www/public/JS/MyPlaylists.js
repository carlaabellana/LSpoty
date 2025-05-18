document.addEventListener('DOMContentLoaded', function () {
    // cargar los detalles de la playlist
    const playlistCards = document.querySelectorAll('.playlist-card');
    playlistCards.forEach(card => {
        card.addEventListener('click', function () {
            const playlistId = this.dataset.id;

            fetch(`/my-playlists/ajax/${playlistId}`)
                .then(response => {
                    if (!response.ok) throw new Error('Acceso denegado');
                    return response.text();
                })
                .then(html => {
                    document.getElementById('playlist-detail').innerHTML = html;

                    // Cargar CSS
                    if (!document.querySelector('link[href="/CSS/MyPlaylists_detail_styles.css"]')) {
                        const link = document.createElement('link');
                        link.rel = 'stylesheet';
                        link.href = '/CSS/MyPlaylists_detail_styles.css';
                        document.head.appendChild(link);
                    }

                    // delete playlist
                    const deleteBtn = document.querySelector('#delete-playlist-btn');
                    if (deleteBtn) {
                        deleteBtn.addEventListener('click', function () {
                            const playlistId = this.dataset.id;
                            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                            if (confirm('¿Seguro que quieres eliminar esta playlist?')) {
                                fetch(`/my-playlists/${playlistId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            alert('Playlist eliminada correctamente');
                                            location.reload();
                                        } else {
                                            alert('Error: ' + data.error);
                                        }
                                    });
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('No se pudo cargar la playlist.');
                });
        });
    });
});
