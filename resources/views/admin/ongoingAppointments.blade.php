@if (count($reservations) > 0)
<div class="overflow-x-auto pt-7">
  <table class="table table-zebra">
    <!-- head -->
    <thead>
      <tr>
        <th class="text-lg">Name</th>
        <th class="text-lg">Patient Number</th>
        <th class="text-lg">Appointment Number</th>
        <th class="text-lg">Treatment</th>
        <th class="text-lg">Date</th>
        <th class="text-lg">Time</th>
        <th class="text-lg">Status</th>
        <th class="text-center text-lg">Action</th>
      </tr>
    </thead>
    <tbody>
    @forelse ($reservations as $reservation)
         <tr>
            <td class="min-w-[150px]">{{$reservation->reservation->firstname}} {{$reservation->reservation->middlename}} {{$reservation->reservation->lastname}} {{$reservation->reservation->extensionname}}</td>
            <td class="font-bold text-center">{{$reservation->reservation->patient_number}}</td>
            <td class="font-bold text-center">{{$reservation->appointment_number}}</td>
            <td class="min-w-[120px]">{{$reservation->treatment_choice}}</td>
            <td class="min-w-[150px]">{{ \Carbon\Carbon::parse($reservation->date)->format('F j, Y') }}</td>
            <td class="min-w-[110px]">{{$reservation->time_range}}</td>
            <td>{{$reservation->reservation_status}}</td>
            <td>
                <div class="flex items-center justify-center gap-2">
                    <a href="{{ route('admin.trackReservation', $reservation->id) }}" class="btn btn-accent">View</a>
                    <button class="btn btn-error"
                            data-file-id="{{ $reservation->id }}"
                            data-toggle-modal="#deleteConfirmationModal">
                        Delete
                    </button>
                </div>
            </td>
        </tr>
@empty
    <tr>
        <td colspan="8" class="text-center py-4 text-gray-500">No reservations found.</td>
    </tr>
@endforelse

      
    </tbody>
  </table>
</div>
{{ $reservations->links() }}
@else
<div class="flex flex-col items-center justify-center pt-10">
    <div class="text-3xl font-bold  mb-4">No Appointments</div>
    <p class="text-xl mb-6">It looks like there are no Appointments at the moment.</p>
    {{-- <a href="{{route('patient.create')}}" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
        Book a Reservation
    </a> --}}
</div>
@endif
