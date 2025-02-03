<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use Inertia\Inertia;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        //before returning the listing we cansay return them with 
        //using with() method we can pass the related method that we want to use that is "user"
        $listings = Listing::with('user')->latest()->paginate(6);
        // Listing::all();means we are just grabbing all the listing and we want to send them to the home component as a prop.

        //then pass the second argument 

        return Inertia::render('Home', [
            'listings' => $listings
        ]);
        // this method is returning the home component and later on we will add a listing to this and show it on the homepage
        
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListingRequest $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
