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

		$formFields['user_id'] = auth()->user()->id;

		Listing::create($formFields);

		return redirect('/')->with('message', 'Listing created successfully!');
	}

	public function edit(Listing $listing)
	{
		return view('listings.edit', ['listing' => $listing]);
	}

	public function update(Request $request)
	{
		$listing = Listing::find($request->id);

		$formFields = $request->validate([
			'title'       => 'required',
			'company'     => 'required',
			'location'    => 'required',
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

		$listing->update($formFields);

		return back()->with('message', 'Listing edited successfully!');
	}

	public function delete(Listing $listing)
	{
		$listing->delete();
		return redirect('/')->with('message', 'Listing deleted successfully!');
	}
}
