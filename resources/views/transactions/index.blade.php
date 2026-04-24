<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex justify-between items-end">
                <div>
                    <h2 class="text-3xl font-display text-on-surface tracking-tight">Riwayat Transaksi</h2>
                    <p class="text-on-surface-variant text-sm text-balance">Melihat kembali setiap langkah finansialmu.</p>
                </div>
                <a href="{{ route('transactions.create') }}" class="px-6 py-3 bg-primary text-white rounded-xl font-bold hover:shadow-lg transition-all">
                    + Transaksi Baru
                </a>
            </div>

            <div class="space-y-4">
                @forelse($transactions as $transaction)
                <div class="bg-surface p-4 rounded-3xl flex items-center justify-between hover:bg-surface-container-low transition-all group shadow-sm">
                    <div class="flex items-center gap-5 min-w-0"> <div class="w-12 h-12 flex-shrink-0 rounded-2xl {{ $transaction->type === 'income' ? 'bg-green-100 text-green-600' : 'bg-orange-100 text-orange-600' }} flex items-center justify-center transition-all">
                            <span class="material-icons-outlined">
                                {{ $transaction->type === 'income' ? 'south_west' : 'north_east' }}
                            </span>
                        </div>
                        
                        <div class="overflow-hidden">
                            <h4 class="font-bold text-on-surface truncate capitalize">{{ $transaction->description ?? 'Tanpa Keterangan' }}</h4>
                            <p class="text-[10px] text-on-surface-variant uppercase tracking-widest font-bold opacity-70">
                                {{ $transaction->category->name }} <span class="mx-1">•</span> {{ $transaction->account->name }}
                            </p>
                        </div>
                    </div>

                    <div class="text-right flex-shrink-0">
                        <p class="text-lg font-display font-bold {{ $transaction->type === 'income' ? 'text-green-500' : 'text-on-surface' }}">
                            {{ $transaction->type === 'income' ? '+' : '-' }}Rp{{ number_format($transaction->amount, 0, ',', '.') }}
                        </p>
                        <p class="text-[10px] text-on-surface-variant font-medium">
                            {{ \Carbon\Carbon::parse($transaction->date)->translatedFormat('d M Y') }}
                        </p>
                    </div>
                </div>
                @empty
                    <div class="text-center py-20 bg-surface-container-low rounded-3xl border-2 border-dashed border-on-surface-variant/20">
                        <p class="text-on-surface-variant">Belum ada transaksi yang tercatat.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $transactions->links() }}
            </div>
            <a href="{{ route('report.export') }}" class="flex items-center gap-2 text-xs font-bold bg-surface-container-high px-4 py-2 rounded-xl hover:bg-primary hover:text-white transition-all">
                <span class="material-icons-outlined text-sm">picture_as_pdf</span>
                Cetak PDF
            </a>
        </div>
    </div>
</x-app-layout>