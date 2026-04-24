<x-guest-layout>
    <div class="mb-4 text-sm text-on-surface-variant">
        {{ __('Demi keamanan akun Duitify kamu, masukkan 6 digit kode verifikasi yang baru saja kami kirimkan ke email kamu.') }}
    </div>

    <form method="POST" action="{{ route('verify-2fa.store') }}">
        @csrf

        <div>
            <x-input-label for="two_factor_code" :value="__('Kode Verifikasi')" />
            <x-text-input id="two_factor_code" class="block mt-1 w-full text-center text-2xl tracking-[1em] font-bold" 
                            type="text" name="two_factor_code" required autofocus />
            <x-input-error :messages="$errors->get('two_factor_code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-on-surface-variant hover:text-primary rounded-md" href="{{ route('verify-2fa.resend') }}">
                {{ __('Kirim ulang kode?') }}
            </a>

            <x-primary-button class="ms-3">
                {{ __('Verifikasi') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>