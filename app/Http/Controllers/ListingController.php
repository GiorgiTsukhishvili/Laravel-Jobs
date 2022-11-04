<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
	public function index()
	{
		$listing = Listing::latest()->filter(request(['tag', 'search']))->paginate(6);

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

	public function store(Request $request)
	{
		$formFields = $request->validate([
			'title'       => 'required',
			'company'     => ['required', Rule::unique('listings', 'company')],
			'location'    => 'required',
			'logo'        => 'required',
			'website'     => 'required',
			'email'       => ['required', 'email'],
			'tags'        => 'required',
			'description' => 'required',
		]);

		if ($request->hasFile('logo'))
		{
			$formFields['logo'] = $request->file('logo')
			->store('logos', 'public');
		}

		Listing::create($formFields);

		return redirect('/')->with('message', 'Listing created successfully!');
	}
}
