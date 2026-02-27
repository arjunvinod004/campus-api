<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; 
use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    // public function index(Request $request)
    // {
    //     return $request->user()->assignments;
    // }

    public function index(Request $request)
{
    $assignments = $request->user()
        ->assignments()
        ->latest()
        ->get();

    return response()->json([
        'status' => true,
        'message' => 'Assignments fetched successfully',
        'data' => $assignments
    ], 200);
}

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'subject' => 'required|string',
            'status' => 'in:Pending,Submitted,Approved'
        ]);

        $assignment = $request->user()->assignments()->create($request->all());

        return response()->json($assignment, 201);
    }

    public function show(Request $request, $id)
    {
        $assignment = $request->user()->assignments()->findOrFail($id);
        return $assignment;
    }

    public function update(Request $request, $id)
    {
        $assignment = $request->user()->assignments()->findOrFail($id);

        $assignment->update($request->all());

        return response()->json($assignment);
    }

    public function destroy(Request $request, $id)
    {
        $assignment = $request->user()->assignments()->findOrFail($id);
        $assignment->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}