<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GuitarTabsControllerTest extends WebTestCase
{
    public function testReadAll(): void
    {
        $expected = [
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Hotel California',
                    'artist' => 'Eagles',
                    'uploaded_at' => new \DateTimeImmutable('2021-01-01'),
                ],
            ],
        ];

        $client = static::createClient();
        $client->request('GET', '/guitar_tabs');

        self::assertResponseIsSuccessful();
        self::assertJson($client->getResponse()->getContent());
        self::assertJsonStringEqualsJsonString(json_encode($expected), $client->getResponse()->getContent());
    }

    public function testRead(): void
    {
        $expected = [
            'id' => 1,
            'name' => 'Hotel California',
            'artist' => 'Eagles',
            'capo' => 7,
            'uploaded_at' => new \DateTimeImmutable('2021-01-01'),
            'content' => "\\n[Verse]\\nBm F# A E G D Em F#\\nBm F# A E G D Em F#\\nBm F# A E G D Em F#\\nBm F# A E G D Em F#\\n[Chorus]\\nG D F# Bm G D Em F#\\nG D F# Bm G D Em F#\\nG D F# Bm G D Em F#\\nG D F# Bm G D Em F#",
        ];

        $client = static::createClient();
        $client->request('GET', '/guitar_tabs/1');

        self::assertResponseIsSuccessful();
        self::assertJson($client->getResponse()->getContent());
        self::assertJsonStringEqualsJsonString(json_encode($expected), $client->getResponse()->getContent());
    }

    public function testCreate(): void
    {
        $expected = [
            'id' => 2,
        ];

        $client = static::createClient();
        $client->request('POST', '/guitar_tabs', [], [], [], json_encode([
            'name' => 'Hotel California',
            'artist' => 'Eagles',
            'capo' => 7,
            'content' => "\n[Verse]\nBm F# A E G D Em F#\nBm F# A E G D Em F#\nBm F# A E G D Em F#\nBm F# A E G D Em F#\n[Chorus]\nG D F# Bm G D Em F#\nG D F# Bm G D Em F#\nG D F# Bm G D Em F#\nG D F# Bm G D Em F#",
        ]));

        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(201, $client->getResponse()->getStatusCode());
        self::assertJson($client->getResponse()->getContent());
        self::assertJsonStringEqualsJsonString(json_encode($expected), $client->getResponse()->getContent());
    }

    public function testUpdate(): void
    {
        $client = static::createClient();
        $client->request('PUT', '/guitar_tabs/1', [], [], [], json_encode([
            'name' => 'new',
            'artist' => 'new',
            'capo' => 8,
            'content' => "new",
        ]));

        self::assertResponseStatusCodeSame(204, $client->getResponse()->getStatusCode());
    }

    public function testUpdateNotFound(): void
    {
        $client = static::createClient();
        $client->request('PUT', '/guitar_tabs/100', [], [], [], json_encode([
            'name' => 'new',
            'artist' => 'new',
            'capo' => 8,
            'content' => "new",
        ]));

        self::assertResponseStatusCodeSame(404, $client->getResponse()->getStatusCode());
    }

    public function testDelete(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/guitar_tabs/1');

        self::assertResponseStatusCodeSame(204, $client->getResponse()->getStatusCode());
    }

    public function testDeleteNotFound(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/guitar_tabs/100');

        self::assertResponseStatusCodeSame(404, $client->getResponse()->getStatusCode());
    }
}
