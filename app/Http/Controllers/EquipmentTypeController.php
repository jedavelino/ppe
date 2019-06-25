<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\EquipmentType;
use App\Http\Requests\StoreEquipmentTypeRequest;
use App\Http\Requests\UpdateEquipmentTypeRequest;
use Illuminate\Http\Request;

class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeQuery = EquipmentType::query();

        // dd(EquipmentType::get());

        return view('equipment.type.index', [
            "types" => $typeQuery->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('equipment.type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEquipmentTypeRequest $request)
    {
        $validated = $request->validated();
        $equipmentType = EquipmentType::firstOrCreate($validated);

        return redirect()->route('admin.types.index')->withStatus("Equipment Type successfully added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EquipmentType  $equipmentType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $equipment = Equipment::find($id)->equipments;
        $equipmentType = EquipmentType::findOrFail($id);

        // dd($equipmentType->equipments);

        return view('equipment.type.show', ["type" => $equipmentType]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EquipmentType  $equipmentType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipmentType = EquipmentType::findOrFail($id);

        return view('equipment.type.edit', [
            'type' => $equipmentType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EquipmentType  $equipmentType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEquipmentTypeRequest $request, $id)
    {
        $validated = $request->validated();

        $equipmentType = EquipmentType::where('id', $id)->update($validated);
        
        return redirect()->route('admin.types.index')->withStatus("{$request->name} successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EquipmentType  $equipmentType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipmentType = EquipmentType::destroy($id);

        return redirect()->back()
            ->withStatus("Equipment Type successfully deleted!");
    }
}
