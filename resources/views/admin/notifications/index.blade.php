@extends('admin.layout')

@section('title', 'Send notifications')
@section('breadcrumb', 'Send notifications')

@section('content')
    <div class="mb-6">
        <h1 class="text-xl font-bold text-slate-800">Send push notifications</h1>
        <p class="text-sm text-slate-500 mt-0.5">Deliver notifications to users’ mobile devices. Filter and select users below, then compose and send.</p>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 sm:p-6 mb-6">
        <h2 class="text-sm font-semibold text-slate-700 mb-3">Filter users</h2>
        <form method="GET" action="{{ route('admin.notifications.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="lg:col-span-2">
                    <label for="search" class="block text-xs font-medium text-slate-500 mb-1">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Name, phone, or email..." class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66]">
                </div>
                <div>
                    <label for="date_from" class="block text-xs font-medium text-slate-500 mb-1">Registered from (date)</label>
                    <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66]">
                </div>
                <div>
                    <label for="date_to" class="block text-xs font-medium text-slate-500 mb-1">Registered to (date)</label>
                    <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66]">
                </div>
                <div>
                    <label for="time_from" class="block text-xs font-medium text-slate-500 mb-1">Time from</label>
                    <input type="time" name="time_from" id="time_from" value="{{ request('time_from') }}" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66]">
                </div>
                <div>
                    <label for="time_to" class="block text-xs font-medium text-slate-500 mb-1">Time to</label>
                    <input type="time" name="time_to" id="time_to" value="{{ request('time_to') }}" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66]">
                </div>
            </div>
            <div class="flex flex-wrap gap-2">
                <button type="submit" class="rounded-xl bg-[#1A3D66] hover:bg-[#153354] text-white font-medium py-2.5 px-4 text-sm">Apply filters</button>
                <a href="{{ route('admin.notifications.index') }}" class="rounded-xl border border-slate-200 bg-white text-slate-700 font-medium py-2.5 px-4 text-sm hover:bg-slate-50">Clear</a>
            </div>
        </form>
    </div>

    {{-- Compose & send form --}}
    <form method="POST" action="{{ route('admin.notifications.send') }}" id="notification-form" class="space-y-6">
        @csrf

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 sm:p-6">
            <h2 class="text-sm font-semibold text-slate-700 mb-4">Compose notification</h2>
            <div class="space-y-4 max-w-xl">
                <div>
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-1">Title *</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required maxlength="255" placeholder="Notification title" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66] @error('title') border-red-500 @enderror">
                    @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="body" class="block text-sm font-medium text-slate-700 mb-1">Message *</label>
                    <textarea name="body" id="body" required rows="4" maxlength="5000" placeholder="Notification message body..." class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66] @error('body') border-red-500 @enderror">{{ old('body') }}</textarea>
                    @error('body')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-4 py-3 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <h2 class="text-sm font-semibold text-slate-700">Select recipients</h2>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="send_to_all" id="send_to_all" value="1" {{ old('send_to_all') ? 'checked' : '' }} class="rounded border-slate-300 text-[#1A3D66] focus:ring-[#1A3D66]">
                    <span class="text-sm font-medium text-slate-700">Send to all users</span>
                </label>
            </div>
            <div class="p-4 border-b border-slate-200 bg-slate-50/50">
                <label class="flex items-center gap-2 cursor-pointer max-w-fit">
                    <input type="checkbox" id="select_all_in_list" class="rounded border-slate-300 text-[#1A3D66] focus:ring-[#1A3D66]">
                    <span class="text-sm font-medium text-slate-700">Select all in list ({{ $users->count() }} users)</span>
                </label>
            </div>
            <div class="overflow-x-auto max-h-[320px] overflow-y-auto">
                @if($users->isEmpty())
                    <div class="px-4 py-8 text-center text-slate-500 text-sm">No users match the current filters. Adjust filters or clear them to see all users.</div>
                @else
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50 sticky top-0">
                            <tr>
                                <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-10">
                                    <input type="checkbox" id="select_all_header" aria-label="Select all" class="rounded border-slate-300 text-[#1A3D66] focus:ring-[#1A3D66]">
                                </th>
                                <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Name</th>
                                <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Phone</th>
                                <th class="px-4 py-2.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider hidden sm:table-cell">Registered</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @foreach($users as $user)
                                <tr class="hover:bg-slate-50/50 user-row">
                                    <td class="px-4 py-2.5">
                                        <input type="checkbox" name="user_phones[]" value="{{ $user->user_phone_e164 }}" class="user-checkbox rounded border-slate-300 text-[#1A3D66] focus:ring-[#1A3D66]" {{ old('send_to_all') ? 'disabled' : '' }}>
                                    </td>
                                    <td class="px-4 py-2.5 text-sm font-medium text-slate-800">{{ $user->name }}</td>
                                    <td class="px-4 py-2.5 text-sm text-slate-600 break-all">{{ $user->user_phone_e164 }}</td>
                                    <td class="px-4 py-2.5 text-sm text-slate-500 hidden sm:table-cell">{{ $user->created_at->format('M j, Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            @if(!$users->isEmpty())
                <div class="px-4 py-3 border-t border-slate-200 bg-slate-50/50 flex flex-wrap items-center justify-between gap-2">
                    <p class="text-xs text-slate-500"><span id="selected-count">0</span> selected</p>
                    <button type="submit" class="rounded-xl bg-[#1A3D66] hover:bg-[#153354] text-white font-semibold py-2.5 px-5 text-sm inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        Send to selected devices
                    </button>
                </div>
            @endif
        </div>
    </form>

    <p class="mt-4 text-xs text-slate-500">Notifications are sent via Firebase Cloud Messaging (FCM) to devices that have registered a token. Ensure <code class="bg-slate-100 px-1 rounded">FCM_SERVER_KEY</code> is set in .env.</p>

    <script>
        (function() {
            var form = document.getElementById('notification-form');
            if (!form) return;
            var sendToAll = document.getElementById('send_to_all');
            var selectAllInList = document.getElementById('select_all_in_list');
            var selectAllHeader = document.getElementById('select_all_header');
            var checkboxes = form.querySelectorAll('.user-checkbox');
            var selectedCountEl = document.getElementById('selected-count');

            function updateCount() {
                if (!selectedCountEl) return;
                var n = 0;
                checkboxes.forEach(function(cb) {
                    if (!cb.disabled && cb.checked) n++;
                });
                selectedCountEl.textContent = n;
            }

            function setAllList(checked) {
                checkboxes.forEach(function(cb) {
                    if (!cb.disabled) cb.checked = checked;
                });
                if (selectAllInList) selectAllInList.checked = checked;
                if (selectAllHeader) selectAllHeader.checked = checked;
                updateCount();
            }

            if (sendToAll) {
                sendToAll.addEventListener('change', function() {
                    var disabled = sendToAll.checked;
                    checkboxes.forEach(function(cb) { cb.disabled = disabled; });
                    if (disabled) setAllList(false);
                    updateCount();
                });
            }

            if (selectAllInList) {
                selectAllInList.addEventListener('change', function() {
                    setAllList(selectAllInList.checked);
                });
            }
            if (selectAllHeader) {
                selectAllHeader.addEventListener('change', function() {
                    setAllList(selectAllHeader.checked);
                });
            }
            checkboxes.forEach(function(cb) {
                cb.addEventListener('change', function() {
                    updateCount();
                    if (!selectAllInList || !selectAllHeader) return;
                    var all = Array.prototype.every.call(checkboxes, function(c) { return c.disabled || c.checked; });
                    var any = Array.prototype.some.call(checkboxes, function(c) { return !c.disabled && c.checked; });
                    selectAllInList.checked = all;
                    selectAllHeader.checked = all;
                });
            });
            updateCount();
        })();
    </script>
@endsection
