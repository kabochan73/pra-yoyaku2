<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">コート予約</h2>
    </x-slot>

    <div class="max-w-xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow p-6">

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('reservations.store') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="date" value="予約日" />
                    <x-text-input id="date" name="date" type="date" class="mt-1 block w-full"
                        value="{{ old('date') }}" min="{{ date('Y-m-d') }}" required />
                </div>

                <div class="mb-4">
                    <x-input-label for="start_time" value="開始時間" />
                    <x-text-input id="start_time" name="start_time" type="time" class="mt-1 block w-full"
                        value="{{ old('start_time') }}" required />
                </div>

                <div class="mb-6">
                    <x-input-label for="duration" value="利用時間" />
                    <select id="duration" name="duration" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="1" {{ old('duration') == 1 ? 'selected' : '' }}>1時間（¥3,000）</option>
                        <option value="2" {{ old('duration') == 2 ? 'selected' : '' }}>2時間（¥5,500）</option>
                        <option value="3" {{ old('duration') == 3 ? 'selected' : '' }}>3時間（¥7,500）</option>
                    </select>
                </div>

                <x-primary-button class="w-full justify-center">
                    予約を確定する
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
