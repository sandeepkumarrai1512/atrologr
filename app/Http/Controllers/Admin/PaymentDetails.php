<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentDetails extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->get();
        return view('admin.paymentDetails.index', compact('payments'));
    }

    public function create()
    {
        return view('admin.paymentDetails.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|unique:payments',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric'
        ]);

        Payment::create($request->all());

        return redirect()->route('admin.paymentDetails.index')
                         ->with('success','Payment Added Successfully');
    }
}
