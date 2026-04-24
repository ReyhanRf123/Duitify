<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-surface p-6 rounded-3xl shadow-sm">
                <h3 class="text-lg font-bold text-on-surface mb-4">Tambah Kategori Baru</h3>
                <form action="{{ route('categories.store') }}" method="POST" class="flex flex-col md:flex-row gap-4">
                    @csrf
                    <input type="text" name="name" placeholder="Nama Kategori (misal: Jajan)" required
                        class="flex-1 p-4 bg-surface-container-low border-none rounded-xl shadow-inner focus:ring-primary/20">
                    
                    <select name="type" class="p-4 bg-surface-container-low border-none rounded-xl shadow-inner focus:ring-primary/20">
                        <option value="expense">Pengeluaran</option>
                        <option value="income">Pemasukan</option>
                    </select>

                    <button type="submit" class="px-8 py-4 bg-primary text-white rounded-xl font-bold hover:bg-primary/90 transition-all">
                        Simpan
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach(['income' => 'Pemasukan', 'expense' => 'Pengeluaran'] as $type => $label)
                    <div class="space-y-4">
                        <h4 class="text-xs uppercase tracking-widest font-bold text-on-surface-variant px-2">{{ $label }}</h4>
                        <div class="space-y-2">
                            @foreach($categories->where('type', $type) as $cat)
                                <div class="bg-surface p-4 rounded-2xl flex justify-between items-center group shadow-sm">
                                    <span class="font-medium text-on-surface">{{ $cat->name }}</span>
                                    <form action="{{ route('categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-on-surface-variant/30 group-hover:text-red-500 transition-colors">
                                            <span class="material-icons-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>