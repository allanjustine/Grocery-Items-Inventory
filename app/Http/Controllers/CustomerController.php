<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('cust_name')->with('itemCategory')->paginate(10);

        return inertia('customers/Index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itemCategories = ItemCategory::all();
        return inertia('customers/Create', [
            'itemCategories' => $itemCategories
        ]);
        return inertia('customers/Create');
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
            'cust_name' => 'required|unique:customers',
            'cust_address' => 'required',
            'cust_number' => 'required',
            'cust_money' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $item = ItemCategory::find($request->input('item_category_id'));

                    if ($item && $value < $item->item_price) {
                        $difference = $item->item_price - $value;
                        $fail('Customer needs P' . $difference . ' to complete the purchase.');
                    }
                },
            ],
            'item_category_id' => 'required'
        ]);

        $item = ItemCategory::findOrFail($request->item_category_id);

        $custChange = $request->cust_money - $item->item_price;

        $item->item_quantity -= 1;
        $item->save();

        Customer::create([
            'cust_name' => $request->cust_name,
            'cust_address' => $request->cust_address,
            'cust_number' => $request->cust_number,
            'cust_money' => $request->cust_money,
            'cust_change' => $custChange,
            'item_category_id' => $request->item_category_id
        ]);

        return redirect('/customers')->with('success', 'A new customer has been added.');
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
        $customer = Customer::with('itemCategory')->findOrFail($id);
        $itemCategories = ItemCategory::all();

        return Inertia::render('customers/Edit', [
            'customer' => $customer,
            'itemCategories' => $itemCategories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'cust_name' => 'required|unique:customers,cust_name,' . $customer->id,
            'cust_address' => 'required',
            'cust_number' => 'required',
            'cust_money' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $item = ItemCategory::find($request->input('item_category_id'));

                    if ($item && $value < $item->item_price) {
                        $difference = $item->item_price - $value;
                        $fail('Customer needs P' . $difference . ' to complete the purchase.');
                    }
                },
            ],
            'item_category_id' => 'required'
        ]);

        $item = ItemCategory::findOrFail($request->item_category_id);

        $custChange = $request->cust_money - $item->item_price;

        $item->item_quantity -= 1;
        $item->save();

        $customer->update([
            'cust_name' => $request->input('cust_name'),
            'cust_address' => $request->input('cust_address'),
            'cust_number' => $request->input('cust_number'),
            'cust_change' => $custChange,
            'cust_money' => $request->input('cust_money'),
            'item_category_id' => $request->input('item_category_id')

        ]);


        return redirect('/customers')->with('success', 'The customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $customer = Customer::with('itemCategory')->findOrFail($id);
        $itemCategory = ItemCategory::all();

        return Inertia::render('customers/Delete', [
            'customer' => $customer,
            'itemCategory' => $itemCategory,
        ]);
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect('/customers')->with('success', 'Customer deleted successfully');
    }

    public function view($id)
    {
        $customer = Customer::with('itemCategory')->findOrFail($id);
        $itemCategories = ItemCategory::all();

        return Inertia::render('customers/View', [
            'customer' => $customer,
            'itemCategories' => $itemCategories,
        ]);
    }
}
