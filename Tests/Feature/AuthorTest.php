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

    public function testAuthors(): void
    {
        $response = $this->baseApi->client->get('/authors', [
            'query' => [
                'is_test' => true
            ]
        ]);

        $this->baseApi->assertJsonResponseContainsJsonFile(
            __DIR__ . '/ExpectedResponses/authorsResponse.json',
            $response
        );
    }

    public function testAuthorEmptyBook(): void
    {
        $response = $this->baseApi->client->get('/authors', [
            'query' => [
                'is_test' => true,
                'book_name' => ' ',
            ]
        ]);

        $this->baseApi->assertJsonResponseContainsJsonFile(
            __DIR__ . '/ExpectedResponses/authorsResponse.json',
            $response
        );
    }

    public function testAuthorByBook(): void
    {
        $response = $this->baseApi->client->get('/authors', [
            'query' => [
                'is_test' => true,
                'book_name' => 'Harry'
            ]
        ]);

        $this->baseApi->assertJsonResponseContainsJsonFile(
            __DIR__ . '/ExpectedResponses/authorByBookResponse.json',
            $response
        );
    }

}