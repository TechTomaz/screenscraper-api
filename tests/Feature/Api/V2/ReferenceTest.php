<?php

$authParams = [
    'devid' => 'testdev',
    'devpassword' => 'testpass',
    'softname' => 'TestApp',
    'output' => 'json',
];

test('regions list endpoint returns successful response', function () use ($authParams) {
    $this->getJson(route('v2.references.regions', $authParams))
        ->assertSuccessful();
});

test('languages list endpoint returns successful response', function () use ($authParams) {
    $this->getJson(route('v2.references.languages', $authParams))
        ->assertSuccessful();
});

test('genres list endpoint returns successful response', function () use ($authParams) {
    $this->getJson(route('v2.references.genres', $authParams))
        ->assertSuccessful();
});

test('families list endpoint returns successful response', function () use ($authParams) {
    $this->getJson(route('v2.references.families', $authParams))
        ->assertSuccessful();
});

test('classifications list endpoint returns successful response', function () use ($authParams) {
    $this->getJson(route('v2.references.classifications', $authParams))
        ->assertSuccessful();
});

test('rom types list endpoint returns successful response', function () use ($authParams) {
    $this->getJson(route('v2.references.rom-types', $authParams))
        ->assertSuccessful();
});

test('support types list endpoint returns successful response', function () use ($authParams) {
    $this->getJson(route('v2.references.support-types', $authParams))
        ->assertSuccessful();
});

test('player counts list endpoint returns successful response', function () use ($authParams) {
    $this->getJson(route('v2.references.player-counts', $authParams))
        ->assertSuccessful();
});

test('reference list endpoints require auth params', function (string $route) {
    $this->getJson(route($route))
        ->assertUnprocessable();
})->with([
    'regions' => 'v2.references.regions',
    'languages' => 'v2.references.languages',
    'genres' => 'v2.references.genres',
    'families' => 'v2.references.families',
    'classifications' => 'v2.references.classifications',
    'rom-types' => 'v2.references.rom-types',
    'support-types' => 'v2.references.support-types',
    'player-counts' => 'v2.references.player-counts',
]);
