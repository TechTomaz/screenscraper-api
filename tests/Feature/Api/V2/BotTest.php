<?php

$authParams = [
    'devid' => 'testdev',
    'devpassword' => 'testpass',
    'softname' => 'TestApp',
    'output' => 'json',
];

test('bot ratings endpoint returns successful response', function () use ($authParams) {
    $params = array_merge($authParams, [
        'ssid' => 'test',
        'sspassword' => 'test',
        'jeuid' => 1,
        'note' => 18,
        'region' => 'wor',
    ]);

    $this->postJson(route('v2.bot.ratings.store'), $params)
        ->assertSuccessful();
});

test('bot ratings endpoint requires ssid, sspassword, jeuid, note and region', function () use ($authParams) {
    $this->postJson(route('v2.bot.ratings.store'), $authParams)
        ->assertUnprocessable();
});

test('bot ratings endpoint rejects note outside 0-20 range', function () use ($authParams) {
    $params = array_merge($authParams, [
        'ssid' => 'test',
        'sspassword' => 'test',
        'jeuid' => 1,
        'note' => 21,
        'region' => 'wor',
    ]);

    $this->postJson(route('v2.bot.ratings.store'), $params)
        ->assertUnprocessable();
});

test('bot proposals endpoint returns successful response', function () use ($authParams) {
    $params = array_merge($authParams, [
        'ssid' => 'test',
        'sspassword' => 'test',
        'jeuid' => 1,
        'type' => 'infos',
        'champ' => 'genres',
        'valeur' => 'Action',
        'region' => 'wor',
        'langue' => 'en',
    ]);

    $this->postJson(route('v2.bot.proposals.store'), $params)
        ->assertSuccessful();
});

test('bot proposals endpoint requires all fields', function () use ($authParams) {
    $this->postJson(route('v2.bot.proposals.store'), $authParams)
        ->assertUnprocessable();
});

test('bot proposals endpoint rejects invalid type', function () use ($authParams) {
    $params = array_merge($authParams, [
        'ssid' => 'test',
        'sspassword' => 'test',
        'jeuid' => 1,
        'type' => 'invalid',
        'champ' => 'genres',
        'valeur' => 'Action',
        'region' => 'wor',
        'langue' => 'en',
    ]);

    $this->postJson(route('v2.bot.proposals.store'), $params)
        ->assertUnprocessable();
});
