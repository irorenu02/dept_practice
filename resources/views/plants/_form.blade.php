<div class="space-y-6">

    {{-- Plant Name --}}
    <div>
        <label for="plant_name" class="block text-sm font-semibold text-gray-700 mb-2">
            Plant Name
        </label>

        <input type="text"
            id="plant_name"
            name="plant_name"
            value="{{ old('plant_name', $plant->plant_name ?? '') }}"
            placeholder="Enter plant name"
            required
            class="w-full rounded-lg border border-gray-300 px-4 py-3
                   text-gray-900 shadow-sm focus:border-green-600
                   focus:ring-green-600">
                   
        @error('plant_name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Category --}}
    <div>
        <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
            Category
        </label>

        <select id="category" name="category" required
            class="w-full rounded-lg border border-gray-300 px-4 py-3
                   text-gray-900 shadow-sm focus:border-green-600
                   focus:ring-green-600">

            <option value="">Select Category</option>

            @foreach(['Ornamental', 'Flowering', 'Succulent', 'Herb'] as $category)
                <option value="{{ $category }}"
                    {{ old('category', $plant->category ?? '') == $category ? 'selected' : '' }}>
                    {{ $category }}
                </option>
            @endforeach
        </select>

        @error('category')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Unit Price --}}
    <div>
        <label for="unit_price" class="block text-sm font-semibold text-gray-700 mb-2">
            Unit Price (₱)
        </label>

        <input type="number"
            id="unit_price"
            name="unit_price"
            step="0.01"
            min="0"
            value="{{ old('unit_price', $plant->unit_price ?? '') }}"
            placeholder="0.00"
            required
            class="w-full rounded-lg border border-gray-300 px-4 py-3
                   text-gray-900 shadow-sm focus:border-green-600
                   focus:ring-green-600">

        @error('unit_price')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Description --}}
    <div>
        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
            Description
        </label>

        <textarea id="description"
            name="description"
            rows="4"
            placeholder="Enter plant description"
            required
            class="w-full rounded-lg border border-gray-300 px-4 py-3
                   text-gray-900 shadow-sm focus:border-green-600
                   focus:ring-green-600">{{ old('description', $plant->description ?? '') }}</textarea>

        @error('description')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Stock Status --}}
    <div>
        <label for="stock_status" class="block text-sm font-semibold text-gray-700 mb-2">
            Stock Status
        </label>

        <select id="stock_status" name="stock_status" required
            class="w-full rounded-lg border border-gray-300 px-4 py-3
                   text-gray-900 shadow-sm focus:border-green-600
                   focus:ring-green-600">

            <option value="">Select Status</option>

            <option value="in_stock"
                {{ old('stock_status', $plant->stock_status ?? '') == 'in_stock' ? 'selected' : '' }}>
                In Stock
            </option>

            <option value="out_of_stock"
                {{ old('stock_status', $plant->stock_status ?? '') == 'out_of_stock' ? 'selected' : '' }}>
                Out of Stock
            </option>
        </select>

        @error('stock_status')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Submit Button --}}
    <div class="pt-4 border-t border-gray-200">
        <button type="submit"
            class="inline-flex items-center justify-center px-6 py-3
                   bg-green-700 hover:bg-green-600 text-white
                   font-semibold rounded-lg shadow-md
                   transition duration-200">
            Save Plant
        </button>
    </div>

</div>