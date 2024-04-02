<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\ClienteController;
use App\Models\Cliente;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;

//use Illuminate\Foundation\Http\FormRequest;

class ClienteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // Resto de tu código...
    }


    /*** A basic unit test example.*/
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_store_client_invalid_NRODOCUMENTO_return_500(): void
    {
        // preparion 
        $requestData = [
            'title'     =>  'foo',
            'text'  =>  'bar',
        ];
        $request = Request::create('/clientes', 'POST', [
            'title'     =>  'foo',
            'text'  =>  'bar',
        ]);

        $clienteMock = Mockery::mock(new \App\Models\Cliente);
        app()->instance('\App\Models\Cliente', $clienteMock);
        $clienteMock->shouldReceive('create')
            ->once()
            ->with($requestData)
            ->andReturn(true);

        //ejecucion
        $clientController = new ClienteController();
        $response = $clientController->store($request);
        dd($response);
        // verificacion
        $this->assertEquals(404, $response->getStatusCode());
 
    }
}