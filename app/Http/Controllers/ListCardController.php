<?php

namespace App\Http\Controllers;

use App\Models\BoardListCard;
use Illuminate\Http\Request;

class ListCardController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'list_id' => 'required',
            'title' => 'required|string|max:255',
        ]);

        $last_position = BoardListCard::where('list_id',$request->list_id)->orderBY('order','DESC')->first();
        if(!empty($last_position))
        {
            $position = (int)$last_position->order + 1;
        }
        else{
            $position = 0;
        }
        $request->merge(['order'=>$position]);

        $card = BoardListCard::create($request->all());

        return $card;
    }

    public function sort(Request $request)
    {
        $cardsOrder = $request->input('cardsOrder');
        foreach ($cardsOrder as $order => $item) {
            BoardListCard::where('id', $item['card_id'])->update(['list_id' => $item['list_id'],'order' => $item['order']]);
        }

        return response()->json(['message' => 'Cards sorted successfully']);
    }
}
