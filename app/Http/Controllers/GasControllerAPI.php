<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gas;
use App\Http\Resources\GasResource;


class GasControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //retrun the gas by user who created it
        // return GasResource::collection(Gas::all());
      
        return GasResource::collection(auth()->user()->gas);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation before create a new Gas
        $this->validate($request, [
            'last_week_price' => 'required',
            'current_price' => 'required',
            'isIncrease' => 'required',
            'petrol_type' => 'required',
            'brand_name' => 'required',
            'note' => 'required',
        ]);

        // First method to create a new Gas
        // $gas = Gas::create([
        //     'last_week_price' => $request->last_week_price,
        //     'current_price' => $request->current_price,
        //     'isIncrease' => $request->isIncrease,
        //     'petrol_type' => $request->petrol_type,
        //     'brand_name' => $request->brand_name,
        //     'note' => $request->note,
        // ]);
        
        // return new GasResource($gas);


         // Second to create a new Gas
        $gas = new Gas();

        $gas->last_week_price = $request->last_week_price;
        $gas->current_price = $request->current_price;
        $gas->isIncrease = $request->isIncrease;
        $gas->petrol_type = $request->petrol_type;
        $gas->brand_name = $request->brand_name;
        $gas->note = $request->note;


        // save gas by user id
        if (auth()->user()->gas()->save($gas)) {
            return response()->json([
                'success' => true,
                'data' => new GasResource($gas),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
            ], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $gas = Gas::find($id);
        $gas = auth()->user()->gas()->find($id);

        if ($gas) {
            return response()->json([
                'success' => true,
                'message' => 'Found Gas with id '. $id,
                'data' => new GasResource($gas),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gas with an id '. $id. ' could not be found',
            ], 400);
        }
    }

    public function search($searchTerm) {
        // $search = $request->searchTerm;
        // $search = $request->has('searchTerm');
        // print($s);
       

        // $searchTerm = $request->input('searchTerm');
        $gas = Gas::where('brand_name', $searchTerm)->get();
        // $gas = Gas::where('id', 'like', '%$s%')->get();
        // print($gas);

         if ($gas) {
            return response()->json([
                'success' => true,
                // 'Search Data' => new GasResource($gas),
                'Search Data' => $gas,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gas could not be found',
            ], 400);
        } 
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

        $gas = auth()->user()->gas()->find($id);
        //  $gas = Gas::find($id);
        // print($gas->last_week_price);
        // print($request->last_week_price);

        // return error when gas is not found
        if (!$gas) {
            return response()->json([
                'success' => false,
                'message' => 'Gas with an id '. $id. ' could not be found',
            ], 400);
        }

         if ($gas->update($request->all())) {
            return response()->json([
                'success' => true,
                'message' => 'Gas '.($id).' has been succesfully updated',
                'data' => new GasResource($gas),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gas cannot be updated',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gas = auth()->user()->gas()->find($id);
        // $gas = Gas::find($id);

        if (!$gas) {
            return response()->json([
                'success' => false,
                'message' => 'Gas with an id '. $id. ' could not be found',
            ], 400);
        }

        if ($gas->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Gas has succesfully deleted'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gas could not be deleted'
            ], 500);
        }
    }
}
