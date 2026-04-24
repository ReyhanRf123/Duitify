<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        // Ambil kategori milik user yang sedang login
        $categories = Auth::user()->categories()->orderBy('type')->get();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'type' => 'required|in:income,expense',
        ]);

        auth()->user()->categories()->create($validated);

        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }
    
    public function destroy(Category $category)
    {
        // Pastikan user hanya bisa menghapus kategorinya sendiri
        if ($category->user_id !== auth()->id()) {
            abort(403);
        }

        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}
