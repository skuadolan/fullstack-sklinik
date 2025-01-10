<x-dynamic-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User System') }}
        </h2>
    </x-slot>

    <div class="w-full py-12">
        <div class="shadow max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <fieldset>
                        <legend class="text-xl font-semibold text-gray-800">
                            {{ __('User System') }}
                        </legend>
                        <div class="w-full flex justify-between items-center">
                            <div class="w-1/2 flex flex-wrap">
                                <form id="search" onsubmit="">
                                    <style>
                                        td {
                                            border: none !important;
                                        }
                                    </style>
                                </form>
                            </div>
                            <!-- Tombol Tambah User -->
                            <a href="" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                {{ __('Tambah User') }}
                            </a>
                        </div>
                    </fieldset>
                    <div class="mt-6">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2">{{ __('No') }}</th>
                                    <th class="px-4 py-2">{{ __('Username') }}</th>
                                    <th class="px-4 py-2">{{ __('Email') }}</th>
                                    <th class="px-4 py-2">{{ __('Role') }}</th>
                                    <th class="px-4 py-2">{{ __('Deskripsi') }}</th>
                                    <th class="px-4 py-2">{{ __('Status') }}</th>
                                    <th class="px-4 py-2">{{ __('Aksi') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <td class="px-4 py-2" style="text-align: center;" >{{ $index + 1 }}</td>
                                        <td class="px-4 py-2">{{ $user->username }}</td>
                                        <td class="px-4 py-2">{{ $user->email }}</td>
                                        <td class="px-4 py-2">{{ $user->role_name }}</td>
                                        <td class="px-4 py-2">{{ $user->description }}</td>
                                        <td class="px-4 py-2" style="text-align: center;">
                                            <span class="inline-block px-4 py-2 text-white rounded-md {{ $user->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                                                {{ $user->status == 1 ? __('Aktif') : __('Non-aktif') }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2">
                                            <a href="" class="px-4 py-2 text-white rounded-md bg-yellow-500 hover:bg-yellow-600">
                                                {{ __('Edit') }}
                                            </a> &nbsp;&nbsp;
                                            <a href="" class="px-4 py-2 text-white rounded-md bg-red-500 hover:bg-red-600">
                                                {{ __('Hapus') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dynamic-layout>
