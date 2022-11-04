<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class ListingController extends Controller
{
	public function index()
	{
		$listing = Listing::latest()->filter(request(['tag', 'search']))->get();

		return view('listings/index', ['listings' => $listing]);
	}

	public function oneList(Listing $list)
	{
		return view('listings/show', ['listing' => $list]);
	}

	public function create()
	{
		return view('listings/create');
	}
}
