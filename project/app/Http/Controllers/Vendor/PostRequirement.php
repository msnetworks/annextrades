<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth; 
use Datatables;
class PostRequirement extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function index()
   {
       return view('vendor.postrequirement.index');
   }
   public function quote($id)
   {
       return view('vendor.postrequirement.quotes')->with('id', $id);
   }
   public function submitquote()
   {
       return view('vendor.postrequirement.submitquotes');
   }
   public function edit($id)
    {
        $data = DB::table('PostRequest')->where('id', $id)->get();
        return view('vendor.postrequirement.edit_postrequirement')->with('data', $data);
    }
    public function update(Request $request)
    {
        $file = $request->file('photo');
        if ($file) {
        $image = time().str_replace(' ', '', $file->getClientOriginalName());
        $file->move('assets/images/postrequest',$image);
        }
        else {
            $image = $request->oldphoto;
        }

        $file1 = $request->file('photo1');
        if ($file1  != '') {
        $image1 = time().str_replace(' ', '', $file1->getClientOriginalName());
        $file1->move('assets/images/postrequest',$image1);
        }
        else {
            $image1 = $request->oldphoto;
        }
        
        $file2 = $request->file('photo2');
        if ($file2 != '') {
        $image2 = time().str_replace(' ', '', $file2->getClientOriginalName());
        $file2->move('assets/images/postrequest',$image2);
        }
        else {
            $image2 = $request->oldphoto;
        }

        $file3 = $request->file('photo3');
        if ($file3 != '') {
        $image3 = time().str_replace(' ', '', $file3->getClientOriginalName());
        $file3->move('assets/images/postrequest',$image3);
        } 
        else {
            $image3 = $request->oldphoto;
        }

        $file4 = $request->file('photo4');
        if ($file4 != '') {
            $image4 = time().str_replace(' ', '', $file4->getClientOriginalName());
            $file4->move('assets/images/postrequest',$image4);
        }
        else {
            $image4 = $request->oldphoto;
        }

        $update = DB::table('PostRequest')->where('id', $request->id)->update(['company_name' => $request->company_name, 'type' => $request->type, 
        'product_name' => $request->product_name, 'product_des' => $request->product_des, 'price_from' => $request->price_from, 'price_to' => $request->price_to,
        'deadline' => $request->deadline, 'name' => $request->name, 'address' => $request->address, 'city' => $request->city, 'state' => $request->state, 'pincode' => $request->pincode,
        'country' => $request->country, 'phone' => $request->phone, 'email' => $request->email, 'homepage' => $request->homepage, 'regions' => $request->regions, 'contact_regions' => $request->select_regions,
        'photo' => $image, 'photo1' => $image1, 'photo2' => $image2, 'photo3' => $image3, 'photo4' => $image4]);
         
        return back()->with('success', 'Update Successfully');
    }
}

