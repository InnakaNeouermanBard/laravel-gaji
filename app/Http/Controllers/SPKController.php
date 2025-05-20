<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Services\SPKService;
use Illuminate\Http\Request;

class SPKController extends Controller
{
    protected $spkService;

    public function __construct(SPKService $spkService)
    {
        $this->spkService = $spkService;
    }

    public function index(Request $request)
    {
        $month = $request->input('month', now()->month); // Default: current month
        $year = $request->input('year', now()->year);   // Default: current year

        $results = $this->spkService->calculatePerformance($month, $year);


        return response()->json($results);
    }
}
