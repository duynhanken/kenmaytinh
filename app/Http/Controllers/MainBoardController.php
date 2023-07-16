<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\MainBoardStoreRequest;
use App\Models\MainBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class MainBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainBoards = MainBoard::paginate(5);
        return view('admin.mainBoards.index',compact('mainBoards'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $mainBoards = MainBoard::where('name','like',"%$search%")->paginate(1);
        
        return view('admin.mainBoards.index',compact('mainBoards'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mainBoards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MainBoardStoreRequest $request)
    {
        $mainBoards = new MainBoard();

        $mainBoards['name'] = $request->name;
        $mainBoards['size'] = $request->size;
        $mainBoards['chipset'] = $request->chipset;
        $mainBoards['usbgate'] = $request->usbgate;
        $mainBoards['ramslots'] = $request->ramslots;
        $mainBoards['manufacturer'] = $request->manufacturer;
        $mainBoards['desc'] = $request->desc;
        $mainBoards['slug'] = Str::slug($request->name,'-');
        $mainBoards['status'] = $request->status;

        $mainBoards->save();
        
        return redirect()->route('mainBoard-list')->with('message','Create mainBoards Successfully');   
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
    public function edit(MainBoard $mainBoard)
    {
        return view('admin.mainBoards.edit',compact('mainBoard'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MainBoardStoreRequest $request, MainBoard $mainBoard)
    {
        $mainBoard['name'] = $request->name;
        $mainBoard['size'] = $request->size;
        $mainBoard['chipset'] = $request->chipset;
        $mainBoard['usbgate'] = $request->usbgate;
        $mainBoard['ramslots'] = $request->ramslots;
        $mainBoard['manufacturer'] = $request->manufacturer;
        $mainBoard['desc']=$request->desc;
        $mainBoard['slug'] = Str::slug($request->name,'-');
        $mainBoard['status']= $request->status;
        $mainBoard->save();

        return redirect()->route('mainBoard-list')->with('message','Create Update MainBoard Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ram_id)
    {
        $mainBoard = MainBoard::find($ram_id);
        $mainBoard->delete();
        return redirect()->route('mainBoard-list')->with('message','Delete MainBoard Successfully');
    }


    public function active($rams_id) {
        $mainBoards = MainBoard::find($rams_id);
        $mainBoards->status = 1;
        $mainBoards->save();
        return redirect()->back()->with('message','Active MainBoard Successfully');
    }

    public function unactive($rams_id) {
        $mainBoards = MainBoard::find($rams_id);
        $mainBoards->status = 0;
        $mainBoards->save();
        return redirect()->back()->with('message','UnActive MainBoard Successfully');
    }

    public function process_all(Request $request)
    {
        $list_mbID = $request->mbID;
        if($list_mbID!=null)
        {
            if($request->action == "delete")
            {
                foreach($list_mbID as $ram_id)
                {
                    $this->destroy($ram_id); 
                }
                return redirect()->route('mainBoard-list')->with('message','Delete MainBoard Successfully');
            }
            else if($request->action == "active")
            {
                foreach($list_mbID as $ram_id)
                {
                    $this->active($ram_id); 
                }
                return redirect()->route('mainBoard-list')->with('message','Active MainBoard Successfully');
            }
            else if($request->action == "unactive")
            {
                foreach($list_mbID as $ram_id)
                {
                    $this->unactive($ram_id); 
                }
                return redirect()->route('mainBoard-list')->with('message','UnActive MainBoard Successfully');
            }
        }
        return redirect()->route('mainBoard-list');

    }
}
