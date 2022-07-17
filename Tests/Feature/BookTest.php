<?php

namespace Tests\Feature;


use PHPUnit\Framework\TestCase;

final class BookTest extends TestCase
{
    private BaseApiTest $baseApi;

    public function setUp(): void
    {
        $this->baseApi = new BaseApiTest();
        $this->baseApi->setUp();
    }

    public function testBookByAuthor(): void
    {
        $response = $this->baseApi->client->get('/books', [
            'query' => [
                'author_name' => 'Joanne',
                'is_test' => true
            ]
        ]);

        $this->baseApi->assertJsonResponseContainsJsonFile(
            __DIR__ . '/ExpectedResponses/booksByAuthorResponse.json',
            $response
        );
    }

    public function testBookByAuthorCount(): void
    {
        $response = $this->baseApi->client->get('/books', [
            'query' => [
                'author_count' => 2,
                'is_test' => true
            ]
        ]);

        $this->baseApi->assertJsonResponseContainsJsonFile(
            __DIR__ . '/ExpectedResponses/booksByAuthorCountResponse.json',
            $response
        );
    }






}