@if (count($clinicHours) > 0)
<div class="overflow-x-auto pt-7">
  <table class="table table-zebra">
    <!-- head -->
    <thead>
       <tr>
      <th class="text-lg text-center">Start Time</th>
      <th class="text-lg text-center">End Time</th>
      <th class="text-lg text-center">Time Slot</th>
      <th class="text-lg text-center">Action Taken</th>
    </tr>
    </thead>
    <tbody>
            @forelse ($clinicHours as $patient)
      <tr>
        <td class="text-md font-bold text-center">
          {{ $patient->start_time }}
        </td>
        <td class="text-center font-bold text-md">{{ $patient->end_time }}</td>
        <td class="text-center font-bold text-md">{{ $patient->time_range }}</td>
        <td class="text-center">
              <div class="flex items-center justify-center gap-2">
          <a href="{{route('admin.editTime', $patient->id)}}" class="btn btn-accent">View</a>
          
            <button class="btn btn-error"
                  data-file-id="{{$patient->id}}"
                  data-toggle-modal="#deleteConfirmationModal">
              Delete
          </button>
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="3" class="text-center text-gray-500">No clinic hour available.</td>
      </tr>
    @endforelse

      
    </tbody>
  </table>
</div>
{{ $clinicHours->links() }}
@else
<div class="flex flex-col items-center justify-center pt-10">
    <div class="text-3xl font-bold  mb-4">No Clinic Hour at the moment</div>
    <a href="{{route('admin.addTime')}}" class="px-4 py-3 rounded-md outline-none text-md text-white bg-violet-600 hover:bg-violet-700">Add Time Slot</a>
</div>
@endif
