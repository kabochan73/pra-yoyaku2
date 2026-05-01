<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">顧客管理</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 py-8">
        @if ($users->isEmpty())
            <p class="text-gray-500">登録ユーザーはいません。</p>
        @else
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3">氏名</th>
                            <th class="px-4 py-3">メールアドレス</th>
                            <th class="px-4 py-3">電話番号</th>
                            <th class="px-4 py-3">予約件数</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-t">
                                <td class="px-4 py-3">{{ $user->name }}</td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">{{ $user->phone ?? '未登録' }}</td>
                                <td class="px-4 py-3">{{ $user->reservations_count }}件</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.customers.show', $user) }}"
                                        class="text-blue-600 hover:underline">詳細</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
