<?php

$authParams = [
    'devid' => 'testdev',
    'devpassword' => 'testpass',
    'softname' => 'TestApp',
    'output' => 'json',
];

test('game search endpoint returns successful response', function () use ($authParams) {
    $params = array_merge($authParams, [
        'systemeid' => 1,
        'recherche' => 'Sonic',
    ]);

    $this->getJson(route('v2.games.search', $params))
        ->assertSuccessful();
});

test('game search endpoint requires recherche param', function () use ($authParams) {
    $this->getJson(route('v2.games.search', $authParams))
        ->assertUnprocessable();
});

test('game info endpoint returns successful response', function () use ($authParams) {
    // Example from ScreenScraper docs: Sonic The Hedgehog 2 (World).zip
    $params = array_merge($authParams, [
        'ssid' => 'test',
        'sspassword' => 'test',
        'crc' => '50ABC90A',
        'systemeid' => 1,
        'romtype' => 'rom',
        'romnom' => 'Sonic The Hedgehog 2 (World).zip',
        'romtaille' => 749652,
    ]);

    $this->getJson(route('v2.games.show', ['id' => 1, ...$params]))
        ->assertSuccessful();
});

test('game info endpoint requires ssid and sspassword', function () use ($authParams) {
    $params = array_merge($authParams, [
        'systemeid' => 1,
        'romtype' => 'rom',
        'romnom' => 'Sonic The Hedgehog 2 (World).zip',
        'romtaille' => 749652,
    ]);

    $this->getJson(route('v2.games.show', ['id' => 1, ...$params]))
        ->assertUnprocessable();
});

test('game info endpoint rejects invalid romtype', function () use ($authParams) {
    $params = array_merge($authParams, [
        'ssid' => 'test',
        'sspassword' => 'test',
        'systemeid' => 1,
        'romtype' => 'invalid',
        'romnom' => 'Sonic The Hedgehog 2 (World).zip',
        'romtaille' => 749652,
    ]);

    $this->getJson(route('v2.games.show', ['id' => 1, ...$params]))
        ->assertUnprocessable();
});

test('game media endpoint returns successful response', function () use ($authParams) {
    $params = array_merge($authParams, [
        'systemeid' => 1,
        'jeunom' => 'Sonic The Hedgehog 2',
        'romnom' => 'Sonic The Hedgehog 2 (World).zip',
        'medianom' => 'mixrbv1',
    ]);

    $this->getJson(route('v2.games.media', ['id' => 1, ...$params]))
        ->assertSuccessful();
});

test('game media endpoint requires systemeid, jeunom and medianom', function () use ($authParams) {
    $this->getJson(route('v2.games.media', ['id' => 1, ...$authParams]))
        ->assertUnprocessable();
});

test('game video endpoint returns successful response', function () use ($authParams) {
    $params = array_merge($authParams, [
        'systemeid' => 1,
        'jeunom' => 'Sonic The Hedgehog 2',
    ]);

    $this->getJson(route('v2.games.video', ['id' => 1, ...$params]))
        ->assertSuccessful();
});

test('game video endpoint requires systemeid and jeunom', function () use ($authParams) {
    $this->getJson(route('v2.games.video', ['id' => 1, ...$authParams]))
        ->assertUnprocessable();
});

test('game manual endpoint returns successful response', function () use ($authParams) {
    $params = array_merge($authParams, [
        'systemeid' => 1,
        'jeunom' => 'Sonic The Hedgehog 2',
    ]);

    $this->getJson(route('v2.games.manual', ['id' => 1, ...$params]))
        ->assertSuccessful();
});

test('game manual endpoint requires systemeid and jeunom', function () use ($authParams) {
    $this->getJson(route('v2.games.manual', ['id' => 1, ...$authParams]))
        ->assertUnprocessable();
});
