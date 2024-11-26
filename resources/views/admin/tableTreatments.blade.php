@if (count($treatments) > 0)
<div class="overflow-x-auto mt-4">
  <table class="table table-zebra">
    <!-- head -->
    <thead>
      <tr>
        <th class="text-lg">Treatment_ID</th>
        <th class="text-lg">Treatment_Name</th>
        <th class="text-lg">Created_At</th>
        <th class="text-center text-lg">Action</th>
      </tr>
    </thead>
    <tbody>
     @forelse ($treatments as $treatment)
     <tr>
      <td>{{$treatment->id}}</td>
      <td>{{$treatment->treatment_offer}}</td>
      <td>{{$treatment->created_at}}</td>
      <td>
        <div class="flex items-center justify-center gap-2">
          <a href="{{route('treatment.edit', $treatment->id)}}" class="text-white rounded-md px-4 py-3 bg-green-500 hover:bg-green-600 text-center whitespace-nowrap">View</a>
          
            <button class="delete-btn text-white py-3 px-6 bg-red-500 hover:bg-red-600 rounded-md"
                  data-file-id=""
                  data-toggle-modal="#deleteConfirmationModal">
              DELETE
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
<div class="flex flex-col mt-10 items-center justify-center">
  <div class="text-3xl font-bold  mb-4">No ActiveUsers</div>
  <p class="text-xl mb-6">It looks like there are no active users at the moment.</p>
</div>
@endif