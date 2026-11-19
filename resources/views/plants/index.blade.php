<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Plant Records
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Add Plant Button --}}
            <div class="mb-6">
                <a href="{{ route('plants.create') }}"
                   class="inline-flex items-center px-5 py-2.5
                          bg-green-700 hover:bg-green-600
                          text-white font-semibold rounded-lg shadow
                          transition duration-200">
                    + Add Plant
                </a>
            </div>

            {{-- Plant Records Table --}}
            <div class="bg-white p-6 shadow-lg rounded-xl overflow-x-auto">

                <div class="mb-5">
                    <h3 class="text-xl font-bold text-gray-900">
                        Inventory List
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Manage your registered plant inventory.
                    </p>
                </div>

                <table class="w-full text-left border-collapse">

                    <thead>
                        <tr class="bg-gray-100 text-gray-900">
                            <th class="p-4 border-b-2 border-gray-200">Name</th>
                            <th class="p-4 border-b-2 border-gray-200">Category</th>
                            <th class="p-4 border-b-2 border-gray-200">Price</th>
                            <th class="p-4 border-b-2 border-gray-200">Status</th>
                            <th class="p-4 border-b-2 border-gray-200">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-900">

                        @forelse($plants as $plant)
                            <tr class="bg-white hover:bg-gray-50 transition duration-150">

                                <td class="p-4 border-b border-gray-200 font-medium">
                                    {{ $plant->plant_name }}
                                </td>

                                <td class="p-4 border-b border-gray-200">
                                    {{ $plant->category }}
                                </td>

                                <td class="p-4 border-b border-gray-200 font-semibold">
                                    ₱{{ number_format($plant->unit_price, 2) }}
                                </td>

                                <td class="p-4 border-b border-gray-200">
                                    @if($plant->stock_status === 'in_stock')
                                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                            In Stock
                                        </span>
                                    @else
                                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                            Out of Stock
                                        </span>
                                    @endif
                                </td>

                                <td class="p-4 border-b border-gray-200">
                                    <div class="flex flex-wrap gap-3">

                                        <a href="{{ route('plants.show', $plant) }}"
                                           class="text-blue-700 hover:text-blue-900 font-semibold">
                                            View
                                        </a>

                                        <a href="{{ route('plants.edit', $plant) }}"
                                           class="text-green-700 hover:text-green-900 font-semibold">
                                            Edit
                                        </a>

                                        <form action="{{ route('plants.destroy', $plant) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete this plant?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="text-red-700 hover:text-red-900 font-semibold">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5"
                                    class="p-8 text-center text-gray-500">
                                    No plant records available.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>