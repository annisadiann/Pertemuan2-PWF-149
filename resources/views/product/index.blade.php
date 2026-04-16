<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Product List</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage your product inventory</p>
                        </div>
                        <a href="{{ route('product.create') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition">
                            Add Product
                        </a>

                        @can('export-product')
                        <a href="{{ route('product.export') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
                            Export Excel
                        </a>
                        @endcan
                    </div>

                    @if (session('success'))
                        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">#</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Owner</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse ($products as $product)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-4 py-4 text-gray-400">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-4 font-medium text-gray-800 dark:text-gray-100">{{ $product->name }}</td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $product->quantity > 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-700' }}">
                                            {{ $product->quantity }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-gray-700 dark:text-gray-300 font-mono">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-4 text-gray-600 dark:text-gray-400">
                                        {{ $product->user->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('product.show', $product->id) }}"
                                                class="px-2 py-1 text-xs rounded text-indigo-600 hover:bg-indigo-50 transition">View</a>
                                            <a href="{{ route('product.edit', $product) }}"
                                                class="px-2 py-1 text-xs rounded text-amber-600 hover:bg-amber-50 transition">Edit</a>
                                            <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                                onsubmit="return confirm('Delete this product?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-2 py-1 text-xs rounded text-red-600 hover:bg-red-50 transition">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                        No products found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($products->hasPages())
                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>