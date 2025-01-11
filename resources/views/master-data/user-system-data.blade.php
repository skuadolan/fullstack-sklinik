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
                <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                <td class="px-4 py-2">{{ $user->username }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2">{{ $user->role_name }}</td>
                <td class="px-4 py-2">{{ $user->description }}</td>
                <td class="px-4 py-2 text-center">
                    <span class="inline-block px-4 py-2 text-white rounded-md {{ $user->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                        {{ $user->status == 1 ? __('Aktif') : __('Non-aktif') }}
                    </span>
                </td>
                <td class="px-4 py-2">
                    <a href="#" class="px-4 py-2 text-white rounded-md bg-yellow-500 hover:bg-yellow-600">
                        {{ __('Edit') }}
                    </a> &nbsp;&nbsp;
                    <a href="#" class="px-4 py-2 text-white rounded-md bg-red-500 hover:bg-red-600">
                        {{ __('Hapus') }}
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
