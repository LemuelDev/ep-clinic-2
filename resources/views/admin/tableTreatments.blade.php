@if (count($treatments) > 0)
<div class="overflow-x-auto mt-4">
  <table class="table table-zebra">
    <!-- head -->
    <thead>
      <tr>
        <th class="text-lg text-center">Treatment_Number</th>
        <th class="text-lg text-center">Treatment_Name</th>
      
        <th class="text-center text-lg">Action Taken</th>
      </tr>
    </thead>
    <tbody>
     @forelse ($treatments as $treatment)
     <tr>
      <td class="text-center">{{$treatment->id}}</td>
      <td class="text-center">{{$treatment->treatment_offer}}</td>
    
      <td>
        <div class="flex items-center justify-center gap-2">
          <a href="{{route('treatment.edit', $treatment->id)}}" class="btn btn-accent">View</a>
          
            <button class="btn btn-error"
                  data-file-id="{{$treatment->id}}"
                  data-toggle-modal="#deleteConfirmationModal">
              Delete
          </button>
          </div>
      </td>
    </tr>
     @empty
         
     @endforelse
  
    </tbody>
  </table>
</div>
{{ $treatments->links() }}
@else
<div class="flex flex-col mt-10 items-center justify-center">
  <div class="text-3xl font-bold  mb-4">No Treatments</div>
  <p class="text-xl mb-6">It looks like there are no treatments at the moment.</p>
  <a href="{{route('treatment.add')}}" class="px-8 py-3 rounded-md outline-none text-lg text-white bg-blue-600 hover:bg-blue-700">Create new one</a>
</div>
@endif