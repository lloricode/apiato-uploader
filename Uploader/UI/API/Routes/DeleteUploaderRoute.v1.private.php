<?php

/**
 * @apiGroup           Uploader
 * @apiName            delete
 *
 * @api                {DELETE} /v1/uploaders/:id Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 No Content
 */

/** @var Route $router */
$router->delete('uploaders/{id}', [
    'as' => 'api_uploader_delete',
    'uses'  => 'Controller@deleteUploader',
    'middleware' => [
      'auth:api',
    ],
]);
