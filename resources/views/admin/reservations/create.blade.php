<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">電話予約登録</h2>
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

            <form method="POST" action="{{ route('admin.reservations.store') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="user_id" value="予約者" />
                    <select id="user_id" name="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">選択してください</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}（{{ $user->email }}）
                            </option>
                        @endforeach
                    </select>
                </div>

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
                        <option value="1" {{ old('duration') == 1 ? 'selected' : '' }}>1時間</option>
                        <option value="2" {{ old('duration') == 2 ? 'selected' : '' }}>2時間</option>
                        <option value="3" {{ old('duration') == 3 ? 'selected' : '' }}>3時間</option>
                    </select>
                </div>

                <div class="flex gap-4">
                    <x-primary-button class="w-full justify-center">登録する</x-primary-button>
                    <a href="{{ route('admin.reservations.index') }}"
                        class="w-full text-center py-2 px-4 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        戻る
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
