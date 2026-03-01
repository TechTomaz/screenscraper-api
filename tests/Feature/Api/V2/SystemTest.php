<?php

$authParams = [
    'devid' => 'testdev',
    'devpassword' => 'testpass',
    'softname' => 'TestApp',
    'output' => 'json',
];

test('systems list endpoint returns successful response', function () use ($authParams) {
    $this->getJson(route('v2.systems.index', $authParams))
        ->assertSuccessful();
});

test('system media types endpoint returns successful response', function () use ($authParams) {
    $this->getJson(route('v2.systems.media-types', $authParams))
        ->assertSuccessful();
});

test('system media endpoint returns successful response', function () use ($authParams) {
    $params = array_merge($authParams, [
        'systemeid' => 1,
        'medianom' => 'wheel',
        'mediaid' => 'wheel-carbon',
    ]);

    $this->getJson(route('v2.systems.media', ['id' => 1, ...$params]))
        ->assertSuccessful();
});

test('system video endpoint returns successful response', function () use ($authParams) {
    $this->getJson(route('v2.systems.video', ['id' => 1, ...$authParams]))
        ->assertSuccessful();
});

test('system media endpoint requires medianom', function () use ($authParams) {
    $this->getJson(route('v2.systems.media', ['id' => 1, ...$authParams]))
        ->assertUnprocessable();
});

test('systems endpoints require auth params', function (string $route, array $extra) {
    $this->getJson(route($route, $extra))
        ->assertUnprocessable();
})->with([
    'systems index' => ['v2.systems.index', []],
    'media types' => ['v2.systems.media-types', []],
    'system video' => ['v2.systems.video', ['id' => 1]],
]);
