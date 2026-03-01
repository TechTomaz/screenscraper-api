<?php

$authParams = [
    'devid' => 'testdev',
    'devpassword' => 'testpass',
    'softname' => 'TestApp',
    'output' => 'json',
];

test('company media endpoint returns successful response', function () use ($authParams) {
    $params = array_merge($authParams, [
        'companyid' => 1,
        'medianom' => 'image',
    ]);

    $this->getJson(route('v2.companies.media', ['id' => 1, ...$params]))
        ->assertSuccessful();
});

test('company media endpoint requires medianom', function () use ($authParams) {
    $this->getJson(route('v2.companies.media', ['id' => 1, ...$authParams]))
        ->assertUnprocessable();
});
