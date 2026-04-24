<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-surface p-6 rounded-3xl shadow-sm">
                <h3 class="text-lg font-bold text-on-surface mb-4">Tambah Sumber Dana</h3>
                <form action="{{ route('accounts.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @csrf
                    <input type="text" name="name" placeholder="Nama Akun (misal: Bank Jago)" required
                        class="p-4 bg-surface-container-low border-none rounded-xl shadow-inner focus:ring-primary/20">
                    
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/50 font-bold">Rp</span>
                        <input type="number" name="balance" placeholder="Saldo Awal" required
                            class="w-full pl-12 pr-4 p-4 bg-surface-container-low border-none rounded-xl shadow-inner focus:ring-primary/20">
                    </div>

                    <button type="submit" class="px-8 py-4 bg-primary text-white rounded-xl font-bold hover:bg-primary/90 transition-all">
                        Tambah Akun
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($accounts as $account)
                    <div class="bg-surface p-6 rounded-3xl flex justify-between items-center shadow-sm border border-transparent hover:border-primary/10 transition-all">
                        <div>
                            <p class="text-[10px] uppercase tracking-widest font-bold text-on-surface-variant/60">Nama Akun</p>
                            <h4 class="text-lg font-bold text-on-surface">{{ $account->name }}</h4>
                        </div>
                        <div class="text-right flex items-center gap-4">
                            <div>
                                <p class="text-[10px] uppercase tracking-widest font-bold text-on-surface-variant/60">Saldo</p>
                                <p class="text-lg font-display font-bold text-primary">
                                    Rp{{ number_format($account->balance, 0, ',', '.') }}
                                </p>
                            </div>
                            
                            <form action="{{ route('accounts.destroy', $account) }}" method="POST" onsubmit="return confirm('Hapus akun ini?')">
                                @csrf @method('DELETE')
                                <button class="p-2 text-on-surface-variant/20 hover:text-red-500 transition-colors">
                                    <span class="material-icons-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-2 text-center py-10">
                        <p class="text-on-surface-variant">Kamu belum mendaftarkan akun bank atau dompet digital.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>