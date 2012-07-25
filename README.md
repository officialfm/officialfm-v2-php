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

```php
$officialfm = new OfficialFM('your_api_key');
```
  
### Methods

Search for a track:

```php 
$officialfm->tracks('Nightcall');
```

Get info about a specific track:

```php
$officialfm->track('1nnQ');
```

Search for a playlist:

```php
$officialfm->playlists('AWOLNATION');
```

Get info about a specific playlist:

```php
$officialfm->playlist('CbqY');
```

Get the tracks in that playlist.

```php
$officialfm->playlist_tracks('CbqY');
```

Search for a project (a project can be an artist or a collaboration between several artists)

```php
$officialfm->projects('Mac Miller x Pharrell');
```

Similarly to playlists, you can get general information on the project with

```php
$officialfm->project('edB6');
```

You can retrieve only the tracks and only playlists in that project with

```php
$officialfm->project_tracks('edB6');
$officialfm->project_playlists('edB6');
```

Consult the [API docs](http://dev.official.fm) for a description of valid optional parameters.

## Copyright

Copyright (c) 2011 Amos Wenger

This project is distributed under the New BSD License. See LICENSE for details.
