<?php declare(strict_types=1);

namespace Tests\Feature;


use PHPUnit\Framework\TestCase;

final class AuthorTest extends TestCase
{
    private BaseApiTest $baseApi;

    public function setUp(): void
    {
        $this->baseApi = new BaseApiTest();
        $this->baseApi->setUp();
    }

    public function testAuthorByBook(): void
    {
        $response = $this->baseApi->client->get('/authors', [
            'query' => [
                'book_name' => 'Harry'
            ]
        ]);

        $this->baseApi->assertJsonResponseContainsJsonFile(
            __DIR__ . '/authorByBookResponse.json',
            $response
        );
    }

}