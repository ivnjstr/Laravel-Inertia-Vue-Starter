<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Laravel\Prompts\search;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) //accept the req ibject for filtering
    {

        // dd($request);
         // Listing::all();means we are just grabbing all the listing and we want to send them to the home component as a prop.

        //before returning the listing we can say return them with 
        //using with() method we can pass the related method that we want to use that is "user"
        $listings = Listing::with('user')
            ->filter(request(['search'])) //pass the request function of helper function
            ->latest()
            ->paginate(6)
            ->withQueryString();
            //before returning that before latest use where function means allows you to add a condition and query my database based on this condition this ,ethod will look for a column 
            //where('title', 'like' , '%'.$request->search.'%') means where the title is like our request parameter
            //it should be exaclty the same just include before annd aftrer using '%' just contatinate them
            //->withQueryString(); is a part of laravel and it a function we need to invoke it 
            // means to tell Laravel to include all the url parameters in the url when we do another query > so going to page 2 is technically another query

        //then pass the second argument 

        return Inertia::render(component: 'Home', props: [
            'listings' => $listings,
            'searchTerm' => $request->search,
        ]);
        // this method is returning the home component and later on we will add a listing to this and show it on the homepage
        
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
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
