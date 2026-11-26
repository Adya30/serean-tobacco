<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user->isCustomer()) {
            return redirect()->route('home');
        }

        $petanis = User::where('role', 'petani')
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'total_petani' => $petanis->count(),
            'total_customer' => User::where('role', 'customer')->count(),
            'stok_tembakau_kg' => 1450,
            'varietas_aktif' => 25,
            'kadar_air_rata' => '12–14%',
        ];

        return view('dashboard.index', compact('user', 'petanis', 'stats'));
    }

    public function storePetani(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if (! $user->isAdmin()) {
            return back()->with('error', 'Hanya administrator yang berhak mendaftarkan akun petani.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'phone' => ['nullable', 'string', 'max:30'],
            'farm_location' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'petani',
            'phone' => $validated['phone'] ?? null,
            'farm_location' => $validated['farm_location'] ?? 'Wilayah Situbondo',
            'address' => $validated['address'] ?? null,
            'status' => 'active',
        ]);

        return back()->with('status', 'Akun login Petani Mitra baru berhasil didaftarkan ke sistem.');
    }

    public function deletePetani(User $petani): RedirectResponse
    {
        if (! Auth::user()->isAdmin()) {
            return back()->with('error', 'Akses ditolak.');
        }

        if ($petani->role === 'petani') {
            $petani->delete();

            return back()->with('status', 'Data petani berhasil dihapus dari sistem.');
        }

        return back()->with('error', 'Akun tersebut bukan petani.');
    }
}
