<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Carbon\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('created_at', 'DESC')->get();

        if (!$items->first())
        {
            return response()->json(['message' => 'No Todos today'], 404);
        }
        return $items;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->name = $request->item['name'];
        $item->save();

        return response()->json(['message' => 'success', 'item' => $item], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        if ($item)
        {
            $item->completed = $request->item['completed'] ? true : false;
            $item->completed_at = $request->item['completed'] ? Carbon::now() : null;
            $item->save();
            return response()->json(['message' => 'successfully updated', 'item' => $item], 200);
        }
        return response()->json(['message' => 'item not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);

        if ($item)
        {
            $item->delete();
            return response()->json(['message' => 'successfully deleted'], 200);
        }
        return response()->json(['message' => 'item not found'], 404);
    }
}
