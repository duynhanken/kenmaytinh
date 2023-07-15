<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CpuStoreRequest;
use App\Models\Cpu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CpuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cpus = Cpu::all();
        return view('admin.cpus.index',compact('cpus'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $cpus = Cpu::where('name','like',"%$search%")->paginate(5);
        return view('admin.cpus.index',compact('cpus'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cpus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CpuStoreRequest $request, Cpu $cpu)
    {
        $cpu = new Cpu();
        
        $cpu['name'] = $request->name;
        $cpu['slug'] = Str::slug($request->name,'-');
        $cpu['desc'] = $request->desc;
        $cpu['status'] = $request->status;
        
        $cpu->save();
        return redirect()->route('cpu-list')->with('message','Create CPU Successfully!');
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
    public function edit(Cpu $cpu)
    {
        return view('admin.cpus.edit',compact('cpu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CpuStoreRequest $request, Cpu $cpu)
    {
        $cpu['name'] = $request->name;
        $cpu['slug'] = Str::slug($request->name,'-');
        $cpu['desc'] = $request->desc;
        $cpu['status'] = $request->status;
        
        $cpu->save();

        return redirect()->route('cpu-list')->with('message','Update CPU Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cpu_id)
    {
        $cpu = Cpu::find($cpu_id);
        $cpu->delete();

        return redirect()->route('cpu-list')->with('message','Delete CPU Successfully!');
    }

    public function active($cpus_id)
    {
        $cpus = Cpu::find($cpus_id);
        $cpus->status = 1;
        $cpus->save();

        return redirect()->route('cpu-list')->with('message','Active CPU Successfully!');
    }

    public function unactive($cpus_id)
    {
        $cpus = Cpu::find($cpus_id);
        $cpus->status = 0;
        $cpus->save();

        return redirect()->route('cpu-list')->with('message','UnActive CPU Successfully!');
    }

    public function process_all(Request $request)
    {
        $list_cpuID = $request->cpuID;
        if($list_cpuID!=null)
        {
            if($request->action == "delete")
            {
                foreach($list_cpuID as $cpu_id)
                {
                    $this->destroy($cpu_id); 
                }
                return redirect()->route('cpu-list')->with('message','Delete CPU Successfully');
            }
            else if($request->action == "active")
            {
                foreach($list_cpuID as $cpu_id)
                {
                    $this->active($cpu_id); 
                }
                return redirect()->route('cpu-list')->with('message','Active CPU Successfully');
            }
            else if($request->action == "unactive")
            {
                foreach($list_cpuID as $cpu_id)
                {
                    $this->unactive($cpu_id); 
                }
                return redirect()->route('cpu-list')->with('message','UnActive CPU Successfully');
            }
        }
        return redirect()->route('cpu-list');
    }
}
