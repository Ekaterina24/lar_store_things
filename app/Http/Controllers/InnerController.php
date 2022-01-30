<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InnerController extends Controller
{
    public function inner() {
        Gate::authorize('view-protected-part');
//        $response = Gate::inspect('view-protected-part');
//        if ($response->denied()) {
//            return $response->message();
//        }
        return view('inner');
    }
}
