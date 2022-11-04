<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class ListingController extends Controller
{
	public function index()
	{
		return view('listings/index', ['listings' => Listing::latest()->filter(request(['tag']))->get()]);
	}

	public function oneList(Listing $list)
	{
		return view('listings/show', ['listing' => $list]);
	}
}
