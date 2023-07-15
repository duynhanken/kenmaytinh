<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerStoreRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class CustomerClientController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        try{
            $SocialUser = Socialite::driver($provider)->user();
            if(Customer::where('email',$SocialUser->getEmail())->exists()){
                return redirect('/login')->withErrors(['email' => 'This email users different method to login']);
            }

            $user = Customer::where([
                'provider' => $provider,
                'provider_id' => $SocialUser->id,
            ])->first();

            if(!$user){
                $user = Customer::create([
                    'name' => $SocialUser->getName(),
                    'email' => $SocialUser->getEmail(),
                    'provider' => $provider,
                    'provider_id' => $SocialUser->getId(),
                    'provider_token' => $SocialUser->token,
                ]);
                $user->sendEmailVerificationNotification();
            }
            Auth::login($user);
     
            return redirect('/dashboard');
        
        } catch(\Exception $e){
            return redirect('/login');
        }

 
        
       
    }

    public function postAdd(Request $request)
    {
        $this->Validate($request,
        [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required'
        ]);

        $customer = new Customer();
        $customer['name'] = $request->name;
        $customer['email'] = $request->email;
        $customer['phone'] = $request->phone;
        $customer['address'] = $request->address;
        $customer['password'] = Hash::make($request->password);
        $customer['status'] = 1;
        $customer->save();

       

        return view('client.home.account')->with('message','Tạo Tài Khoản Thành Công');
    }

    public function viewUpdateAccount(Customer $customer)
    {
        return view('client.home.account_detail',compact('customer'));
    }

    public function updateAccount(CustomerStoreRequest $request, Customer $customer)
    {
        
        $customer['name'] = $request->name;
        $customer['phone'] = $request->phone;
        $customer['address'] = $request->address;
        $path = Storage::disk('public')->put('/admin/customer',$request->file('image'));
        $customer['image'] = $path;
        $customer['status'] = $request->status;

        dd($customer);
        
        $customer->save();

        return redirect()->route('view-my-account')->with('message','Update Customer Successfully');
    }
}
