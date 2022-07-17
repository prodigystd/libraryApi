<?php declare(strict_types=1);

namespace Tests\Feature;

use GuzzleHttp\Client;
use LibraryApi\Microkernel\Container\Container;
use LibraryApi\Modules\Database\DatabaseDriverInterface;
use LibraryApi\Modules\Database\DatabaseModule;
use PHPUnit\Framework\TestCase;

class BaseApiTest extends TestCase
{
    private static DatabaseDriverInterface $dataBase;
    public Client $client;

//    public static function setUpBeforeClass(): void
//    {
//        $module = new DatabaseModule();
//        $module->setContainer(Container::instance());
//        $module->registerTest();
//
//        static::$dataBase = Container::instance()->make(DatabaseDriverInterface::class);
//
//    }
//
//    public static function tearDownAfterClass(): void
//    {
//        static::$dataBase->execute(
//            'DROP DATABASE ' . static::$dataBase->getConfig()->get('dataBaseName'),
//        );
//    }

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

//        $this->assertEquals($expectedArrayResponse, $actualArrayResponse);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedArrayResponse, JSON_PRETTY_PRINT),
            json_encode($actualArrayResponse, JSON_PRETTY_PRINT)
        );

//        $this->assertStringContainsString(
//            json_encode($expectedArrayResponse, JSON_PRETTY_PRINT),
//            json_encode($actualArrayResponse, JSON_PRETTY_PRINT)
//        );
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