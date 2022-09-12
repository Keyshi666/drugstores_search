<?php

use \Illuminate\Http\Response;
use Tests\TestCase;

class CinemaTest extends TestCase
{
    public function testCreate()
    {

        $cinema = $this->getJsonFixture('CinemaTest', 'create_cinema.json');

        $response = $this->json('post', '/cinema', $cinema);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testUpdate()
    {
        $cinema = $this->getJsonFixture('CinemaTest', 'update_cinema.json');

        $response = $this->json('put', '/cinema/1', $cinema);

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }

    public function testDelete()
    {
        $response = $this->json('delete', '/cinema/1');

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testSearch()
    {
        $actual = $this->json('get', '/cinema');

        $expected = $this->getJsonFixture('CinemaTest', 'search_cinema.json');

        $this->assertEquals($expected, $actual->json());
    }
}