<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ApiKeyController extends Controller
{
    public function index(): View
    {
        $apiKeys = ApiKey::with('user')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('api-keys.index', compact('apiKeys'));
    }

    public function create(): View
    {
        return view('api-keys.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $plainKey = 'go_' . Str::random(48);

        ApiKey::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'key' => $plainKey,
        ]);

        return redirect()->route('api-keys.index')
            ->with('success', 'API Key berhasil dibuat')
            ->with('new_api_key', $plainKey);
    }

    public function destroy(ApiKey $apiKey): RedirectResponse
    {
        if ($apiKey->user_id !== auth()->id()) {
            abort(403);
        }

        $apiKey->delete();

        return redirect()->route('api-keys.index')
            ->with('success', 'API Key berhasil dihapus');
    }

    public function toggle(ApiKey $apiKey): RedirectResponse
    {
        if ($apiKey->user_id !== auth()->id()) {
            abort(403);
        }

        $apiKey->update(['is_active' => !$apiKey->is_active]);

        return redirect()->route('api-keys.index')
            ->with('success', 'API Key ' . ($apiKey->is_active ? 'diaktifkan' : 'dinonaktifkan'));
    }
}
