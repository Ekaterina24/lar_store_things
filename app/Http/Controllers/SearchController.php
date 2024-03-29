<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function getResults(Request $request) {
        $query = $request->input('query');
        if(!$query) {
            redirect(route('home'));
        }

        $users = User::where(DB::raw("CONCAT (username)"),
            'LIKE', "%{$query}%")
            ->orWhere('username', 'LIKE', "%{$query}%")
            ->get();

        return view('search.results')->with('users', $users);
    }
}
