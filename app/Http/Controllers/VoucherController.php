<?php
namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::all();
        return view('vouchers.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'voucher' => 'required|string|max:255',
            'point' => 'required|integer',
        ]);

        Voucher::create($request->all());

        return redirect()->route('voucher.index')
                         ->with('success', 'Voucher created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
    */
    public function show(Voucher $voucher)
    {
        return view('vouchers.show', compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        return view('vouchers.edit', compact('voucher'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'voucher' => 'required|string|max:255',
            'point' => 'required'
        ]);

        $voucher = Voucher::findOrFail($request->voucher_id); // Retrieve the voucher instance
        $voucher->update($request->all());

        return redirect()->route('voucher.index')
                         ->with('success', 'Voucher updated successfully.');
    }

    public function destroy($id)
    {
        Voucher::find($id)->delete();

        return redirect()->route('voucher.index')
                         ->with('success', 'Voucher deleted successfully.');
    }
}
