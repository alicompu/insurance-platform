<?php

namespace App\Http\Controllers;

use App\Enums\Type;
use App\Models\Address;
use App\Models\Order;
use App\Requests\AddressFormRequest;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AddressInfoController extends Controller
{
    public function store(AddressFormRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();

                $address = Address::create($data);
                $personalInfoId = session()->get('personal_info_id');

                $home = Type::HOME->value;
                $auto = Type::AUTO->value;
                $rv = Type::RV->value;

                $homeStatus = session()->get($home);
                $autoStatus = session()->get($auto);
                $rvStatus = session()->get($rv);

                $order = Order::create([
                    'personal_info_id' => $personalInfoId,
                    'address_id'       => $address->id
                ]);

                foreach ([
                             $home => $homeStatus,
                             $auto => $autoStatus,
                             $rv   => $rvStatus
                         ] as $key => $value) {
                    if ($value) {
                        $order->orderItems()->create(['type' => $key]);
                    }
                }
                DB::commit();

                session()->flash('personal_info_id');
                session()->flash($home);
                session()->flash($auto);
                session()->flash($rv);
            });

            return redirect()->to("/")->with('success', 'Address  saved successfully!');
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();

            return redirect()->to('address-info-form')->with('error', $e->getMessage());
        }
    }

    public function showForm()
    {
        return Inertia::render('AddressInformationForm');
    }
}
