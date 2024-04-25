<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
                    {{-- <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ( $users as $user )                                
                          <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->updated_at}}</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                      {{$users->links()}} --}}
                  {{-- <table class="table table-bordered hover stripe" id="usersData">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                      </tr>
                    </thead>
                  </table> --}}
                  {{ $dataTable->table() }}
          </div>
        </div>
      </div>
    </div>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    {{-- <script>
      $(document).ready( function () {
       $('#usersData').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ url('dashboard') }}",
              columns: [
                       { data: 'id', name: 'id' },
                       { data: 'name', name: 'name' },
                       { data: 'email', name: 'email' },
                       { data: 'created_at', name: 'created_at' }
                    ],
              buttons: [
                      {
                        extend: 'excel', // Use HTML5 export method
                        filename: 'user_data', // Custom file name
                        action: function () {
                          window.location.href = "{{ route('users.excel') }}"; // Redirect to the named route
                        }
                      },
                      {
                        extend: 'csv', // Use HTML5 export method
                        action: function () {
                          window.location.href = "{{ route('users.csv') }}";
                        }
                      },
                      {
                        extend: 'pdf', // Use HTML5 export method
                        action: function () {
                          window.location.href = "{{ route('users.pdf') }}";
                        }
                      },
                      {
                        extend: 'print', // Use HTML5 export method
                        // action: function () {
                        //   // window.location.href = "{{ route('users.excel') }}";
                        // },
                        customize: function(){
                          $(window.document.body).addClass('white-bg');
                          $(window.document.body).css('font-size', '10px');

                          $(window.document.body).find('table')
                          .addClass('compact')
                          .css('font-size', 'inherit');

                        }
                      }
                    ]
           });
        });
    </script> --}}
</x-app-layout>
