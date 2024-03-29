<?php

namespace App\Http\Controllers;

use App\Models\Thing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ThingsController extends Controller
{
    public function getThings()
    {
        if (Auth::check()) {
            $things = Thing::where(function ($query) {
                return $query->where('user_id', Auth::user()->id);
            })
                ->orderBy('created_at', 'desc')
                ->paginate(2);

            return view('things.index', compact('things'));
        }
        return view('things.index');
    }

    public function postThings(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'description' => ['required', 'max:1000'],
            'wrnt' => ['required']
        ]);

        Auth::user()->things()->create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'wrnt' => $request->input('wrnt'),
        ]);

        return redirect(route('things'))->with('info', 'Запись успешно добавлена!');
    }

    public function destroyThing($id)
    {
        Thing::destroy($id);
        return redirect(route('things'));
    }

    public function getUpdateThing($id)
    {
        $thing = Thing::findOrFail($id);
        return view('things.update', compact('thing'));
    }

    public function postUpdateThing(Request $request, $id)
    {
        $thing = Thing::findOrFail($id);
        $thing->update($request->validate([
            'name' => ['string'],
            'description' => ['string'],
            'wrnt' => ['integer']
        ]));
        return redirect(route('things'));
    }

    public function index()
    {
        $user = Auth::user()->id;
        $things = DB::table('things')
            ->select('*')
//            ->where('user_id', '<>', $user)
            ->orWhereIn('user_id', Auth::user()->friends()->pluck('id'))
            ->paginate(3);
        return view('things.another', compact('things'));
    }


    public function takeThing($id) {
        $thing = Thing::findOrFail($id);
//        Auth::user()->create([
//            'user_id' => $thing->requestUser(),
//            'thing_id' => $thing->requestThing()
//        ]);

//        dd($thing->requestThing());
//        $thing = Auth::user()->requests();
//        dd($thing->requestThing());
        return redirect(route('things.another'))->with('info', "Запрос на вещь $thing->name отправлен.");
    }

    public function requestsOnThings($id) {
//        $thing = Thing::findOrFail($id);
//        return redirect(route('things.another'))->with('info', "Запрос отправлен на вещь $thing->name.");
    }
}
