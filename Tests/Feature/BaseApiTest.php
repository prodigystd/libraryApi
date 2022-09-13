<?php declare(strict_types=1);

namespace Tests\Feature;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class BaseApiTest extends TestCase
{
    public Client $client;

    public function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'http://library_api_nginx'
        ]);
    }

    public function assertJsonResponseContainsJsonFile($expectedJsonFile, $actualResponse)
    {
        $this->assertEquals(200, $actualResponse->getStatusCode());
        $this->assertEquals('application/json', $actualResponse->getHeader('Content-Type')[0]);

        $jsonResponse = $actualResponse->getBody()->getContents();

        $this->assertJson($jsonResponse);

        $actualArrayResponse = json_decode($jsonResponse, true);


        $this->assertFileExists($expectedJsonFile);
        $expectedArrayResponse = json_decode(file_get_contents($expectedJsonFile), true);

        $this->arraySetIdsToNull($expectedArrayResponse);
        $this->arraySetIdsToNull($actualArrayResponse);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedArrayResponse, JSON_PRETTY_PRINT),
            json_encode($actualArrayResponse, JSON_PRETTY_PRINT)
        );

    }

    public function arraySetIdsToNull(array &$array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            if ($key === 'id') {
                $item = null;
            }
        });
    }


}