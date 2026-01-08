<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAddressId;
use Illuminate\Http\Request;

class UserAddressIdController extends Controller
{
    public function registerOrLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'building_unit' => 'required',
            'apartment_number' => 'required',
            'room_number' => 'nullable'
        ]);
        $name = trim($request->name);
        $buildingUnit = trim($request->building_unit);
        $apartmentNumber = trim($request->apartment_number);
        $roomNumber = $request->room_number ? trim($request->room_number) : null;
        $userAddress = UserAddressId::firstOrCreate(
            [
                'name' => $name,
                'building_unit' => $buildingUnit,
                'apartment_number' => $apartmentNumber,
                'room_number' => $roomNumber
            ]
        );

        $key_peoples = User::where('hasKey', true)->get();
        session([
            'user_address' => $userAddress,
            'key_peoples' => $key_peoples
        ]);
        if ($userAddress->wasRecentlyCreated) {
            return redirect()->route('dashboard')->with('status', 'Addess added Successfully🎉👋');
        } else {
            return redirect()->route('dashboard')->with('status', 'Logged in with existing address ✅');
        }

        return redirect()->back()->with('status', 'Problem please contact Developers');
    }
}
