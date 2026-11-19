<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Plant Inventory Reports
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Inventory Summary --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

                <div class="bg-white p-6 shadow-sm rounded-lg">
                    <h3 class="text-gray-500">Total Plants</h3>
                    <p class="text-3xl font-bold">{{ $totalPlants }}</p>
                </div>

                <div class="bg-white p-6 shadow-sm rounded-lg">
                    <h3 class="text-gray-500">In Stock</h3>
                    <p class="text-3xl font-bold text-green-600">
                        {{ $inStock }}
                    </p>
                </div>

                <div class="bg-white p-6 shadow-sm rounded-lg">
                    <h3 class="text-gray-500">Out of Stock</h3>
                    <p class="text-3xl font-bold text-red-600">
                        {{ $outOfStock }}
                    </p>
                </div>

            </div>

            {{-- Category Summary --}}
            <div class="bg-white p-6 shadow-sm rounded-lg mb-6">
                <h3 class="text-lg font-semibold mb-4">
                    Plants by Category
                </h3>

                @forelse ($categoryCounts as $category)
                    <div class="flex justify-between border-b py-2">
                        <span>{{ $category->category }}</span>
                        <span class="font-semibold">{{ $category->total }}</span>
                    </div>
                @empty
                    <p class="text-gray-500">No plant records available.</p>
                @endforelse
            </div>

            {{-- Report Filters --}}
            <div class="bg-white p-6 shadow-sm rounded-lg mb-6">
                <h3 class="text-lg font-semibold mb-4">
                    Filter Plant Reports
                </h3>

                <form method="GET" action="{{ route('reports.index') }}"
                    class="flex flex-wrap gap-4 items-end">

                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Category
                        </label>

                        <select name="category"
                            class="border-gray-300 rounded-md">
                            <option value="">All Categories</option>

                            @foreach (['Ornamental', 'Flowering', 'Succulent', 'Herb'] as $category)
                                <option value="{{ $category }}"
                                    @selected(($filters['category'] ?? '') === $category)>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Stock Status
                        </label>

                        <select name="stock_status"
                            class="border-gray-300 rounded-md">
                            <option value="">All Stock Statuses</option>

                            <option value="in_stock"
                                @selected(($filters['stock_status'] ?? '') === 'in_stock')>
                                In Stock
                            </option>

                            <option value="out_of_stock"
                                @selected(($filters['stock_status'] ?? '') === 'out_of_stock')>
                                Out of Stock
                            </option>
                        </select>
                    </div>

                    <button type="submit"
    style="display: inline-block; background-color: #15803d; color: white; padding: 10px 16px; border-radius: 6px; font-weight: 600; cursor: pointer;">
    Apply Filters
</button>
                    <a href="{{ route('reports.index') }}"
   style="display: inline-flex; align-items: center; justify-content: center; background-color: #e5e7eb; padding: 10px 16px; border-radius: 6px; color: #1f2937; text-decoration: none;">
    Reset
</a>
<a href="{{ route('reports.pdf', request()->query()) }}"
   style="display: inline-flex; align-items: center; justify-content: center; background-color: #495ff2; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-weight: 600;">
    Download PDF
</a>
<a href="{{ route('reports.csv', request()->query()) }}"
   style="display: inline-flex; align-items: center; justify-content: center; background-color: #495ff2; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-weight: 600;">
    Download CSV
</a>

                </form>

            </div>

            {{-- Plant Price List / Filtered Report --}}
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <h3 class="text-lg font-semibold mb-4">
                    Plant Price List
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-3 border">Plant Name</th>
                                <th class="p-3 border">Category</th>
                                <th class="p-3 border">Unit Price</th>
                                <th class="p-3 border">Stock Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($plants as $plant)
                                <tr>
                                    <td class="p-3 border">
                                        {{ $plant->plant_name }}
                                    </td>

                                    <td class="p-3 border">
                                        {{ $plant->category }}
                                    </td>

                                    <td class="p-3 border">
                                        ₱{{ number_format($plant->unit_price, 2) }}
                                    </td>

                                    <td class="p-3 border">
                                        {{ $plant->stock_status === 'in_stock'
                                            ? 'In Stock'
                                            : 'Out of Stock' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="p-4 text-center text-gray-500">
                                        No plants found for the selected filters.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>