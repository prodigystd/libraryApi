<?php
declare(strict_types=1);

namespace LibraryApi\Tests\Feature;

use PHPUnit\Framework\TestCase;

final class BookTest extends TestCase
{
    private BaseApi $baseApi;

    public function setUp(): void
    {
        $this->baseApi = new BaseApi();
        $this->baseApi->setUp();
    }

    public function testBooks(): void
    {
        $response = $this->baseApi->client->get('/books', [
            'query' => [
                'is_test' => true
            ]
        ]);

        $this->baseApi->assertJsonResponseContainsJsonFile(
            __DIR__ . '/ExpectedResponses/booksResponse.json',
            $response
        );
    }


    public function testBookByEmptyAuthor(): void
    {
        $response = $this->baseApi->client->get('/books', [
            'query' => [
                'is_test' => true,
                'author_name' => ' '
            ]
        ]);

        $this->baseApi->assertJsonResponseContainsJsonFile(
            __DIR__ . '/ExpectedResponses/booksResponse.json',
            $response
        );
    }


    public function testBookByEmptyAuthorCount(): void
    {
        $response = $this->baseApi->client->get('/books', [
            'query' => [
                'is_test' => true,
                'author_count' => ' '
            ]
        ]);

        $this->baseApi->assertJsonResponseContainsJsonFile(
            __DIR__ . '/ExpectedResponses/booksResponse.json',
            $response
        );
    }


    public function testBookByAuthor(): void
    {
        $response = $this->baseApi->client->get('/books', [
            'query' => [
                'is_test' => true,
                'author_name' => 'Joanne'
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
                'is_test' => true,
                'author_count' => 2
            ]
        ]);

        $this->baseApi->assertJsonResponseContainsJsonFile(
            __DIR__ . '/ExpectedResponses/booksByAuthorCountResponse.json',
            $response
        );
    }


}