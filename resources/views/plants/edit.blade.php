<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Plant
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-white-800 p-6 shadow-sm rounded-lg">

                <form action="{{ route('plants.update', $plant) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('plants._form')
                </form>

                <div class="mt-4">
                    <a href="{{ route('plants.index') }}"
                       class="text-blue-600 hover:underline">
                        Back to Plant Records
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>