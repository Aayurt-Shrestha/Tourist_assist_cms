<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Tour;
use App\Hotel;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tours = new Tour();
        $tours = $tours->get();
        
        return view("layouts.tour.index",compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = new Category();
        $categories = $categories->get();
        return view("layouts.tour.create",compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tour = new Tour();
        $tour->name = $request->name;
        $tour->author_id = $request->author_id;
        $tour->description = $request->description;
        $tour->price = $request->price;
        $tour->location_coordinate = $request->location_cord;
        $tour->location= $request->location;
        $file = $request->file('image');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move('image/upload/'.$request->author_id.'/',$file->getClientOriginalName());
        }
        $tour->img='image/upload/'.$request->author_id.'/'.$file->getClientOriginalName();

        $data = $tour->save();
        $array = $request->check_list;
        $category = Category::find($array);
        $tour->categories()->attach($category);
        return redirect(route('tour.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tours = new Tour();
        $hotels = new Hotel();
        $hotels = $hotels->get();
        $tour = $tours->find($id);
        $tour->increment('views');
        return view("layouts.tour.show",compact('tour','hotels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tours = new Tour();
        $tour = $tours->find($id);
        return view("layouts.tour.create",compact('tour'));
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
        $tours = new Tour();
        $tour = $tours->find($id);
        $tour->author_id = $request->author_id;
        $tour->name = $request->name;
        $tour->price = $request->price;
        $tour->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move('image/upload/'.$request->author_id.'/',$file->getClientOriginalName());
            $tour->img='image/upload/'.$request->author_id.'/'.$file->getClientOriginalName();
        }
        $tour->location_coordinate = $request->location_cord;
        $data = $tour->save();
        return redirect(route('tour.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tours = new Tour();
        $tour = $tours->find($id);
        
        $tour->delete();
        return redirect(route('tour.index'));
    }
}
