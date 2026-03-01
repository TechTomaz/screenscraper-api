<?php

// Common ScreenScraper auth params shared across all tests
$authParams = [
    'devid' => 'testdev',
    'devpassword' => 'testpass',
    'softname' => 'TestApp',
    'output' => 'json',
];

test('infrastructure info endpoint returns successful response', function () use ($authParams) {
    $this->getJson(route('v2.infrastructure.show', $authParams))
        ->assertSuccessful();
});

test('infrastructure info endpoint requires auth params', function () {
    $this->getJson(route('v2.infrastructure.show'))
        ->assertUnprocessable();
});

test('infrastructure info endpoint rejects invalid output format', function () use ($authParams) {
    $this->getJson(route('v2.infrastructure.show', array_merge($authParams, ['output' => 'csv'])))
        ->assertUnprocessable();
});
