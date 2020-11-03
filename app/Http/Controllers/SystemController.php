<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index() 
    {
        return view('index');
    }

    public function show(User $user)
    {
        return json_encode(array('data' => $user));
    }

    public function update(Request $request, $user)
    {
        $data = $request->validate([
            'client_id' => ['required', 'string', 'max:255'],
            'license_key' => ['required', 'string', 'max:255'],
            'license_for' => ['required', 'string', 'max:255'],
        ]);

        $user = User::findOrFail($user);

        $user->license_key = $data['license_key'];
        $months = "+" . $data['license_for'] . " months";
        $time = strtotime($months);
        $user->expire_date = date("Y-m-d h:i:sa", $time);
        $user->update();
        
        return redirect('license');
    }

    public function check(Request $request)
    {
        $data = $request->validate([
            'license_key' => ['required', 'string', 'max:255'],
        ]);
        
        $user = User::where('license_key', $request['license_key'])->firstOrFail();

        $date = $user['expire_date'];

        $date = strtotime($date);

        $date = date('d/m/Y', $date);

        return redirect('license')->with('status', ' Your License Has Been Activated. It will work till ' .$date. '.');
    }
}
