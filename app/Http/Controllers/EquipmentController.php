<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\EquipmentType;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class EquipmentController extends Controller
{
    protected $itemsPerPage = 15;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->flashOnly('search', 'status');

        $equipmentsQuery = Equipment::query();

        if ($request->status && $request->status === 'trashed') {
            $equipmentsQuery = Equipment::onlyTrashed();
        }

        $order = $request->order ? $request->order : 'asc';
        $orderBy = $request->orderby ? $request->orderby : 'created_at';

        $equipmentsQuery->orderBy($orderBy, $order);

        if ($search = $request->search) {
            $equipmentsQuery->where('name', 'like', "%{$search}%");
        }

        // if ($orderby = $request->orderby) {
        //     $equipmentsQuery->orderBy($orderby, $order);
        // }
        return view('equipment.index', [
            "equipments" => $equipmentsQuery->paginate($this->itemsPerPage),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = EquipmentType::all();

        return view('equipment.create', [
            'types' => $types,
        ]);
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

        return view('equipment.show', [
            "equipment" => $equipment,
        ]);
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
        $types = EquipmentType::all();

        return view('equipment.edit', [
            "equipment" => $equipment,
            "types" => $types,
        ]);
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
        $validated = $request->validated();

        $equipment = Equipment::where('id', $id)->update($validated);
        
        return redirect()->route('admin.equipments.index')->withStatus("Equipment successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $equipment = Equipment::where('id', $id)->forceDelete();

        return redirect()->back()->withStatus("Equipment has been successfully deleted!");
    }

    public function trash(Request $request, $id) {
        $equipment = Equipment::destroy($id);

        return redirect()->route('admin.equipments.index')
            ->withStatus("Equipment successfully trashed!");
    }

    // public function trashed(Request $request)
    // {
    //     $request->flashOnly('search');

    //     $equipmentsQuery = Equipment::onlyTrashed();

    //     if ($order = $request->order) {
    //         $equipmentsQuery->orderBy($order, 'asc');
    //     }

    //     if ($search = $request->search) {
    //         $equipmentsQuery->where('name', 'like', "%{$search}%");
    //     }

    //     return view('equipment.trash', [
    //         "equipments" => $equipmentsQuery->paginate($this->itemsPerPage),
    //     ]);
    // }

    public function restore(Request $request, $id)
    {
        Equipment::withTrashed()->where('id', $id)->restore();
        return redirect()->back()->withStatus("Equipment successfully restored!");
    }
}
