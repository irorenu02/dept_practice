<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Plant Details
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm rounded-lg">

                <div class="space-y-4 text-gray-800 dark:text-gray-200">

                    <p>
                        <strong>Plant Name:</strong>
                        {{ $plant->plant_name }}
                    </p>

                    <p>
                        <strong>Category:</strong>
                        {{ $plant->category }}
                    </p>

                    <p>
                        <strong>Unit Price:</strong>
                        ₱{{ number_format($plant->unit_price, 2) }}
                    </p>

                    <p>
                        <strong>Description:</strong>
                        {{ $plant->description }}
                    </p>

                    <p>
                        <strong>Stock Status:</strong>
                        {{ $plant->stock_status === 'in_stock'
                            ? 'In Stock'
                            : 'Out of Stock' }}
                    </p>

                </div>

                <div class="flex gap-4 mt-6">
                    <a href="{{ route('plants.edit', $plant) }}"
                       class="bg-green-700 text-white px-4 py-2 rounded-md">
                        Edit Plant
                    </a>

                    <a href="{{ route('plants.index') }}"
                       class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md">
                        Back to Plants
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>