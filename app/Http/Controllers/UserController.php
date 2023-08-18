<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $indexRoute = 'dashboard.user';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user', ['users' => User::where('role', 'user')->get()]);
    }

    public function profile()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $this->validateRequest($request);
        $path = null;
        $user = User::where('id', auth()->id())->first();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            if (in_array($file->getExtension(), ['png', 'jpg', 'jpeg', 'gif', 'webp'])) {
                return redirect()->back();
            }
            $path = $file->store('product-image', 'public');
        }
        
        $user->update([
            'avatar' => $path,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return redirect()->route('profile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route($this->indexRoute);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
    }
}
