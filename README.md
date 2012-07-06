# official.fm

PHP >= 5.2.0 Wrapper for the [official.fm Simple API](http://official.fm/developers).

## Installation

Click the `download` link above or `git clone git://github.com/officialfm/officialfm-php.git`

Requires Sean Huber's curl wrapper: [https://github.com/shuber/curl](https://github.com/shuber/curl).

## Requirements

officialfm-php runs on PHP >= 5.2.0, because it uses the official PHP json module. If you have PHP 5.3.0 or later, you also get nicer error messages in case the JSON response is malformed.

Also, the whole API is object-oriented, so running it on PHP 4.x is but a sweet dream.

## Get your API key

Comming soon.

You can also access the API without a key, but with a lower rate limit.

## Usage

### Include the relevant files

```php
require_once 'officialfm.php';
```

### Instantiate a client

Without a key, e.g. during development:

```php
$officialfm = new OfficialFM();
```
  
With an API key:

```
$officialfm = new OfficialFM('your_api_key');
```
  
### Methods

Search for a track:

```php 
$officialfm->tracks('Nightcall')
```

Get info about a specific track:

```php
$officialfm->track('1nnQ')
```

Search for a playlist:

```php
$officialfm->playlists('AWOLNATION')
```

Get info about a specific playlist:

```php
$officialfm->playlist('CbqY')
```

This only returns general information about the playlist and the following returns only the tracks in the playlist.

```php
$officialfm->playlist_tracks('CbqY')
```

To combine the two, use:

```php
$officialfm->playlist('CbqY', array('fields' => 'tracks'))
```

Search for a project (a project can be an artist or a collaboration between several artists)

```php
$officialfm->projects('Mac Miller x Pharrell')
```

Similarly to playlists, you can get general information on the project with

```php
$officialfm->project('edB6')
```

You can retrieve only the tracks and only playlists in that project with

```php
$officialfm->project_tracks('edB6')
$officialfm->project_playlists('edB6')
```

and you can mix and match:

```php
# Artist information including tracks
$officialfm->project('edB6', array('fields' => 'tracks'))

# Artist information and their tracks and playlists
$officialfm->project('edB6', array('fields' => array('tracks', 'playlists')))
```

### Fine-grained calls

As suggested above, all methods take a second, optional, parameter: an array of parameters to be included in the API call.

For example, to search for two Tamara Sky playlists and include their track listings in the results, you could call

```php
$officialfm->playlists('Tamara Sky', array('limit' => 2, 'fields' => 'tracks'))
```

Consult the [API docs](http://dev.official.fm) for a description of valid optional parameters.

## Copyright

Copyright (c) 2012 Dimiter Petrov
Copyright (c) 2011 Amos Wenger

This project is distributed under the New BSD License. See LICENSE for details.
