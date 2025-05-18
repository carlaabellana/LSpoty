<!--background of the popup -->
<div id = "popUp" class="popUp-close" >
    <!--popup-->
    <div id="popUpBox">
        <div id="head">
            <h3><?= lang('Homepage.save_track')?></h3>
            <!--closing button-->
            <button type="button" onclick="closePopUp()"> x </button>
        </div>
        <!--list with the user's playlists, when form is submited track is saved via ajax.-->
        <form id="playlists" >
            <div id="playlistsNames">
                <input type="hidden" name="trackId" id="trackId">
                <select  name="playlist">
                    <!--generate a list with all playlists-->
                    <?php foreach($PlaylistNames as $key => $name){
                        echo '<option value="'.$PlaylistIds[$key].'">'.$name.'</option>';
                    }?>
                </select>
            </div>
            <button type="submit" onclick="closePopUp()"><?=lang('Homepage.add_to_playlist')?></button>
        </form>
        <div id="response"></div>
    </div>
</div>