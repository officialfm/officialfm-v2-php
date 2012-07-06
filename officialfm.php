<?php

/*
 * A wrapper for official.fm's v2 API
 * 
 * Requires:
 *  * PHP >= 5.2.0 (for the native PHP JSON support),
 *  * the libcurl extension,
 *  * Sean Huber's curl wrapper - https://github.com/shuber/curl
 * 
 * @package officialfm
 * @author Amos Wenger <amos@official.fm>
 * @maintainer Dimiter Petrov <dimiter@official.fm>
 */

require_once dirname(__FILE__) . '/curl.php';


class OfficialFM {
	
    const VERSION = "0.0.1";
    const API_BASE_URL = "http://api.official.fm/";
    
    /**
     * The CURL handle we use to make all requests
     */
    protected $curl;
    
    /**
     * The user's official.fm API key
     */
    protected $api_key = "";
    
    /**
     * Initialize an OfficialFM object with your API key
     * 
     * @param string $api_key
     */
    function __construct($api_key = null)
    {
      $this->api_key = $api_key;

      $this->curl = new Curl;
      $this->curl->follow_redirects = false;
      $this->curl->headers['Content-Type'] = 'application/json';
      $this->curl->headers['Accept']       = 'application/json';
      $this->curl->headers['X-API-Version']= '2.0';
      $this->curl->headers['X-API-Key']= $api_key;
    }
    
    
    /* ==================== tracks functions ===================== */
    
    /**
     * Search for tracks
     *
     * @param string search_param: a search parameter (eg. name of the track)
     * @return array Track list
     */
    public function tracks($search_param, $options = array()) {
      $params = array_merge($options, array('q' => $search_param));

      $results = $this->api_get('tracks/search', $params);

      return $results->tracks;
    }
    
    /**
     * Retrieve information about a specific track
     *
     * @param string track_id: id
     * @return array Track
     */
    public function track($track_id, $options = array()) {
      $result = $this->api_get('tracks/'.$track_id, $options);

      return $result->track;
    }

    /* ==================== playlists functions ===================== */
    
    /**
     * Search for playlists
     *
     * @param string search_param: a search parameter (eg. name of the playlist)
     * @return array Playlist list
     */
     public function playlists($search_param, $options = array()) {
         $params = array_merge($options, array('q' => $search_param));

         $results = $this->api_get('playlists/search', $params);

         return $results->playlists;
     }
     
    /**
     * Retrieve information about a specific playlist
     *
     * @param string playlist_id: id
     * @return array Playlist
     */
     public function playlist($playlist_id, $options = array()) {
        $result = $this->api_get('playlists/'.$playlist_id, $options);

        return $result->playlist;
     }

    /**
     * Retrive the tracks in a playlist
     *
     * @param string playlist_id: id
     * @return array Track list
     */
     public function playlist_tracks($playlist_id, $options = array()) {
        $result = $this->api_get('playlists/'.$playlist_id.'/tracks', $options);

        return $result->tracks;
     }
     
    /* ==================== project functions ===================== */

    /**
     * Search for a project
     *
     * @param string search_param: a search parameter (eg. name of the project)
     * @return array Project list
     */
     public function projects($search_param, $options = array()) {
         $params = array_merge($options, array('q' => $search_param));

         $results = $this->api_get('projects/search', $params);

         return $results->projects;
     }
    
    /**
     * Retrieve information about a specific project
     *
     * @param string project_id: id
     * @return array Project
     */
     public function project($project_id, $options = array()) {
        $result = $this->api_get('projects/'.$project_id, $options);

        return $result->project;
     }

    /**
     * Retrive the tracks in a project
     *
     * @param string project_id: id
     * @return array Track list
     */
     public function project_tracks($project_id, $options = array()) {
        $result = $this->api_get('projects/'.$project_id.'/tracks', $options);

        return $result->tracks;
     }

    /**
     * Retrive the playlists in a project
     *
     * @param string project_id: id
     * @return array Playlist list
     */
     public function project_playlists($project_id, $options = array()) {
        $result = $this->api_get('projects/'.$project_id.'/playlists', $options);

        return $result->playlists;
     }

    /* ==================== helpers ===================== */

    // helper to use CURL and decode from json
    private function api_get($sub_url, $params) {
      $url = self::API_BASE_URL.$sub_url;
      $json = $this->curl->get($url, $params);
      return $this->decode_json($json);
    }
  
    private function decode_json($json) {
      $result = json_decode($json);

      if(isset($result->code) && isset($result->message)){
        throw new Exception($result->code.': '.$result->message);	
      }
      switch(json_last_error())
      {
          case JSON_ERROR_DEPTH:
              error_log(' - Maximal depth reached'.PHP_EOL);
          break;
          case JSON_ERROR_CTRL_CHAR:
              error_log(' - Control character error'.PHP_EOL);
          break;
          case JSON_ERROR_SYNTAX:
              error_log(' - Syntax error: malformed JSON'.PHP_EOL);
          break;
          case JSON_ERROR_NONE:
          break;
      }
    
      return $result;
    }

}

?> 
