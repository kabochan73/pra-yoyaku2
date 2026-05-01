<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">顧客詳細</h2>
            <a href="{{ route('admin.customers.index') }}" class="text-gray-600 hover:underline">← 顧客一覧に戻る</a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 py-8 space-y-6">

        <!-- 個人情報 -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold text-lg mb-4">個人情報</h3>
            <dl class="grid grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm text-gray-500">氏名</dt>
                    <dd class="font-medium">{{ $user->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">メールアドレス</dt>
                    <dd class="font-medium">{{ $user->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">電話番号</dt>
                    <dd class="font-medium">{{ $user->phone ?? '未登録' }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">登録日</dt>
                    <dd class="font-medium">{{ $user->created_at->format('Y/m/d') }}</dd>
                </div>
            </dl>
        </div>

        <!-- 予約履歴 -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold text-lg mb-4">予約履歴</h3>
            @if ($reservations->isEmpty())
                <p class="text-gray-500">予約履歴はありません。</p>
            @else
                <table class="w-full text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">予約日</th>
                            <th class="px-4 py-2">時間</th>
                            <th class="px-4 py-2">種別</th>
                            <th class="px-4 py-2">状態</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $reservation->date }}</td>
                                <td class="px-4 py-2">
                                    {{ substr($reservation->start_time, 0, 5) }}〜{{ substr($reservation->end_time, 0, 5) }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $reservation->type === 'online' ? 'オンライン' : '電話' }}
                                </td>
                                <td class="px-4 py-2">
                                    @if ($reservation->status === 'confirmed')
                                        <span class="text-green-600 font-medium">確定</span>
                                    @else
                                        <span class="text-gray-400">キャンセル済み</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
