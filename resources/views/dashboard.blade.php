<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
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

            <section class="space-y-4">
                <button><a href="{{ route('transactions.create') }}">Tambah Transaksi</a></button>
            </section>

        </div>
    </div>
</x-app-layout>