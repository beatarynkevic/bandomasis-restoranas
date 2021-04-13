<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\Menu;
use Validator;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $restaurants = Restaurant::orderBy('title')->get();
        $menus = Menu::orderBy('title')->get();
        //FILTRAVIMAS
        // dd($request);
        if($request->id) {
            $restaurants = Restaurant::where('menu_id', $request->id)->get();
            $filterBy = $request->menu_id;
        }
        else {
            $restaurants = Restaurant::orderBy('title')->get();
        }

        return view('restaurant.index', [
            'menus' => $menus,
            'restaurants' => $restaurants,
            'filterBy' => $filterBy ?? 0
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::orderBy('title', 'desc')->get();
        return view('restaurant.create', ['menus' => $menus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
        'restaurant_title' => ['required', 'alpha' , 'min:3', 'max:64'],
        'restaurant_customers' => ['required', 'numeric', 'max:200'],
        'restaurant_employees' => ['required', 'numeric', 'min:1', 'max:64'],
        ],
        [
        // 'author_surname.min' => 'mano zinute'
        ]
        );
        if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
        }

        $restaurant = new Restaurant;
        $restaurant->title = $request->restaurant_title;
        $restaurant->customers = $request->restaurant_customers;
        $restaurant->employees = $request->restaurant_employees;
        $restaurant->menu_id = $request->menu_id;

        $restaurant->save();
        return redirect()->route('restaurant.index')->with('success_message', 'restaurant had been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $menus = Menu::all();
        return view('restaurant.edit', ['restaurant' => $restaurant,  'menus' => $menus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validator = Validator::make($request->all(),
        [
        'restaurant_title' => ['required', 'alpha' , 'min:3', 'max:64'],
        'restaurant_customers' => ['required', 'numeric', 'max:200'],
        'restaurant_employees' => ['required', 'numeric', 'min:1', 'max:64'],
        ],
        [
        // 'author_surname.min' => 'mano zinute'
        ]
        );
        if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
        }

        $restaurant->title = $request->restaurant_title;
        $restaurant->customers = $request->restaurant_customers;
        $restaurant->employees = $request->restaurant_employees;
        $restaurant->menu_id = $request->menu_id;

        $restaurant->save();
        return redirect()->route('restaurant.index')->with('success_message', 'restaurant had been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('restaurant.index')->with('info_message', 'Outfit has been destroyed');
    }
}
