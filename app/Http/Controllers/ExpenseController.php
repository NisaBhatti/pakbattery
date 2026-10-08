<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::query();

        // Filters
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('expense_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('expense_date', '<=', $request->date_to);
        }

        $expenses = $query->latest('expense_date')->paginate(15)->withQueryString();

        // Stats
        $totalExpense = Expense::sum('amount');
        $thisMonthExpense = Expense::whereMonth('expense_date', now()->month)
                                   ->whereYear('expense_date', now()->year)
                                   ->sum('amount');
        $todayExpense = Expense::whereDate('expense_date', today())->sum('amount');

        return view('pages.expenses.show', compact(
            'expenses',
            'totalExpense',
            'thisMonthExpense',
            'todayExpense'
        ));
    }

    public function create()
    {
        $categories = Expense::categories();
        return view('pages.expenses.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'payment_method' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        Expense::create($request->all());

        return redirect()->route('expenses.index')->with('success', 'Expense recorded successfully!');
    }

    public function show(Expense $expense)
    {
        return view('pages.expenses.view', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $categories = Expense::categories();
        return view('pages.expenses.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'payment_method' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $expense->update($request->all());

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully!');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');
    }

    public function confirmDelete(Expense $expense)
    {
        return view('pages.expenses.delete', compact('expense'));
    }
}