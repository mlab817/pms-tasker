<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, $search)
    {
    	$results = Task::search($search)->get();

    	return response()->json($results);
    }
}
