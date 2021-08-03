<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        $cards = auth()->user()->columns()->with('cards')->get();

        return view('cards.index', compact('cards'));
    }
    //
    public function store(Request $request)
{
    $this->validate($request, [
        'title' => ['required', 'string', 'max:56'],
        'description' => ['required', 'string'],
        'column_id' => ['required', 'exists:columns,id']
    ]);

    return $request->user()
        ->cards()
        ->create($request->only('title', 'description', 'column_id'));
}

public function sync(Request $request)
    {
        $this->validate(request(), [
            'columns' => ['required', 'array']
        ]);

        foreach ($request->columns as $columns) {
            foreach ($column['cards'] as $i => $card) {
                $order = $i + 1;
                if ($card['column_id'] !== $column['id'] || $card['order'] !== $order) {
                    request()->user()->cards()
                        ->find($card['id'])
                        ->update(['column_id' => $column['id'], 'order' => $order]);
                }
            }
        }

        return $request->user()->columns()->with('cards')->get();
    }

}
