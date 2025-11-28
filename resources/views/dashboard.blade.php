<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Selamat datang kembali, {{ auth()->user()->name }} 👋
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(auth()->user()->role === 'superuser' && isset($users))
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold">
                                Daftar User
                            </h3>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full text-m">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th class="py-2 px-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400">
                                            Nama
                                        </th>
                                        <th class="py-2 px-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400">
                                            Email
                                        </th>
                                        <th class="py-2 px-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400">
                                            Status Akun
                                        </th>
                                        <th class="py-2 px-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @forelse($users as $user)
                                        <tr>
                                            <td class="py-2 px-3">
                                                {{ $user->name }}
                                            </td>
                                            <td class="py-2 px-3 text-gray-500 dark:text-gray-300">
                                                {{ $user->email }}
                                            </td>
                                            <td class="py-2 px-3">
                                                @if ($user->email_verified_at)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                                                 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200">
                                                        Verified
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                                                 bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-200">
                                                        Not Verified
                                                    </span>
                                                @endif
                                            </td>
                                             <td class="py-3 px-4 text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    @if (!$user->email_verified_at)
                                                        <form action="{{ route('admin.user.verify', $user->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-blue-600 dark:text-blue-300
                                                                    hover:bg-blue-100 dark:hover:bg-blue-900/40 rounded-md transition">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M5 13l4 4L19 7" />
                                                                </svg>
                                                                 Verify
                                                            </button>
                                                        </form>
                                                    @endif

                                                    {{-- TOMBOL DELETE --}}
                                                    <form action="" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                            class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-red-600 dark:text-red-300
                                                                hover:bg-red-100 dark:hover:bg-red-900/40 rounded-md transition">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-4 px-3 text-center text-sm text-gray-500 dark:text-gray-400">
                                                Belum ada user yang terdaftar.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            @if(auth()->user()->role === 'user')
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-2">
                            Status Aplikasi Kamu
                        </h3>

                        @if(auth()->user()->app)
                            <p class="text-sm">
                                Kamu sudah punya aplikasi:
                                <span class="font-semibold">
                                    {{ auth()->user()->app->app_name }}
                                </span>
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Slug: {{ auth()->user()->app->app_slug }}
                            </p>
                        @else
                            <p class="text-sm">
                                <span class="font-semibold">Nonaktif</span>
                            </p>
                        @endif
                    </div>
                </div>
            @endif

        </div>

         <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(auth()->user()->role === 'superuser' && isset($users))
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold">
                                Daftar Aplikasi
                            </h3>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full text-m">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th class="py-2 px-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400">
                                            Nama
                                        </th>
                                        <th class="py-2 px-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400">
                                            Nama Aplikasi
                                        </th>
                                        <th class="py-2 px-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400">
                                            Slug
                                        </th>
                                        <th class="py-2 px-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400">
                                            Setting
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @forelse($apps as $app)
                                        <tr>
                                            <td class="py-2 px-3">
                                                {{ $app->user->name }}
                                            </td>
                                            <td class="py-2 px-3 text-gray-500 dark:text-gray-300">
                                                {{ $app->app_name }}
                                            </td>
                                            <td class="py-2 px-3 text-gray-500 dark:text-gray-300">
                                                {{ $app->app_slug }}
                                            </td>
                                            <td class="py-2 px-3 text-gray-500 dark:text-gray-300">
                                                {{ $app->setting }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-4 px-3 text-center text-sm text-gray-500 dark:text-gray-400">
                                                Belum ada Aplikasi yang terverifikasi.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            @if(auth()->user()->role === 'user')
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-2">
                            Status Aplikasi Kamu
                        </h3>

                        @if(auth()->user()->app)
                            <p class="text-sm">
                                Kamu sudah punya aplikasi:
                                <span class="font-semibold">
                                    {{ auth()->user()->app->app_name }}
                                </span>
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Slug: {{ auth()->user()->app->app_slug }}
                            </p>
                        @else
                            <p class="text-sm">
                                <span class="font-semibold">Nonaktif</span>
                            </p>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
