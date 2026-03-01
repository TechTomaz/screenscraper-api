<?php

$authParams = [
    'devid' => 'testdev',
    'devpassword' => 'testpass',
    'softname' => 'TestApp',
    'output' => 'json',
];

test('group media endpoint returns successful response', function () use ($authParams) {
    $params = array_merge($authParams, [
        'groupeid' => 1,
        'medianom' => 'image',
    ]);

    $this->getJson(route('v2.groups.media', ['id' => 1, ...$params]))
        ->assertSuccessful();
});

test('group media endpoint requires medianom', function () use ($authParams) {
    $this->getJson(route('v2.groups.media', ['id' => 1, ...$authParams]))
        ->assertUnprocessable();
});
