<?php

/**
 * @apiGroup           Uploader
 * @apiName            download
 *
 * @api                {GET} /v1/uploaders/:id Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 */

/** @var Route $router */
$router->get('uploaders/{id}', [
    'as' => 'api_uploader_download',
    'uses'  => 'Controller@findDownloadUploaderById',
    'middleware' => [
      'auth:api',
    ],
]);
