<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\VoucherStoreRequest;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Voucher::paginate(5);
        return view('admin.vouchers.index',compact('vouchers'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $vouchers = Voucher::where('name','like',"%$search%");
        return view('admin.vouchers.index',compact('vouchers'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VoucherStoreRequest $request, Voucher $voucher)
    {
        $listVoucher = Voucher::all();
        foreach($listVoucher as $vou)
        {
            if($request->code == $vou->code)
            {
                return redirect()->route('voucher-list')->with('message','Thêm Mã Giảm Giá Không Thành Công. Mã Giảm Giá Đã Tồn Tại');
            }
        }
        $voucher = new Voucher();
        $voucher['code'] = $request->code;
        $voucher['value'] = $request->value;
        $voucher['quantity'] = $request->quantity;
        $voucher['date_start'] = $request->date_start;
        $voucher['date_end'] = $request->date_end;
        $voucher['status'] = $request->status;


        $voucher->save();
        
        return redirect()->route('voucher-list')->with('message','Create Voucher Successfully');
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
    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit',compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VoucherStoreRequest $request, Voucher $voucher)
    {
        $voucher['code'] = $request->code;
        $voucher['value'] = $request->value;
        $voucher['quantity'] = $request->quantity;
        $voucher['date_start'] = $request->date_start;
        $voucher['date_end'] = $request->date_end;
        $voucher['status'] = $request->status;

        $voucher->save();
        
        return redirect()->route('voucher-list')->with('message','Update Voucher Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($voucher_id)
    {
        $voucher = Voucher::find($voucher_id);
        $voucher->delete();
        return redirect()->route('voucher-list')->with('message','Delete Voucher Successfully');
    }

    
    public function active($voucher_id)
    {
        $voucher = Voucher::find($voucher_id);
        $voucher->status = 1;
        $voucher->save();

        return redirect()->route('voucher-list')->with('message','Active Hard Driver Successfully!');
    }

    public function unactive($voucher_id)
    {
        $voucher = Voucher::find($voucher_id);
        $voucher->status = 0;
        $voucher->save();

        return redirect()->route('voucher-list')->with('message','UnActive Hard Driver Successfully!');
    }

    public function process_all(Request $request)
    {
        $list_hardDriverID = $request->hardDriverID;
        if($list_hardDriverID!=null)
        {
            if($request->action == "delete")
            {
                foreach($list_hardDriverID as $voucher_id)
                {
                    $this->destroy($voucher_id); 
                }
                return redirect()->route('voucher-list')->with('message','Delete Hard Driver Successfully');
            }
            else if($request->action == "active")
            {
                foreach($list_hardDriverID as $voucher_id)
                {
                    $this->active($voucher_id); 
                }
                return redirect()->route('voucher-list')->with('message','Active Hard Driver Successfully');
            }
            else if($request->action == "unactive")
            {
                foreach($list_hardDriverID as $voucher_id)
                {
                    $this->unactive($voucher_id); 
                }
                return redirect()->route('voucher-list')->with('message','UnActive Hard Driver Successfully');
            }
        }
        return redirect()->route('voucher-list');
    }
}
