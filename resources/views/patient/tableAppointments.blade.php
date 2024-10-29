@if (count($reservations) > 0)
<div class="overflow-x-auto pt-7">
  <table class="table table-zebra">
    <!-- head -->
    <thead>
      <tr>
        <th class="text-lg">Name</th>
        <th class="text-lg">Treatment</th>
        <th class="text-lg">Date</th>
        <th class="text-lg">Time</th>
        <th class="text-lg">Status</th>
        <th class="text-center text-lg">Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- row 1 -->
      @forelse ($reservations as $reservation)
      <tr>
        <td>You</td>
        <td>{{$reservation->treatment_choice}}</td>
        <td  class="min-w-[190px]">{{ \Carbon\Carbon::parse($reservation->timeSlots->date)->format('F j, Y') }}</td>
        <td class="min-w-[170px]">{{$reservation->timeSlots->time_range}}</td>
        <td>{{$reservation->reservation_status}}</td>
        <td>
          <div class="flex items-center justify-center gap-2">
              {{-- <a href="" class="text-white rounded-md px-4 py-3 bg-green-500 hover:bg-green-600 text-center whitespace-nowrap">VIEW</a> --}}
              <button class="delete-btn text-white py-3 px-6 bg-red-500 hover:bg-red-600 rounded-md"
                    data-file-id=""
                    data-toggle-modal="#deleteConfirmationModal">
                CANCEL
            </button>
            </div>
        </td>
      </tr>
      @empty
          
      @endforelse
     
    </tbody>
  </table>
</div>

@else
<div class="flex flex-col items-center justify-center">
    <div class="text-3xl font-bold  mb-4">No Reservations</div>
    <p class="text-xl mb-6">It looks like there are no reservations at the moment.</p>
    <a href="{{route('patient.create')}}" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
        Book a Reservation
    </a>
</div>
@endif
