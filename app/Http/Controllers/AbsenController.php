<?php

namespace App\Http\Controllers;
use App\Models\Absen;
use App\Models\User;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absens = Absen::with('user')->paginate(10); // Eager load the associated user
        return view('absen.index', compact('absens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all(); // Fetch all users for dropdown
        return view('absen.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'check_in' => 'nullable|date_format:H:i', // Accepts H:i (no seconds)
        ]);

        Absen::create($request->all());

        return redirect()->route('absens.index')->with('success', 'Absen record created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $absen = Absen::findOrFail($id); // Retrieve the absen record
        $users = User::all(); // Fetch all users for dropdown
        return view('absen.edit', compact('absens', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'check_in' => 'nullable|date_format:H:i',
        ]);

        $absen = Absen::findOrFail($id);
        $absen->update($request->all());

        return redirect()->route('absen.index')->with('success', 'Absen record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $absen = Absen::findOrFail($id); // Retrieve the absen record by ID
    $absen->delete(); // Perform soft delete

    return redirect()->route('absen.index')->with('success', 'Absen record deleted successfully!');
    }




    public function history($userId)
{
    $user = User::findOrFail($userId); // Find user by ID
    $absens = Absen::where('user_id', $userId)->orderBy('date', 'desc')->paginate(10);

    return view('absen.history', compact('user', 'absens'));
}

}
