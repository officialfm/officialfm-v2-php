<?php
require_once 'officialfm.php';

$ofm = new OfficialFM();

$responses = array(
    $ofm->track('1nnQ'),
    $ofm->tracks('étoile'),
    $ofm->playlists('love'),
    $ofm->playlist('2BHH'),
    $ofm->playlist_tracks('2BHH'),
    $ofm->projects('wiz khalifa'),
    $ofm->project('nqkC'),
    $ofm->project_tracks('nqkC'),
    $ofm->project_playlists('nqkC'),
);

var_dump($responses);

?>
