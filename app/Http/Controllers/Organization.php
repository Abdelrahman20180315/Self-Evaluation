<?php

namespace App\Http\Controllers;

use App\Models\Organization as ModelsOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Organization extends Controller
{
    public function enter_organizationstatus()
    {
        return view('Admins.enter_organizationstatus');
    }
    public function store_organizationstatus(Request $request)
    {
        $validateData = $request->validate([
            'organization_status' => 'required'
        ],[
            'organization_status.required' => 'من فضلك ادخل حالة الشركة او المنظمة'
        ]);

        ModelsOrganization::create([
            'organization_status' => $request->organization_status
        ]);
        
        Session::flash('message','لقد تم اضافة حالة الشركة او المنظمة بنجاح');
        
        return redirect()->back();
    }
    public function show_organizationstatus()
    {
        $organizations = ModelsOrganization::all();
        return view('Admins.show_organizationstatus',compact('organizations'));
    }

    public function edit_organization($id)
    {
        $organization = ModelsOrganization::find($id);
        return view('Admins.edit_organizationstatus',compact('organization'));
    }

    public function update_organizationstatus($id , Request $request)
    {
        $organization = ModelsOrganization::find($id);
        $organization->update([
            'organization_status' => $request->organization_status 
        ]);

        Session::flash('message','لقد تم تعديل حالة الشركة او المنظمة بنجاح');
        
        return redirect()->back();
    }

    public function delete_organization($id)
    {
        $organization = ModelsOrganization::find($id);
        $organization->delete();
        Session::flash('delete' , 'لقد تم حذف حالة المنظمة او الشركة بنجاح');
        return redirect()->back();
    }

}
