//The app will wait until the DOM is fully loaded before running the script.
document.addEventListener('DOMContentLoaded', () => {

    //Here we collect the playlist from the JSON array we built on the view.
    const playlist = window.playlistData || [];
    //Index of the playlist (current track).
    let   list_Index = 0;
    //Var to indicate if we want to repeat the playlist.
    let   to_Repeat = false;

    //Here we take references for each element to reproduce the songs.
    const song_audio    = document.getElementById('audio-player');
    const btn_Play      = document.getElementById('play-btn');
    const btn_Prev      = document.getElementById('prev-btn');
    const btn_Next      = document.getElementById('next-btn');
    const btn_Repeat    = document.getElementById('repeat-btn');
    const bar_Progress  = document.getElementById('progress-bar');

    //If some element is missing we will return, with an error.
    if (!song_audio || !btn_Play || !btn_Prev || !btn_Next || !btn_Repeat || !bar_Progress) {
        console.error('Missing audio or control elements');
        return;
    }

    //Method that updates the audio source and the track index.
    function loadTrack(idx) {
        const track = playlist[idx];
        song_audio.src   = track.url;
        song_audio.load();
        btn_Play.textContent = '▶';
    }

    //Handler to control play and pause of the audio.
    btn_Play.addEventListener('click', () => {
        //If paused the icon is updated and try to reproduce track.
        if (song_audio.paused) {
            song_audio.play().catch(err => console.warn('Play blocked:', err));
            btn_Play.textContent = '⏸';
        //If playing update the icon and pause.
        } else {
            song_audio.pause();
            btn_Play.textContent = '▶';
        }
    });

    //If previous is clicked the index will be decremented.
    btn_Prev.addEventListener('click', () => {
        list_Index = (list_Index - 1 + playlist.length) % playlist.length;
        loadTrack(list_Index);
    });

    //If next is clicked the index will increase.
    btn_Next.addEventListener('click', () => {
        list_Index = (list_Index + 1) % playlist.length;
        loadTrack(list_Index);
    });

    //Here we indicate if the playlist has to be repeating in bucle.
    btn_Repeat.addEventListener('click', () => {
        to_Repeat = !to_Repeat;
        btn_Repeat.classList.toggle('active', to_Repeat);
    });

    //pass to next song if needed automatically.
    song_audio.addEventListener('ended', () => {
        if (to_Repeat) {
            list_Index = (list_Index + 1) % playlist.length;
            loadTrack(list_Index);
            song_audio.play().catch(err => console.warn('Play blocked:', err));
            btn_Play.textContent = '⏸';
        }
    });

    //The progress bar is updated calculating progress.
    song_audio.addEventListener('timeupdate', () => {
        if (song_audio.duration) {
            bar_Progress.value = (song_audio.currentTime / song_audio.duration) * 100;
        }
    });

    //Seek position in case the user touches the progress bar.
    bar_Progress.addEventListener('input', () => {
        if (song_audio.duration) {
            song_audio.currentTime = (bar_Progress.value / 100) * song_audio.duration;
        }
    });

    //If the playlist has tracks the default is the first one.
    if (playlist.length > 0) {
        loadTrack(0);
    }
});