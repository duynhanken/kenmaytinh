<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\HardDriveStoreRequest;
use App\Models\HardDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HardDriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hardDrivers = HardDriver::paginate(5);
        return view('admin.harddrivers.index',compact('hardDrivers'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $hardDrivers = HardDriver::where('name','like',"%$search%");
        return view('admin.harddrivers.index',compact('hardDrivers'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.harddrivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HardDriveStoreRequest $request, HardDriver $hardDriver)
    {
        $hardDriver = new HardDriver();
        $hardDriver['name'] = $request->name;
        $hardDriver['slug'] = Str::slug($request->name,'-');
        $hardDriver['desc'] = $request->desc;
        $hardDriver['status'] = $request->status;

        $hardDriver->save();
        
        return redirect()->route('harddriver-list')->with('message','Create HardDriver Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HardDriver $hardDriver)
    {
        return view('admin.harddrivers.edit',compact('hardDriver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HardDriveStoreRequest $request, HardDriver $hardDriver)
    {
        $hardDriver['name'] = $request->name;
        $hardDriver['slug'] = Str::slug($request->name,'-');
        $hardDriver['desc'] = $request->desc;
        $hardDriver['status'] = $request->status;

        $hardDriver->save();
        
        return redirect()->route('harddriver-list')->with('message','Update HardDriver Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($hardDriver_id)
    {
        $hardDriver = HardDriver::find($hardDriver_id);
        $hardDriver->delete();
        return redirect()->route('harddriver-list')->with('message','Delete HardDriver Successfully');
    }

    
    public function active($hardDriver_id)
    {
        $hardDriver = HardDriver::find($hardDriver_id);
        $hardDriver->status = 1;
        $hardDriver->save();

        return redirect()->route('harddriver-list')->with('message','Active Hard Driver Successfully!');
    }

    public function unactive($hardDriver_id)
    {
        $hardDriver = HardDriver::find($hardDriver_id);
        $hardDriver->status = 0;
        $hardDriver->save();

        return redirect()->route('harddriver-list')->with('message','UnActive Hard Driver Successfully!');
    }

    public function process_all(Request $request)
    {
        $list_hardDriverID = $request->hardDriverID;
        if($list_hardDriverID!=null)
        {
            if($request->action == "delete")
            {
                foreach($list_hardDriverID as $hardDriver_id)
                {
                    $this->destroy($hardDriver_id); 
                }
                return redirect()->route('harddriver-list')->with('message','Delete Hard Driver Successfully');
            }
            else if($request->action == "active")
            {
                foreach($list_hardDriverID as $hardDriver_id)
                {
                    $this->active($hardDriver_id); 
                }
                return redirect()->route('harddriver-list')->with('message','Active Hard Driver Successfully');
            }
            else if($request->action == "unactive")
            {
                foreach($list_hardDriverID as $hardDriver_id)
                {
                    $this->unactive($hardDriver_id); 
                }
                return redirect()->route('harddriver-list')->with('message','UnActive Hard Driver Successfully');
            }
        }
        return redirect()->route('harddriver-list');
    }
}
