<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Plant Nursery Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-2xl font-bold mb-2">
                        Welcome, {{ Auth::user()->name }}! 🌱
                    </h3>

                    <p class="text-gray-600 dark:text-gray-400">
                        Welcome to the Plant Nursery Inventory Management System.
                        Manage your plants, monitor stock availability, and
                        keep your inventory records organized.
                    </p>

                </div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">


                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">

                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            🌿 Plant Inventory
                        </h3>

                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            View, add, edit, and manage your plant records.
                        </p>

                        <a href="{{ route('plants.index') }}"
                           class="inline-block mt-4 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Manage Plants
                        </a>

                    </div>
                </div>


                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">

                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            📊 Plant Reports
                        </h3>

                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            View plant availability, categories, and price lists.
                        </p>

                        <a href="{{ route('reports.index') }}"
                           class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            View Reports
                        </a>

                    </div>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>