<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ScoreController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json(Score::orderBy('seconds', 'asc')->get());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|min:3|max:20',
			'seconds' => 'required|numeric'
		]);

		if ($validator->fails()) {
			return response()->json($validator->errors());
		} else {
			$result = DB::transaction(function () use ($request) {
				return Score::create($request->only(['name', 'seconds']));
			});

			return response()->json($result);
		}
	}
}
