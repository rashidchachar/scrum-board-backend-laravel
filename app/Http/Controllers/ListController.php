<?php

namespace App\Http\Controllers;

use App\Models\BoardList;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index()
    {
        return BoardList::with('cards')->orderBy('order')->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $last_position = BoardList::orderBY('order','DESC')->first();
        if(!empty($last_position))
        {
            $position = (int)$last_position->order + 1;
        }
        else{
            $position = 0;
        }
        $request->merge(['order'=>$position]);

        $list = BoardList::create($request->all());

        return $list;
    }


    public function sort(Request $request)
    {
        $listOrder = $request->input('listOrder');

        foreach ($listOrder as $order => $listId) {
            BoardList::where('id', $listId)->update(['order' => $order]);
        }

        return response()->json(['message' => 'Lists sorted successfully']);
    }
}
