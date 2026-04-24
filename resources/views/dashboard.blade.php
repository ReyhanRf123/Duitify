<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-green-50 p-4 rounded-3xl border border-green-100">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="material-icons-outlined text-green-600 text-sm">trending_up</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-green-700/70">Bulan Ini</span>
                    </div>
                    <p class="text-lg font-display font-bold text-green-700">
                        +Rp{{ number_format($monthlyIncome, 0, ',', '.') }}
                    </p>
                </div>

                <div class="bg-orange-50 p-4 rounded-3xl border border-orange-100">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="material-icons-outlined text-orange-600 text-sm">trending_down</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-orange-700/70">Bulan Ini</span>
                    </div>
                    <p class="text-lg font-display font-bold text-orange-700">
                        -Rp{{ number_format($monthlyExpense, 0, ',', '.') }}
                    </p>
                </div>
                <div class="bg-orange-50 p-4 rounded-3xl border border-orange-100 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="material-icons-outlined text-orange-600 text-sm">trending_down</span>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-orange-700/70">Pengeluaran</span>
                        </div>
                        <p class="text-lg font-display font-bold text-orange-700">
                            -Rp{{ number_format($monthlyExpense, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="mt-4 space-y-1">
                        <div class="flex justify-between items-center text-[9px] font-bold uppercase tracking-tighter text-orange-700/50">
                            <span>Burn Rate</span>
                            <span>{{ round($expenseRatio) }}%</span>
                        </div>
                        <div class="w-full h-1.5 bg-orange-200/50 rounded-full overflow-hidden">
                            <div class="h-full bg-orange-500 rounded-full transition-all duration-1000" 
                                style="width: {{ $expenseRatio }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-surface p-6 rounded-3xl mt-6">
                <h3 class="text-sm font-bold text-on-surface uppercase tracking-widest mb-4">Alokasi Pengeluaran</h3>
                
                <div class="space-y-4">
                    @forelse($categoryDistributions as $item)
                        <div class="space-y-1">
                            <div class="flex justify-between items-center text-sm">
                                <span class="font-medium text-on-surface-variant">{{ $item->category->name }}</span>
                                <span class="font-bold text-on-surface">Rp{{ number_format($item->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="w-full h-2 bg-surface-container-low rounded-full overflow-hidden">
                                <div class="h-full bg-primary/40 rounded-full" style="width: {{ $item->percentage }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-on-surface-variant italic">Belum ada data pengeluaran bulan ini.</p>
                    @endforelse
                </div>
            </div>
            
            <header class="text-center space-y-2">
                <p class="text-sm font-medium tracking-widest uppercase text-on-surface-variant">Total Net Worth</p>
                <h1 class="font-display text-5xl md:text-7xl text-on-surface tracking-tight">
                    Rp{{ number_format($totalBalance, 0, ',', '.') }}
                </h1>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($accounts as $account)
                    <div class="card-hero flex flex-col justify-between h-40">
                        <div>
                            <span class="text-xs font-bold text-primary/60 uppercase tracking-wider">{{ $account->name }}</span>
                            <h3 class="text-2xl mt-1">Rp{{ number_format($account->balance, 0, ',', '.') }}</h3>
                        </div>
                        <div class="flex justify-end">
                             <span class="text-xs text-on-surface-variant/50">Updated just now</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <section class="space-y-4">
                <h2 class="text-xl">Saving Goals</h2>
                <div class="grid grid-cols-1 gap-4">
                    @foreach($savingGoals as $goal)
                        <div class="bg-surface-container-low rounded-xl p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex-1">
                                <h4 class="font-bold text-on-surface">{{ $goal->name }}</h4>
                                <div class="w-full bg-surface-container-high rounded-full h-2 mt-2">
                                    <div class="bg-primary h-2 rounded-full" style="width: {{ ($goal->current_amount / $goal->target_amount) * 100 }}%"></div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-on-surface">Rp{{ number_format($goal->current_amount, 0, ',', '.') }}</p>
                                <p class="text-xs text-on-surface-variant">Target: Rp{{ number_format($goal->target_amount, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="flex flex-col md:flex-row items-center justify-between gap-4 py-6">
                <div class="hidden md:block">
                    <h3 class="text-lg font-bold text-on-surface">Ringkasan Aktivitas</h3>
                    <p class="text-xs text-on-surface-variant">Pantau terus arus kasmu hari ini.</p>
                </div>

                <a href="{{ route('transactions.create') }}" 
                class="group relative flex items-center justify-center gap-3 px-8 py-4 bg-primary text-on-primary rounded-2xl font-bold text-lg shadow-lg shadow-primary/20 transition-all duration-300 hover:bg-primary/90 hover:shadow-xl hover:shadow-primary/30 hover:-translate-y-1 active:scale-95 w-full md:w-auto overflow-hidden">
                    
                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    
                    <span class="material-icons-outlined text-2xl group-hover:rotate-90 transition-transform duration-500 text-white">
                        add
                    </span>
                    
                    <span class="text-white">Tambah Transaksi</span>
                </a>
            </section>

        </div>
    </div>
</x-app-layout>