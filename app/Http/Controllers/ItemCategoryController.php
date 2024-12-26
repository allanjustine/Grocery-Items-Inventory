<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemCategories = ItemCategory::orderBy('item_code', 'asc')->with('customers')->paginate(10);

        return inertia('items/Index', compact('itemCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('items/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_code' => 'required|unique:item_categories',
            'item_name' => 'required',
            'item_description' => 'required',
            'item_price' => 'required',
            'item_quantity' => 'required',
            'item_type' => 'required',
        ]);

        ItemCategory::create([
            'item_code' => $request->item_code,
            'item_name' => $request->item_name,
            'item_description' => $request->item_description,
            'item_price' => $request->item_price,
            'item_quantity' => $request->item_quantity,
            'item_type' => $request->item_type,
        ]);

        return redirect('/items')->with('success', 'A new item has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemCategory = ItemCategory::findOrFail($id);

        return Inertia::render('items/Edit', [
            'itemCategory' => $itemCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemCategory $itemCategory)
    {
        $itemCategory->update([
            'item_code' => $request->input('item_code'),
            'item_name' => $request->input('item_name'),
            'item_description' => $request->input('item_description'),
            'item_price' => $request->input('item_price'),
            'item_quantity' => $request->input('item_quantity'),
            'item_type' => $request->input('item_type')

        ]);


        return redirect('/items')->with('success', 'The item was updated successfully.');
    }

    public function delete($id)
    {
        $itemCategory = ItemCategory::findOrFail($id);

        return Inertia::render('items/Delete', [
            'itemCategory' => $itemCategory,
        ]);
    }

    public function destroy($id)
    {
        $itemCategory = ItemCategory::findOrFail($id);
        $itemCategory->delete();

        return redirect('/items')->with('success', 'Item deleted successfully');
    }
}
