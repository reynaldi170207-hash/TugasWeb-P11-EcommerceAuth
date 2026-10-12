<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Katalog Produk</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-flash />

            <form method="GET" action="{{ route('home') }}" class="mb-6 flex flex-wrap gap-3 px-4 sm:px-0">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk"
                       class="rounded-md border-gray-300 shadow-sm text-sm w-64">
                <select name="category" class="rounded-md border-gray-300 shadow-sm text-sm">
                    <option value="">Semua kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                    @endforeach
                </select>
                <button class="rounded-md bg-gray-800 px-4 py-2 text-sm text-white hover:bg-gray-700">Terapkan</button>
            </form>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 px-4 sm:px-0">
                @forelse ($products as $product)
                    <a href="{{ route('products.show', $product) }}" class="bg-white shadow-sm rounded-lg p-4 flex flex-col hover:shadow-md transition">
                        <span class="text-xs uppercase tracking-wide text-indigo-600">{{ $product->category->name }}</span>
                        <span class="mt-1 font-semibold text-gray-800">{{ $product->name }}</span>
                        <span class="mt-2 text-gray-900">{{ $product->formatted_price }}</span>
                        <span class="mt-1 text-xs text-gray-500">Stok {{ $product->stock }}</span>
                        <div class="mt-3 flex flex-wrap gap-1">
                            @foreach ($product->tags as $tag)
                                <span class="rounded bg-gray-100 px-2 py-0.5 text-xs text-gray-600">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500">Produk tidak ditemukan.</p>
                @endforelse
            </div>

            <div class="mt-6 px-4 sm:px-0">{{ $products->links() }}</div>
        </div>
    </div>
</x-app-layout>
