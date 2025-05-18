<div id = "popUp" class="popUp-close" >
    <div id="popUpBox">
        <div id="head">
            <h3>Add to your playlists</h3>
            <button type="button" onclick="closePopUp()"> x </button>
        </div>
        <form id="playlists" >
            <div id="playlistsNames">
                <input type="hidden" name="trackId" id="trackId">
                <select  name="playlist">
                <?php foreach($PlaylistNames as $key => $name){
                    echo '<option value="'.$PlaylistIds[$key].'">'.$name. $PlaylistIds[$key].'</option>';
                }?>
                </select>
            </div>
            <button type="submit" onclick="closePopUp()">Save</button>
        </form>
        <div id="response"></div>
    </div>
</div>