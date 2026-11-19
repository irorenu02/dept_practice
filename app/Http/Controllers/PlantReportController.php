<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PlantReportController extends Controller
{
    public function index(Request $request)
    {
        // Validate the optional report filters.
        $filters = $request->validate([
            'category' => 'nullable|in:Ornamental,Flowering,Succulent,Herb',
            'stock_status' => 'nullable|in:in_stock,out_of_stock',
        ]);

        // Retrieve plants belonging to the authenticated user.
        $baseQuery = $request->user()->plants();

        // Apply filters to the displayed report.
        $plants = (clone $baseQuery)
            ->when($filters['category'] ?? null, function ($query, $category) {
                $query->where('category', $category);
            })
            ->when($filters['stock_status'] ?? null, function ($query, $status) {
                $query->where('stock_status', $status);
            })
            ->orderBy('plant_name')
            ->get();

        // Generate inventory summaries.
        $totalPlants = (clone $baseQuery)->count();

        $inStock = (clone $baseQuery)
            ->where('stock_status', 'in_stock')
            ->count();

        $outOfStock = (clone $baseQuery)
            ->where('stock_status', 'out_of_stock')
            ->count();

        // Count plants under each category.
        $categoryCounts = (clone $baseQuery)
            ->selectRaw('category, COUNT(*) as total')
            ->groupBy('category')
            ->orderBy('category')
            ->get();

        return view('reports.index', compact(
            'plants',
            'filters',
            'totalPlants',
            'inStock',
            'outOfStock',
            'categoryCounts'
        ));
    }
    public function exportPdf(Request $request)
{
    $filters = $request->validate([
        'category' => 'nullable|in:Ornamental,Flowering,Succulent,Herb',
        'stock_status' => 'nullable|in:in_stock,out_of_stock',
    ]);

    $plants = $request->user()->plants()
        ->when($filters['category'] ?? null, function ($query, $category) {
            $query->where('category', $category);
        })
        ->when($filters['stock_status'] ?? null, function ($query, $status) {
            $query->where('stock_status', $status);
        })
        ->orderBy('plant_name')
        ->get();

    $pdf = Pdf::loadView('reports.pdf', compact('plants', 'filters'));

    return $pdf->download('plant-inventory-report.pdf');
}

public function exportCsv(Request $request)
{
    $filters = $request->validate([
        'category' => 'nullable|in:Ornamental,Flowering,Succulent,Herb',
        'stock_status' => 'nullable|in:in_stock,out_of_stock',
    ]);

    $plants = $request->user()->plants()
        ->when($filters['category'] ?? null, function ($query, $category) {
            $query->where('category', $category);
        })
        ->when($filters['stock_status'] ?? null, function ($query, $status) {
            $query->where('stock_status', $status);
        })
        ->orderBy('plant_name')
        ->get();

    return response()->streamDownload(function () use ($plants) {
        $handle = fopen('php://output', 'w');

        // UTF-8 BOM helps spreadsheet applications display characters correctly.
        fwrite($handle, "\xEF\xBB\xBF");

        fputcsv($handle, [
            'Plant Name',
            'Category',
            'Unit Price',
            'Description',
            'Stock Status',
        ], ',', '"', '');

        foreach ($plants as $plant) {
            fputcsv($handle, [
                $plant->plant_name,
                $plant->category,
                $plant->unit_price,
                $plant->description,
                $plant->stock_status === 'in_stock'
                    ? 'In Stock'
                    : 'Out of Stock',
            ], ',', '"', '');
        }

        fclose($handle);
    }, 'plant-inventory-report.csv', [
        'Content-Type' => 'text/csv; charset=UTF-8',
    ]);
}

}