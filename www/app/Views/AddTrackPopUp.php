<div id = "popUp" class="popUp-close" >
    <div id="popUpBox">
        <div id="head">
            <h3>Add to your playlists</h3>
            <button type="button" onclick="closePopUp()"> x </button>
        </div>
        <form id="playlists" action="<?= site_url("my-playlists/")?>" method="PUT">
            <div id="playlistsNames">
                <select>
                <?php foreach($PlaylistNames as $key => $name){
                    echo '<option name="playlist" value="'.$key.'">'.$name.'</option>';
//                    echo '<div><label>'.$name.'</label>';
//                    echo '<input type="checkbox" name="selected_playlists" value="'.$PlaylistIds[$key].'"></div>';
                }?>
                </select>
            </div>
            <button type="submit" onclick="closePopUp()">Save</button>
        </form>
    </div>
</div>