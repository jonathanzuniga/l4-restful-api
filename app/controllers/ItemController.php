<?php

class ItemController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// return 'Hello, API';

		$items = Item::where('user_id', Auth::user()->id)->get();

		return Response::json($items->toArray(), 200);
 
	    // return Response::json(array(
	    //     'error' => false,
	    //     'items' => $items->toArray()),
	    //     200
	    // );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$item = new Item;
	    $item->name = Input::get('name');
	    $item->notes = Input::get('notes');
	    $item->done = Input::get('done');
	    $item->user_id = Auth::user()->id;
	 
	    // Validation and Filtering is sorely needed!!
	    // Seriously, I'm a bad person for leaving that out.
	 
	    $item->save();

	    return Response::json(array(
	        'error' => false,
	        'items' => $items->toArray()),
	        200
	    );
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// Make sure current user owns the requested resource.
	    $item = Item::where('user_id', Auth::user()->id)
	            ->where('id', $id)
	            ->take(1)
	            ->get();
	 
	    return Response::json(array(
	        'error' => false,
	        'items' => $item->toArray()),
	        200
	    );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$item = Item::where('user_id', Auth::user()->id)->find($id);
 
	    if (Input::get('name')) {
	        $item->name = Input::get('name');
	    }
	 
	    if (Input::get('notes')) {
	        $item->notes = Input::get('notes');
	    }
	    
	    $item->done = (int)Input::get('done');
	 
	    $item->save();

	    return Response::json(array(
	        'error' => false,
	        'message' => 'url updated'),
	        200
	    );
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$item = Item::where('user_id', Auth::user()->id)->find($id);
 
	    $item->delete();

	    return Response::json(array(
	        'error' => false,
	        'message' => 'url deleted'),
	        200
	    );
	}

}
