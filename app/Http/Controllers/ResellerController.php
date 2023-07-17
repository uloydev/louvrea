<?php

namespace App\Http\Controllers;

use App\Models\Reseller;
use Illuminate\Http\Request;

class ResellerController extends Controller
{

    private $indexRoute = 'dashboard.reseller';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.reseller', ['resellers' => Reseller::all()]);
    }

    public function info()
    {
        return view('reseller-info', [
            'resellers' => Reseller::all(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        Reseller::create($request->only(['area', 'phone']));

        return redirect()->route($this->indexRoute);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reseller $reseller)
    {
        $this->validateRequest($request);

        $reseller->update($request->only(['area', 'phone']));

        return redirect()->route($this->indexRoute);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reseller $reseller)
    {
        $reseller->delete();
        return redirect()->route($this->indexRoute);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'area' => 'required',
            'phone' => 'required',
        ]);
    }
}
