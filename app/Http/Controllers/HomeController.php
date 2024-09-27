<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $min_price = $request->input('min_price', 0);
        $max_price = $request->input('max_price', 1000000000); // Set default max price
    
        // Filter berdasarkan harga
        $house = House::where('address', 'like', '%'.$query.'%')
            ->where('price', '>=', $min_price)
            ->where('price', '<=', $max_price)
            ->get();
    
        return view('home', compact('house'));
    }
    
    
}
