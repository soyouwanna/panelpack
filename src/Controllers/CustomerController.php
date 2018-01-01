<?php

namespace Decoweb\Panelpack\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Decoweb\Panelpack\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Validator;
use Decoweb\Panelpack\Models\Order;
use Illuminate\Support\Facades\Hash;
use App\Mail\CustomerLinkConfirmation;
use Illuminate\Support\Facades\Mail;
class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
        # All pages just for customers
        $this->middleware('loggedcustomer');
        # This page is just for verified users // see Kernel middleware routes
        # "only" has te page name as param
        $this->middleware('verifiedcustomer')->only('go');
    }

    public function profile()
    {
        $id = (int)Auth::guard('customer')->user()->id;
        //$customer = Customer::where('id',$id)->first();
        $customer = Customer::find($id);
        $status = '';
        if ( null == $customer->email ){
            $status = 'Adresa de email lipseste. Va rugam sa completati profilul.';
        }elseif( $customer->email && $customer->verified == 0 ){
            $status = 'Adresa de email nu este confirmata. Va rugam sa urmati linkul de confirmare primit.';
        }
        return view('decoweb::customers.profile',['customer'=>$customer, 'status'=>$status]);
    }

    public function myOrders()
    {
        $orders = Order::where('customer_id', (int)Auth::guard('customer')->user()->id )->orderBy('created_at','desc')->get();
        return view('decoweb::customers.myorders',[
            'orders'    => $orders,
        ]);
    }
    /**
     * Updates account details and returns redirect to customer's profile
     *
     * @param Request $request
     * @param         $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $customer = $this->customerExists($id);
        if( $customer == null ){
            $request->session()->flash('mesaj', 'Acest utilizator nu exista in baza de date.');
            return redirect('customer/profile');
        }
        $alphaDashSpaces = '/^[A-Za-z \-ĂÎÂŞŢăîâşţ]+$/';
        $alphaDashSpacesNum = '/^[A-Za-z0-9\s\-ĂÎÂŞŢăîâşţ]+$/';
        $numbers = '/^[0-9]+$/';
        $address = "/^[A-Za-zĂÎÂŞŢăîâşţ0-9\.\-\s\,]+$/";
        $rules = [
            'account_type'  => 'required|in:0,1' ,
            'name'          => 'required_if:account_type,0|nullable|regex:'.$alphaDashSpaces,
            'phone'         => 'required_if:account_type,0|nullable|regex:'.$numbers,
            'cnp'           => 'required_if:account_type,0|nullable|digits:13',
            'region'        => 'required_if:account_type,0|nullable|regex:'.$alphaDashSpaces,
            'city'          => 'required_if:account_type,0|nullable|regex:'.$alphaDashSpaces,
            'address'       => 'required|regex:'.$address,
            'company'       => 'required_if:account_type,1|nullable|regex:'.$alphaDashSpacesNum,
            'rc'            => 'required_if:account_type,1|nullable|alpha_num',
            'cif'           => 'required_if:account_type,1|nullable|alpha_num',
            'bank_account'  => 'required_if:account_type,1|nullable|alpha_num',
            'bank_name'     => 'required_if:account_type,1|nullable|regex:'.$alphaDashSpaces,
        ];
        if ( empty($customer->email) ){
            $rules['email'] = 'required|email';
        }

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return redirect('customer/profile')
                ->withErrors($validator)
                ->withInput();
        }

        if($request->account_type == 0){
            $customer->account_type = 0;
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->cnp = $request->cnp;
            $customer->region = $request->region;
            $customer->city = $request->city;
        }elseif( $request->account_type == 1 ){
            $customer->account_type = 1;
            $customer->company = $request->company;
            $customer->rc = $request->rc;
            $customer->cif = $request->cif;
            $customer->bank_account = $request->bank_account;
            $customer->bank_name = $request->bank_name;
        }
        if ( empty($customer->email) ){
            $customer->email = $request->email;
            $email_token = str_random(35);
            $mail = $request->email;
            $nume = ((int)$request->account_type == 0)?$request->name:$request->company;
            Mail::to($mail)->send(new CustomerLinkConfirmation($nume,$email_token));
            $customer->email_token = $email_token;
        }
        $customer->address = $request->address;
        $customer->save();

        $request->session()->flash('mesaj','Profilul a fost actualizat cu succes!');
        return redirect('customer/profile');
    }

    /**
     * Displays page to logged customers for changing password
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newPassword()
    {
        return view('decoweb::customers.auth.passwords.update');
    }

    /**
     * Updates password for logged customers
     *
     * @param Request $request
     * @param $id
     */
    public function updatePassword(Request $request, $id)
    {
        $customer = $this->customerExists((int)($id));
        //dd($customer);
        if( ctype_digit(trim($id)) !== true || $customer == null ){
            $request->session()->flash('mesaj','Problema legata de id-ul utilizatorului.');
            return redirect('customer/newPassword');
        }

        $this->validate($request,[
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        $customer->password = Hash::make($request->password);
        $customer->save();

        $request->session()->flash('status','Parola a fost modificata cu succes!');
        return redirect('customer/newPassword');
    }
    private function customerExists($id)
    {
        $customer = Customer::find($id);
        return $customer;
    }
}
