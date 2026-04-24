<?php

namespace App\Http\Controllers;

use App\Models\SavingGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavingGoalController extends Controller
{
    public function index()
    {
        $goals = Auth::user()->savingGoals;
        return view('saving_goals.index', compact('goals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'target_amount' => 'required|numeric|min:1',
            'deadline' => 'required|date|after:today', // Tambahkan ini
            'note' => 'nullable|string',
        ]);

        auth()->user()->savingGoals()->create($validated);

        return back()->with('success', 'Target tabungan baru berhasil dibuat!');
    }

    public function destroy(SavingGoal $savingGoal)
    {
        if ($savingGoal->user_id !== auth()->id()) {
            abort(403);
        }

        $savingGoal->delete();
        return back()->with('success', 'Target tabungan telah dihapus.');
    }
}
