<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $equipmentsQuery = Equipment::query();

        if ($order = $request->order) {
            $equipmentsQuery->orderBy($order, 'asc');
        }

        if ($search = $request->search) {
            $equipmentsQuery->where('name', 'like', "%{$search}%");
        }

        // $equipments = Equipment::paginate(15);

        // return view('equipment.index')->with('equipments', $equipments);
        return view('equipment.index', [
            "equipments" => $equipmentsQuery->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('equipment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEquipmentRequest $request)
    {
        $validated = $request->validated();

        $equipment = Equipment::create($validated);

        return redirect()->route('admin.equipments.index')
            ->withStatus("Equipment successfully added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipment = Equipment::findOrFail($id);

        return view('equipment.show')->with('equipment', $equipment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipment = Equipment::findOrFail($id);

        return view('equipment.edit')->with('equipment', $equipment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEquipmentRequest $request, $id)
    {
        // $validated = $request->validated();

        $book = Equipment::where('id', $id)->update($request->validated());
        
        return redirect()->route('admin.equipments.index')->withStatus("Equipment successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
