<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">マイページ</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 py-8">

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($reservations->isEmpty())
            <p class="text-gray-500">予約はありません。</p>
        @else
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3">予約日</th>
                            <th class="px-4 py-3">時間</th>
                            <th class="px-4 py-3">種別</th>
                            <th class="px-4 py-3">状態</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                            <tr class="border-t">
                                <td class="px-4 py-3">{{ $reservation->date }}</td>
                                <td class="px-4 py-3">
                                    {{ substr($reservation->start_time, 0, 5) }}〜{{ substr($reservation->end_time, 0, 5) }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $reservation->type === 'online' ? 'オンライン' : '電話' }}
                                </td>
                                <td class="px-4 py-3">
                                    @if ($reservation->status === 'confirmed')
                                        <span class="text-green-600 font-medium">確定</span>
                                    @else
                                        <span class="text-gray-400">キャンセル済み</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if ($reservation->status === 'confirmed')
                                        <form method="POST" action="{{ route('mypage.cancel', $reservation) }}"
                                            onsubmit="return confirm('キャンセルしますか？')">
                                            @csrf
                                            @method('PATCH')
                                            <x-danger-button type="submit">キャンセル</x-danger-button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
