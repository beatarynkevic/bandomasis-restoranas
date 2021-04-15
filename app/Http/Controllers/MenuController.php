<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Validator;
use PDF;

class MenuController extends Controller
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
    public function index()
    {
        $menus = Menu::orderBy('price')->get();
        return view('menu.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all();
        $menus = Menu::all();
        return view('menu.create', ['restaurants' => $restaurants, 'menus' => $menus]);
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
        'menu_title' => ['required', 'min:3', 'max:64', 'regex:/^[\pL\s\-]+$/u'],
        'menu_price' => ['required', 'min:1', 'numeric'],
        'menu_weight' => ['required', 'min:1', 'max:400', 'numeric'],
        'menu_meat' => ['required', 'min:1', 'max:400', 'numeric', 'lte:menu_weight'],
        'menu_about' => ['required', 'min:3', 'max:200']
        ]
        );
        if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
        }
        $menu = new Menu;
        $menu->title = $request->menu_title;
        $menu->price = $request->menu_price;
        $menu->weight = $request->menu_weight;
        $menu->meat = $request->menu_meat;
        $menu->about = $request->menu_about;
        $menu->save();
        return redirect()->route('menu.index')->with('success_message', 'menu has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menu.edit', ['menu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $validator = Validator::make($request->all(),
        [
        'menu_title' => ['required', 'min:3', 'max:64', 'regex:/^[\pL\s\-]+$/u'],
        'menu_price' => ['required', 'min:1', 'numeric'],
        'menu_weight' => ['required', 'min:1', 'max:400', 'numeric'],
        'menu_meat' => ['required', 'min:1', 'max:400', 'numeric', 'lte:menu_weight'],
        'menu_about' => ['required', 'min:3', 'max:200']
        ]
        );
        if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
        }

        $menu->title = $request->menu_title;
        $menu->price = $request->menu_price;
        $menu->weight = $request->menu_weight;
        $menu->meat = $request->menu_meat;
        $menu->about = $request->menu_about;
        $menu->save();
        return redirect()->route('menu.index')->with('success_message', 'menu has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if($menu->menuRestaurant->count() !==0){
            return redirect()->back()->with('info_message', 'Trinti negalima, nes turi restoranu');
        }
        $menu->delete();
        return redirect()->route('menu.index')->with('success_message', 'Sekmingai ištrintas.');
    }

    public function pdf(Menu $menu)
    {
        $pdf = PDF::loadView('menu.pdf', ['menu' => $menu]); // standartinis view
        return $pdf->download('menu-id' . $menu->id . '.pdf'); // failo pavadinimas
    }
}
