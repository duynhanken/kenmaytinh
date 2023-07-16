<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\GraphicsCardStoreRequest;
use App\Models\GraphicsCard;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class GraphicsCardController extends Controller
{
    public function index()
    {
        $graphicsCards = GraphicsCard::paginate(5);
        return view('admin.graphicsCards.index',compact('graphicsCards'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $graphicsCards = GraphicsCard::where('name','like',"%$search%")->paginate(1);
        
        return view('admin.graphicsCards.index',compact('graphicsCards'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.graphicsCards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GraphicsCardStoreRequest $request)
    {
        $graphicsCards = new GraphicsCard();

        $graphicsCards['name'] = $request->name;
        $graphicsCards['cateCard'] = $request->cateCard;
        $graphicsCards['capacityCard'] = $request->capacityCard;
        $graphicsCards['manufacturer'] = $request->manufacturer;
        $graphicsCards['desc'] = $request->desc;
        $graphicsCards['status'] = $request->status;

        $graphicsCards->save();
        
        
        return redirect()->route('graphicsCard-list')->with('message','Create graphicsCards Successfully');   
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
    public function edit(GraphicsCard $graphicsCard)
    {
        return view('admin.graphicsCards.edit',compact('graphicsCard'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GraphicsCardStoreRequest $request, GraphicsCard $graphicsCard)
    {
        $graphicsCard['name'] = $request->name;
        $graphicsCard['cateCard'] = $request->cateCard;
        $graphicsCard['capacityCard'] = $request->capacityCard;
        $graphicsCard['manufacturer'] = $request->manufacturer;
        $graphicsCard['desc']=$request->desc;
        $graphicsCard['slug'] = Str::slug($request->name,'-');
        $graphicsCard['status']= $request->status;
        $graphicsCard->save();

        return redirect()->route('graphicsCard-list')->with('message','Create Update GraphicsCard Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ram_id)
    {
        $graphicsCard = GraphicsCard::find($ram_id);
        $graphicsCard->delete();
        return redirect()->route('graphicsCard-list')->with('message','Delete GraphicsCard Successfully');
    }


    public function active($rams_id) {
        $graphicsCards = GraphicsCard::find($rams_id);
        $graphicsCards->status = 1;
        $graphicsCards->save();
        return redirect()->back()->with('message','Active GraphicsCard Successfully');
    }

    public function unactive($rams_id) {
        $graphicsCards = GraphicsCard::find($rams_id);
        $graphicsCards->status = 0;
        $graphicsCards->save();
        return redirect()->back()->with('message','UnActive GraphicsCard Successfully');
    }

    public function process_all(Request $request)
    {
        $list_gcID = $request->gcID;
        if($list_gcID!=null)
        {
            if($request->action == "delete")
            {
                foreach($list_gcID as $ram_id)
                {
                    $this->destroy($ram_id); 
                }
                return redirect()->route('graphicsCard-list')->with('message','Delete GraphicsCard Successfully');
            }
            else if($request->action == "active")
            {
                foreach($list_gcID as $ram_id)
                {
                    $this->active($ram_id); 
                }
                return redirect()->route('graphicsCard-list')->with('message','Active GraphicsCard Successfully');
            }
            else if($request->action == "unactive")
            {
                foreach($list_gcID as $ram_id)
                {
                    $this->unactive($ram_id); 
                }
                return redirect()->route('graphicsCard-list')->with('message','UnActive GraphicsCard Successfully');
            }
        }
        return redirect()->route('graphicsCard-list');

    }
}
