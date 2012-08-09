<?php
require_once 'officialfm.php';

$ofm = new OfficialFM();
?>

Track 27 of a track search for "Mac Miller":
<?php
  $tracks = $ofm->tracks('Mac Miller', array('page' => 2))->tracks;
  // 25 tracks per page
  echo $tracks[1]->title.PHP_EOL;
?>


Track '1nnQ' is <?php $track = $ofm->track('1nnQ'); echo $track->title.' by '.$track->artist; ?>


Playlists corresponding to the term "mixtape":
<?php
  $playlists = $ofm->playlists('mixtape')->playlists;
  foreach ($playlists as $playlist) {
    echo '  - '.$playlist->name.' ('.$playlist->tracks_count.' tracks)'.PHP_EOL;
  }
?>


Playlist 2BHH is called <?php echo $ofm->playlist('2BHH')->name.PHP_EOL; ?>
It contains the following tracks:
<?php
  $tracks = $ofm->playlist_tracks('2BHH');
  foreach ($tracks as $track) {
    echo '  - '.$track->title.PHP_EOL;
  }
?>

