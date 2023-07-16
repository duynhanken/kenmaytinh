<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\RamStoreRequest;
use App\Models\Ram;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class RamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rams = Ram::paginate(5);
        return view('admin.rams.index',compact('rams'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $rams = Ram::where('name','like',"%$search%")->paginate(1);
        
        return view('admin.rams.index',compact('rams'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RamStoreRequest $request)
    {
        $rams = new Ram();

        $rams['name'] = $request->name;
        $rams['capacity'] = $request->capacity;
        $rams['bus'] = $request->bus;
        $rams['bandwidth'] = $request->bandwidth;
        $rams['numberofpins'] = $request->numberofpins;
        $rams['desc'] = $request->desc;
        $rams['slug'] = Str::slug($request->name,'-');
        $rams['status'] = $request->status;

        $rams->save();
        
        return redirect()->route('ram-list')->with('message','Create rams Successfully');   
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
    public function edit(Ram $ram)
    {
        return view('admin.rams.edit',compact('ram'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RamStoreRequest $request, Ram $ram)
    {
        $ram['name'] = $request->name;
        $ram['capacity'] = $request->capacity;
        $ram['bus'] = $request->bus;
        $ram['bandwidth'] = $request->bandwidth;
        $ram['numberofpins'] = $request->numberofpins;
        $ram['desc']=$request->desc;
        $ram['slug'] = Str::slug($request->name,'-');
        $ram['status']= $request->status;
        $ram->save();

        return redirect()->route('ram-list')->with('message','Create Update Ram Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ram_id)
    {
        $ram = Ram::find($ram_id);
        $ram->delete();
        return redirect()->route('ram-list')->with('message','Delete Ram Successfully');
    }


    public function active($rams_id) {
        $rams = Ram::find($rams_id);
        $rams->status = 1;
        $rams->save();
        return redirect()->back()->with('message','Active Ram Successfully');
    }

    public function unactive($rams_id) {
        $rams = Ram::find($rams_id);
        $rams->status = 0;
        $rams->save();
        return redirect()->back()->with('message','UnActive Ram Successfully');
    }

    public function process_all(Request $request)
    {
        $list_ramID = $request->ramID;
        if($list_ramID!=null)
        {
            if($request->action == "delete")
            {
                foreach($list_ramID as $ram_id)
                {
                    $this->destroy($ram_id); 
                }
                return redirect()->route('ram-list')->with('message','Delete Ram Successfully');
            }
            else if($request->action == "active")
            {
                foreach($list_ramID as $ram_id)
                {
                    $this->active($ram_id); 
                }
                return redirect()->route('ram-list')->with('message','Active Ram Successfully');
            }
            else if($request->action == "unactive")
            {
                foreach($list_ramID as $ram_id)
                {
                    $this->unactive($ram_id); 
                }
                return redirect()->route('ram-list')->with('message','UnActive Ram Successfully');
            }
        }
        return redirect()->route('ram-list');

    }
}
