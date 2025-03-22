<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RealEstateController extends Controller
{
    public function index()
    {
        $realEstates = RealEstate::select('id', 'name', 'real_state_type', 'city', 'country')->get();
        return response()->json($realEstates);
    }

    public function show($id)
    {
        $realEstate = RealEstate::findOrFail($id);
        return response()->json($realEstate);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        
        $real_state_type = $request->input('real_state_type');
        if($real_state_type == 'land' || $real_state_type == 'commercial_ground'){
            $request->merge(['bathrooms' => 0]);
        }
        // dd($request->bathrooms);
        
        $realEstate = RealEstate::create($request->all());
        return response()->json($realEstate, 201);
    }

    public function update(Request $request, $id)
    {
        // dd($id);
        $realEstate = RealEstate::findOrFail($id);
        $this->validate($request, $this->rules($id, 'update'));
        
        $real_state_type = $request->input('real_state_type');
        if($real_state_type == 'land' || $real_state_type == 'commercial_ground'){
            $request->merge(['bathrooms' => 0]);
        }
        
        // dd($request->bathrooms);
        $realEstate->update($request->all());
        return response()->json($realEstate);
    }

    public function destroy($id)
    {
        $realEstate = RealEstate::findOrFail($id);
        $realEstate->delete();
        return response()->json($realEstate);
    }

    protected function rules($id = null, $method = 'store')
    {
        $rules = [
            'name'             => 'required|string|min:1|max:128',
            'real_state_type'  => ['required', Rule::in(['house', 'department', 'land', 'commercial_ground'])],
            'street'           => 'required|string|min:1|max:128',
            'external_number'  => ['required', 'string', 'max:12', 'regex:/^[A-Za-z0-9\-]+$/'],
            'neighborhood'     => 'required|string|min:1|max:128',
            'city'             => 'required|string|min:1|max:64',
            'country'          => ['required', 'string', 'size:2'],
            'rooms'            => 'required|integer',
            'bathrooms'        => 'required|numeric',
            'comments'         => 'nullable|string|min:1|max:128',
        ];

        // add custome rules 
        $rules['internal_number'] = [
            Rule::requiredIf(function () use ($id, $method) {
                $data = request()->all();
                return in_array($data['real_state_type'] ?? '', ['department', 'commercial_ground']);
            }),
            'nullable',
            'string',
            'regex:/^[A-Za-z0-9\- ]+$/'
        ];

        return $rules;
    }
}
