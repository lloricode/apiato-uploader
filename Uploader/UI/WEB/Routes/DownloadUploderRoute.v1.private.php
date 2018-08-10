<?php

/** @var Route $router */
$router->get('uploaders/{id}', [
    'as' => 'web_uploader_find_download_uploader_by_id',
    'uses'  => 'Controller@findDownloadUploaderById',
    'middleware' => [
      'auth:web',
    ],
]);
