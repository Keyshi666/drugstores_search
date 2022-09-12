<?php

namespace App\Http\Controllers;

use App\Http\Requests\DrugRequest;
use App\Services\DrugDataServiceProvider;

class DrugsController extends Controller
{
    /**
     * @var DrugDataServiceProvider
     */
    protected $drugService;

    /**
     * DrugsController constructor.
     * @param DrugDataServiceProvider $drugService
     */
    public function __construct(DrugDataServiceProvider $drugService)
    {
        $this->drugService = $drugService;
    }

    /**
     * @param DrugRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDrugstores(DrugRequest $request)
    {
        return $this->drugService
            ->withDrugName($request->drug)
            ->getBody();
    }
}
