<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Hotel;


class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = new Hotel();
        $hotels = $hotels->get();
        return view("layouts.hotel.index",compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("layouts.hotel.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hotel = new Hotel();
        $hotel->name = $request->name;
        $hotel->description = $request->description;
        $hotel->author_id = $request->author_id;
        $hotel->price = $request->price;
        $file = $request->file('image');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move('image/upload/'.$request->author_id.'/',$file->getClientOriginalName());
        }
        $hotel->img='image/upload/'.$request->author_id.'/'.$file->getClientOriginalName();
        $hotel->location_coordinate = $request->location_cord;
        $data = $hotel->save();
        return redirect(route('hotel.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotels = new Hotel();
        $hotel = $hotels->find($id);
        return view("layouts.hotel.show",compact('hotel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotels = new Hotel();
        $hotel = $hotels->find($id);
        return view("layouts.hotel.create",compact('hotel'));
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
        $hotels = new Hotel();
        $hotel = $hotels->find($id);
        $hotel->author_id = $request->author_id;
        $hotel->name = $request->name;
        $hotel->price = $request->price;
        $hotel->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move('image/upload/'.$request->author_id.'/',$file->getClientOriginalName());
            $hotel->img='image/upload/'.$request->author_id.'/'.$file->getClientOriginalName();
        }
        $hotel->location_coordinate = $request->location_cord;
        $data = $hotel->save();
        return redirect(route('hotel.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotels = new Hotel();
        $hotel = $hotels->find($id);
        $hotel->delete();
        return redirect(route('hotel.index'));
    }
    
}
