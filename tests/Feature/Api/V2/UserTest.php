<?php

$authParams = [
    'devid' => 'testdev',
    'devpassword' => 'testpass',
    'softname' => 'TestApp',
    'output' => 'json',
];

test('user info endpoint returns successful response', function () use ($authParams) {
    $params = array_merge($authParams, [
        'ssid' => 'test',
        'sspassword' => 'test',
    ]);

    $this->getJson(route('v2.user.show', $params))
        ->assertSuccessful();
});

test('user info endpoint requires ssid and sspassword', function () use ($authParams) {
    $this->getJson(route('v2.user.show', $authParams))
        ->assertUnprocessable();
});

test('user levels endpoint returns successful response', function () use ($authParams) {
    $this->getJson(route('v2.user.levels', $authParams))
        ->assertSuccessful();
});

test('user levels endpoint requires auth params', function () {
    $this->getJson(route('v2.user.levels'))
        ->assertUnprocessable();
});
