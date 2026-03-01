<?php

use App\Services\ScreenScraperService;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Http::fake([
        'api.screenscraper.fr/*' => Http::response(['status' => 'ok'], 200),
    ]);
});

test('infrastructure method calls correct endpoint with credentials', function () {
    app(ScreenScraperService::class)->infrastructure();

    Http::assertSent(fn ($request) => str_contains($request->url(), 'ssinfraInfos.php')
        && str_contains($request->url(), 'devid=testdev')
        && str_contains($request->url(), 'devpassword=testpass')
        && str_contains($request->url(), 'softname=TestApp')
        && str_contains($request->url(), 'output=json')
    );
});

test('user method calls correct endpoint with ssid and sspassword', function () {
    app(ScreenScraperService::class)->user('myuser', 'mypass');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'ssuserInfos.php')
        && $request['ssid'] === 'myuser'
        && $request['sspassword'] === 'mypass'
    );
});

test('user levels method calls correct endpoint', function () {
    app(ScreenScraperService::class)->userLevels();

    Http::assertSent(fn ($request) => str_contains($request->url(), 'userlevelsListe.php'));
});

test('reference list methods call their correct endpoints', function (string $method, string $endpoint) {
    app(ScreenScraperService::class)->{$method}();

    Http::assertSent(fn ($request) => str_contains($request->url(), $endpoint));
})->with([
    'regions' => ['regions', 'regionsListe.php'],
    'languages' => ['languages', 'languesListe.php'],
    'genres' => ['genres', 'genresListe.php'],
    'families' => ['families', 'famillesListe.php'],
    'classifications' => ['classifications', 'classificationsListe.php'],
    'rom types' => ['romTypes', 'romTypesListe.php'],
    'support types' => ['supportTypes', 'supportTypesListe.php'],
    'player counts' => ['playerCounts', 'nbJoueursListe.php'],
]);

test('systems method calls correct endpoint', function () {
    app(ScreenScraperService::class)->systems();

    Http::assertSent(fn ($request) => str_contains($request->url(), 'systemesListe.php'));
});

test('system media types method calls correct endpoint', function () {
    app(ScreenScraperService::class)->systemMediaTypes();

    Http::assertSent(fn ($request) => str_contains($request->url(), 'mediasSystemeListe.php'));
});

test('system media method calls correct endpoint with params', function () {
    app(ScreenScraperService::class)->systemMedia(1, 'wheel', 'wheel-carbon');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'mediaSysteme.php')
        && $request['systemeid'] == 1
        && $request['medianom'] === 'wheel'
        && $request['mediaid'] === 'wheel-carbon'
    );
});

test('system media method omits null mediaid', function () {
    app(ScreenScraperService::class)->systemMedia(1, 'wheel');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'mediaSysteme.php')
        && ! isset($request['mediaid'])
    );
});

test('system video method calls correct endpoint with system id', function () {
    app(ScreenScraperService::class)->systemVideo(3);

    Http::assertSent(fn ($request) => str_contains($request->url(), 'mediaVideoSysteme.php')
        && $request['systemeid'] == 3
    );
});

test('search games method calls correct endpoint with search term', function () {
    app(ScreenScraperService::class)->searchGames('Sonic', 1);

    Http::assertSent(fn ($request) => str_contains($request->url(), 'jeuRecherche.php')
        && $request['recherche'] === 'Sonic'
        && $request['systemeid'] == 1
    );
});

test('search games method omits null system id', function () {
    app(ScreenScraperService::class)->searchGames('Sonic');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'jeuRecherche.php')
        && ! isset($request['systemeid'])
    );
});

test('game method calls correct endpoint with all required params', function () {
    app(ScreenScraperService::class)->game(
        gameId: 1,
        ssid: 'user',
        sspassword: 'pass',
        systemId: 1,
        romType: 'rom',
        romName: 'Sonic The Hedgehog 2 (World).zip',
        romSize: 749652,
        crc: '50ABC90A',
    );

    Http::assertSent(fn ($request) => str_contains($request->url(), 'jeuInfos.php')
        && $request['jeuid'] == 1
        && $request['ssid'] === 'user'
        && $request['systemeid'] == 1
        && $request['romtype'] === 'rom'
        && $request['romnom'] === 'Sonic The Hedgehog 2 (World).zip'
        && $request['romtaille'] == 749652
        && $request['crc'] === '50ABC90A'
    );
});

test('game media method calls correct endpoint', function () {
    app(ScreenScraperService::class)->gameMedia(1, 1, 'Sonic', 'mixrbv1', 'Sonic.zip');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'mediaJeu.php')
        && $request['jeuid'] == 1
        && $request['systemeid'] == 1
        && $request['jeunom'] === 'Sonic'
        && $request['medianom'] === 'mixrbv1'
        && $request['romnom'] === 'Sonic.zip'
    );
});

test('game video method calls correct endpoint', function () {
    app(ScreenScraperService::class)->gameVideo(1, 1, 'Sonic');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'mediaVideoJeu.php')
        && $request['jeuid'] == 1
    );
});

test('game manual method calls correct endpoint', function () {
    app(ScreenScraperService::class)->gameManual(1, 1, 'Sonic');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'mediaManuelJeu.php')
        && $request['jeuid'] == 1
    );
});

test('group media method calls correct endpoint', function () {
    app(ScreenScraperService::class)->groupMedia(5, 'image');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'mediaGroup.php')
        && $request['groupeid'] == 5
        && $request['medianom'] === 'image'
    );
});

test('company media method calls correct endpoint', function () {
    app(ScreenScraperService::class)->companyMedia(7, 'image');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'mediaCompagnie.php')
        && $request['compagnieid'] == 7
        && $request['medianom'] === 'image'
    );
});

test('store rating method posts to correct endpoint', function () {
    app(ScreenScraperService::class)->storeRating('user', 'pass', 1, 18, 'wor');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'botNote.php')
        && $request->method() === 'POST'
        && $request['jeuid'] == 1
        && $request['note'] == 18
        && $request['region'] === 'wor'
    );
});

test('store proposal method posts to correct endpoint', function () {
    app(ScreenScraperService::class)->storeProposal('user', 'pass', 1, 'infos', 'genres', 'Action', 'wor', 'en');

    Http::assertSent(fn ($request) => str_contains($request->url(), 'botProposition.php')
        && $request->method() === 'POST'
        && $request['type'] === 'infos'
        && $request['champ'] === 'genres'
        && $request['valeur'] === 'Action'
        && $request['langue'] === 'en'
    );
});
