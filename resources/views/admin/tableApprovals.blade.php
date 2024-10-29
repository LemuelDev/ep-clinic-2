@if (count($users) > 0)
<div class="overflow-x-auto mt-4">
  <table class="table table-zebra">
    <!-- head -->
    <thead>
      <tr>
        <th class="text-lg">Name</th>
        <th class="text-lg">Contact Number</th>
        <th class="text-lg">Address</th>
        <th class="text-lg">Age</th>
        <th class="text-lg">Sex</th>
        <th class="text-lg">Status</th>
        <th class="text-center text-lg">Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- row 1 -->
     @forelse ($users as $user)
     <tr>
      <td class="max-lg:min-w-[230px]">{{$user->firstname}} {{$user->middlename}} {{$user->lastname}} {{$user->extensionname}}</td>
      <td>{{$user->phone_number}}</td>
      <td class="max-lg:min-w-[200px]">{{$user->address}}</td>
      <td>{{$user->age}}</td>
      <td>{{$user->sex}}</td>
      <td>{{$user->isPending}}</td>
      <td>
        <div class="flex items-center justify-center gap-2">
          <a href="{{route("admin.trackApproval", $user->id)}}" class="text-white rounded-md px-4 py-3 bg-green-500 hover:bg-green-600 text-center whitespace-nowrap">View</a>
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
  <div class="text-3xl font-bold  mb-4">No Approvals</div>
  <p class="text-xl mb-6">It looks like there are no pending approvals at the moment.</p>
</div>
@endif