<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-surface p-8 rounded-3xl shadow-sm">
                <h3 class="text-xl font-bold text-on-surface mb-6 font-display">Tentukan Ambisi Barumu</h3>
                <form action="{{ route('saving_goals.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs uppercase font-bold tracking-widest text-primary/70">Nama Target</label>
                        <input type="text" name="name" placeholder="Misal: Upgrade RAM Laptop" required
                            class="w-full p-4 bg-surface-container-low border-none rounded-2xl shadow-inner focus:ring-primary/20">
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-xs uppercase font-bold tracking-widest text-primary/70">Target Dana (Rp)</label>
                        <input type="number" name="target_amount" placeholder="0" required
                            class="w-full p-4 bg-surface-container-low border-none rounded-2xl shadow-inner focus:ring-primary/20 font-display text-lg text-primary">
                    </div>

                    <div class="md:col-span-2 space-y-2">
                        <label class="text-xs uppercase font-bold tracking-widest text-primary/70">Tenggat Waktu (Deadline)</label>
                        <input type="date" name="deadline" required
                            class="w-full p-4 bg-surface-container-low border-none rounded-2xl shadow-inner focus:ring-primary/20">
                    </div>

                    <div class="md:col-span-2 pt-2">
                        <button type="submit" class="w-full py-4 bg-primary text-on-primary rounded-2xl font-bold hover:shadow-lg transition-all">
                            Mulai Menabung
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($goals as $goal)
                    @php
                        $percentage = $goal->target_amount > 0 ? min(($goal->current_amount / $goal->target_amount) * 100, 100) : 0;
                    @endphp
                    <div class="bg-surface p-6 rounded-3xl shadow-sm border border-transparent hover:border-primary/10 transition-all">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-lg font-bold text-on-surface">{{ $goal->name }}</h4>
                                <p class="text-xs text-on-surface-variant">Sisa: Rp{{ number_format($goal->target_amount - $goal->current_amount, 0, ',', '.') }}</p>
                                <p class="text-[10px] text-primary font-bold uppercase mt-1">Deadline: {{ \Carbon\Carbon::parse($goal->deadline)->format('d M Y') }}</p>
                            </div>
                            </div>
                        </div>
                @empty
                    <div class="md:col-span-2 text-center py-10 opacity-50 italic">Belum ada target tabungan yang dibuat.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>