<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class ScreenScraperService
{
    private PendingRequest $http;

    public function __construct()
    {
        $this->http = Http::baseUrl(config('screenscraper.base_url'))
            ->withQueryParameters([
                'devid' => config('screenscraper.dev_id'),
                'devpassword' => config('screenscraper.dev_password'),
                'softname' => config('screenscraper.soft_name'),
                'output' => 'json',
            ]);
    }

    /** @return array<string, mixed> */
    public function infrastructure(): array
    {
        return $this->http->get('ssinfraInfos.php')->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function user(string $ssid, string $sspassword): array
    {
        return $this->http->get('ssuserInfos.php', [
            'ssid' => $ssid,
            'sspassword' => $sspassword,
        ])->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function userLevels(): array
    {
        return $this->http->get('userlevelsListe.php')->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function regions(): array
    {
        return $this->http->get('regionsListe.php')->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function languages(): array
    {
        return $this->http->get('languesListe.php')->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function genres(): array
    {
        return $this->http->get('genresListe.php')->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function families(): array
    {
        return $this->http->get('famillesListe.php')->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function classifications(): array
    {
        return $this->http->get('classificationsListe.php')->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function romTypes(): array
    {
        return $this->http->get('romTypesListe.php')->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function supportTypes(): array
    {
        return $this->http->get('supportTypesListe.php')->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function playerCounts(): array
    {
        return $this->http->get('nbJoueursListe.php')->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function systems(): array
    {
        return $this->http->get('systemesListe.php')->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function systemMediaTypes(): array
    {
        return $this->http->get('mediasSystemeListe.php')->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function systemMedia(int $systemId, string $mediaName, ?string $mediaId = null): array
    {
        return $this->http->get('mediaSysteme.php', array_filter([
            'systemeid' => $systemId,
            'medianom' => $mediaName,
            'mediaid' => $mediaId,
        ]))->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function systemVideo(int $systemId): array
    {
        return $this->http->get('mediaVideoSysteme.php', [
            'systemeid' => $systemId,
        ])->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function searchGames(string $searchTerm, ?int $systemId = null): array
    {
        return $this->http->get('jeuRecherche.php', array_filter([
            'recherche' => $searchTerm,
            'systemeid' => $systemId,
        ]))->json() ?? [];
    }

    /**
     * @return array<string, mixed>
     */
    public function game(
        int $gameId,
        string $ssid,
        string $sspassword,
        int $systemId,
        string $romType,
        string $romName,
        int $romSize,
        ?string $crc = null,
        ?string $md5 = null,
        ?string $sha1 = null,
    ): array {
        return $this->http->get('jeuInfos.php', array_filter([
            'jeuid' => $gameId,
            'ssid' => $ssid,
            'sspassword' => $sspassword,
            'systemeid' => $systemId,
            'romtype' => $romType,
            'romnom' => $romName,
            'romtaille' => $romSize,
            'crc' => $crc,
            'md5' => $md5,
            'sha1' => $sha1,
        ]))->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function gameMedia(
        int $gameId,
        int $systemId,
        string $gameName,
        string $mediaName,
        ?string $romName = null,
    ): array {
        return $this->http->get('mediaJeu.php', array_filter([
            'jeuid' => $gameId,
            'systemeid' => $systemId,
            'jeunom' => $gameName,
            'medianom' => $mediaName,
            'romnom' => $romName,
        ]))->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function gameVideo(int $gameId, int $systemId, string $gameName): array
    {
        return $this->http->get('mediaVideoJeu.php', [
            'jeuid' => $gameId,
            'systemeid' => $systemId,
            'jeunom' => $gameName,
        ])->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function gameManual(int $gameId, int $systemId, string $gameName): array
    {
        return $this->http->get('mediaManuelJeu.php', [
            'jeuid' => $gameId,
            'systemeid' => $systemId,
            'jeunom' => $gameName,
        ])->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function groupMedia(int $groupId, string $mediaName): array
    {
        return $this->http->get('mediaGroup.php', [
            'groupeid' => $groupId,
            'medianom' => $mediaName,
        ])->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function companyMedia(int $companyId, string $mediaName): array
    {
        return $this->http->get('mediaCompagnie.php', [
            'compagnieid' => $companyId,
            'medianom' => $mediaName,
        ])->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function storeRating(
        string $ssid,
        string $sspassword,
        int $gameId,
        int $rating,
        string $region,
    ): array {
        return $this->http->post('botNote.php', [
            'ssid' => $ssid,
            'sspassword' => $sspassword,
            'jeuid' => $gameId,
            'note' => $rating,
            'region' => $region,
        ])->json() ?? [];
    }

    /** @return array<string, mixed> */
    public function storeProposal(
        string $ssid,
        string $sspassword,
        int $gameId,
        string $type,
        string $field,
        string $value,
        string $region,
        string $language,
    ): array {
        return $this->http->post('botProposition.php', [
            'ssid' => $ssid,
            'sspassword' => $sspassword,
            'jeuid' => $gameId,
            'type' => $type,
            'champ' => $field,
            'valeur' => $value,
            'region' => $region,
            'langue' => $language,
        ])->json() ?? [];
    }
}
