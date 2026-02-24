@extends('admin.layout')

@section('title', 'Customers')

@section('content')
    <div class="mb-4 sm:mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-[#2D3748]">Customers</h1>
        <p class="text-sm text-[#718096] mt-1">View, edit, and delete are disabled for privacy.</p>
    </div>
    <form class="mb-4 flex flex-col sm:flex-row gap-2" method="GET">
        <input type="text" name="user_phone_e164" value="{{ request('user_phone_e164') }}" placeholder="Filter by user phone" class="w-full sm:w-auto min-w-0 rounded-xl border border-[#E2E8F0] bg-white px-4 py-2.5 text-sm text-[#2D3748] placeholder-[#718096] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:border-transparent">
        <button type="submit" class="rounded-xl bg-white border border-[#E2E8F0] text-[#2D3748] font-medium px-4 py-2.5 text-sm hover:bg-[#F8F8F8] w-full sm:w-auto">Filter</button>
    </form>
    <div class="bg-white rounded-xl sm:rounded-2xl border border-[#E2E8F0] overflow-hidden -mx-4 sm:mx-0">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#E2E8F0]">
                <thead class="bg-[#F8F8F8]">
                    <tr>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Phone</th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Name</th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">User</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E2E8F0]">
                    @forelse ($customers as $customer)
                        <tr class="hover:bg-[#F8F8F8]">
                            <td class="px-2 sm:px-4 py-2 sm:py-3 text-sm text-[#2D3748] break-all">{{ $customer->customer_phone_e164 }}</td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3 text-sm text-[#2D3748]">{{ $customer->customer_name }}</td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3 text-sm text-[#2D3748] break-all">{{ $customer->user_phone_e164 }} @if($customer->user)({{ $customer->user->name }})@endif</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-8 text-center text-[#718096]">No customers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($customers->hasPages())
            <div class="px-2 sm:px-4 py-3 border-t border-[#E2E8F0] overflow-x-auto">
                {{ $customers->links() }}
            </div>
        @endif
    </div>
@endsection
