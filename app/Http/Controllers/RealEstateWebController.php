<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;
use Illuminate\Http\Request;

class RealEstateWebController extends Controller
{
    public function index()
    {
        \Log::info('RealEstateWebController@index called');
        // $realEstates = [];
        $realEstates = RealEstate::withTrashed()
            ->select('id', 'name', 'real_state_type', 'city', 'country', 'deleted_at')
            ->orderBy('id', 'desc')
            ->get();
        return view('realestates.index', compact('realEstates'));
    }


    public function create()
    {
        return view('realestates.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        RealEstate::create($validated);
        return redirect()->route('realestates.index')->with('success', 'Property created successfully.');
    }


    public function show($id)
    {
        $estate = RealEstate::findOrFail($id);
        // dd($estate);
        return view('realestates.show', compact('estate'));
    }

    public function edit($id)
    {
        $estate = RealEstate::findOrFail($id);
        return view('realestates.edit', compact('estate'));
    }

    public function update(Request $request, $id)
    {
        $estate = RealEstate::findOrFail($id);
        $validated = $request->validate($this->rules('update'));
        // dd($id);
        $estate->update($validated);
        return redirect()->route('realestates.show', $estate->id)->with('success', 'Property updated successfully.');
    }

    public function destroy($id)
    {
        $estate = RealEstate::findOrFail($id);
        $estate->delete();
        return redirect()->route('realestates.index')->with('success', 'Property deleted successfully.');
    }


    protected function rules($method = 'store')
    {
        return [
            'name'             => 'required|string|min:1|max:128',
            'real_state_type'  => 'required|in:house,department,land,commercial_ground',
            'street'           => 'required|string|min:1|max:128',
            'external_number'  => 'required|string|max:12|regex:/^[A-Za-z0-9\-]+$/',
            'internal_number'  => [
                request('real_state_type') == 'department' || request('real_state_type') == 'commercial_ground' ? 'required' : 'nullable',
                'string',
                'regex:/^[A-Za-z0-9\- ]+$/'
            ],
            'neighborhood'     => 'required|string|min:1|max:128',
            'city'             => 'required|string|min:1|max:64',
            'country'          => 'required|string|size:2',
            'rooms'            => 'required|integer',
            'bathrooms'        => 'required|numeric',
            'comments'         => 'nullable|string|min:1|max:128',
        ];
    }

    public function restore($id)
    {
        $realEstate = RealEstate::withTrashed()->findOrFail($id);
        $realEstate->restore();

        return redirect()->route('realestates.index')
            ->with('success', 'Property restored successfully.');
    }

    public function hardDelete($id)
    {
        $realEstate = RealEstate::withTrashed()->findOrFail($id);
        $realEstate->forceDelete();

        return redirect()->route('realestates.index')
            ->with('success', 'Property permanently deleted.');
    }
}
