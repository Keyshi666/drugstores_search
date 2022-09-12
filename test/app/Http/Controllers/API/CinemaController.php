<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.2020
 * Time: 12:58
 */

namespace App\Http\Controllers\API;


use App\Http\Requests\CinemaRequest;
use App\Services\CinemaService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CinemaController
{
    /**
     * @var CinemaService
     */
    protected $service;

    /**
     * CinemaController constructor.
     * @param CinemaService $service
     */
    public function __construct(CinemaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->getAll();

        return response()->json($data, Response::HTTP_OK);
    }

    public function add(Request $request)
    {
        $tutor = $this->service->add($request->all());

        return response()->json([
            'message' => 'Success',
            'tutor'    => $tutor
        ], Response::HTTP_CREATED);
    }
    public function update(Request $request)
    {
        $this->service->update($request->all());
        return response()->json([
            'message' => 'Success'
        ], Response::HTTP_OK);
    }

    public function delete(Request $request)
    {
        $this->service->delete($request);
        return response()->json([
            'message' => 'Success'
        ], Response::HTTP_OK);
    }

}