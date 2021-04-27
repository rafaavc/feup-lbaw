<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $units = Unit::all();
            return response()->json(['units' => $units], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid Request!'], 400);
        }
    }
}
