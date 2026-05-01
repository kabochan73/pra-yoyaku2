<x-app-layout>
    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    @endpush

    <!-- カレンダー -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">予約状況</h2>
        <div id="calendar" class="bg-white rounded-lg shadow p-4"></div>
    </div>

    <!-- 施設紹介 -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 border-t">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">施設紹介</h2>
        <p class="text-gray-600">{{ $court->description }}</p>
    </div>

    <!-- 料金 -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 border-t">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">料金</h2>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">利用時間</th>
                    <th class="px-4 py-2 border">料金</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-2 border">1時間</td>
                    <td class="px-4 py-2 border">¥3,000</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border">2時間</td>
                    <td class="px-4 py-2 border">¥5,500</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border">3時間</td>
                    <td class="px-4 py-2 border">¥7,500</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'ja',
                events: @json($calendarEvents),
            });
            calendar.render();
        });
    </script>
</x-app-layout>
