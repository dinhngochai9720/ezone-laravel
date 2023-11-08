<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;


class ActiveUserController extends Controller
{
    //
    public function AdminAllUser()
    {
        $users = User::where('role', 'user')->get();


        return view('backend.account.user_all_view', compact('users'));
    }

    public function AdminAllVendor()
    {
        $vendors = User::where('role', 'vendor')->get();


        return view('backend.account.vendor_all_view', compact('vendors'));
    }
}
