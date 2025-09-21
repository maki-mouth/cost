<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Cost;


class CostController extends Controller
{
    public function index()

    {
        $costs = Cost::with('category')->latest()->get();

        $totalAmount = Cost::sum('amount');

        $categories = Category::all();


        return view('index', compact('costs', 'categories', 'totalAmount'));
    }

    public function create(Request $request)
    {
        $cost = $request->only(['category_id', 'amount', 'memo']);
        Cost::create($cost);

        return redirect('/');
    }

    public function update(Request $request)
    {
        $data = $request->only(['created_at', 'category_id', 'amount', 'memo']);

        $cost = Cost::findOrFail($request->input('id'));
        $cost->update($data);


        return redirect('/');
    }

    public function destroy(Request $request)
    {
        Cost::find($request->id)->delete();

        return redirect('/');
    }
}
