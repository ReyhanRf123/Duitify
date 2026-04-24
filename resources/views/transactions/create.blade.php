<x-app-layout>
    <div class="py-12" x-data="{ 
        transactionType: 'expense', 
        allCategories: {{ $categories->toJson() }} 
    }">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-surface p-8 rounded-3xl space-y-8 shadow-sm">
                
                <header>
                    <h2 class="text-3xl font-display text-on-surface tracking-tight">Catat Transaksi</h2>
                    <p class="text-on-surface-variant text-sm">Rekam arus kas kamu dengan presisi.</p>
                </header>

                <form action="{{ route('transactions.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <label class="text-xs uppercase tracking-widest font-bold text-primary/70">Nominal</label>
                        <div class="relative">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-2xl font-display text-on-surface-variant/50">Rp</span>
                            <input type="number" name="amount" required
                                class="w-full pl-16 pr-6 py-6 bg-surface-container-low border-none rounded-2xl text-4xl font-display text-on-surface shadow-inner focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-on-surface-variant/20"
                                placeholder="0">
                        </div>
                        @error('amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest font-bold text-primary/70">Jenis</label>
                            <select name="type" x-model="transactionType" 
                                class="w-full p-4 bg-surface-container-low border-none rounded-xl shadow-inner focus:ring-primary/20">
                                <option value="expense">Pengeluaran</option>
                                <option value="income">Pemasukan</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest font-bold text-primary/70">Kategori</label>
                            <select name="category_id" required
                                class="w-full p-4 bg-surface-container-low border-none rounded-xl shadow-inner focus:ring-primary/20">
                                <option value="">Pilih Kategori</option>
                                <template x-for="category in allCategories.filter(c => c.type === transactionType)" :key="category.id">
                                    <option :value="category.id" x-text="category.name"></option>
                                </template>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest font-bold text-primary/70">Sumber Dana</label>
                            <select name="account_id" required
                                class="w-full p-4 bg-surface-container-low border-none rounded-xl shadow-inner focus:ring-primary/20">
                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->name }} (Rp{{ number_format($account->balance, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest font-bold text-primary/70">Tanggal</label>
                            <input type="date" name="date" value="{{ date('Y-m-d') }}" required
                                class="w-full p-4 bg-surface-container-low border-none rounded-xl shadow-inner focus:ring-primary/20 text-on-surface">
                        </div>
                    </div>

                    <div class="space-y-2" x-show="transactionType === 'expense'" x-transition>
                        <label class="text-xs uppercase tracking-widest font-bold text-primary/70">Alokasi Tabungan (Opsional)</label>
                        <select name="saving_goal_id" class="w-full p-4 bg-surface-container-low border-none rounded-xl shadow-inner focus:ring-primary/20">
                            <option value="">-- Bukan untuk Tabungan --</option>
                            @foreach($savingGoals as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs uppercase tracking-widest font-bold text-primary/70">Keterangan</label>
                        <textarea name="description" rows="3" 
                            class="w-full p-4 bg-surface-container-low border-none rounded-xl shadow-inner focus:ring-primary/20 placeholder:text-on-surface-variant/30"
                            placeholder="Contoh: Makan siang di kantin..."></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" 
                            class="w-full py-4 bg-primary text-white rounded-2xl font-bold text-lg hover:bg-primary/90 hover:shadow-xl hover:shadow-primary/20 transition-all active:scale-[0.98]">
                            Simpan <span x-text="transactionType === 'expense' ? 'Pengeluaran' : 'Pemasukan'"></span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>