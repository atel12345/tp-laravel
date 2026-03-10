<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::all();
        return response()->json([
            'data'    => $loans,
            'message' => 'Loans retrieved successfully',
            'count'   => $loans->count(),
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'borrower_name'  => 'required|string|max:255',
            'borrower_email' => 'required|email',
            'book_title'     => 'required|string|max:255',
            'borrowed_at'    => 'nullable|date',
            'due_date'       => 'nullable|date',
            'returned'       => 'nullable|boolean',
            'status'         => 'nullable|in:active,returned,overdue',
        ]);

        $loan = Loan::create($validated);
        return response()->json([
            'data'    => $loan,
            'message' => 'Loan created successfully',
        ], 201);
    }

    public function show($id)
    {
        $loan = Loan::find($id);
        if (!$loan) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
        return response()->json([
            'data'    => $loan,
            'message' => 'Loan retrieved successfully',
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::find($id);
        if (!$loan) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
        $validated = $request->validate([
            'borrower_name'  => 'sometimes|string|max:255',
            'borrower_email' => 'sometimes|email',
            'book_title'     => 'sometimes|string|max:255',
            'borrowed_at'    => 'nullable|date',
            'due_date'       => 'nullable|date',
            'returned'       => 'nullable|boolean',
            'status'         => 'nullable|in:active,returned,overdue',
        ]);
        $loan->update($validated);
        return response()->json([
            'data'    => $loan,
            'message' => 'Loan updated successfully',
        ], 200);
    }

    public function destroy($id)
    {
        $loan = Loan::find($id);
        if (!$loan) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
        $loan->delete();
        return response()->json([
            'message' => 'Loan deleted successfully',
        ], 204);
    }
}