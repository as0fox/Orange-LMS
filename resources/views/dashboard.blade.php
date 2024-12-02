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
                    <div class="container">
                        <div class="d-flex justify-content-between align-items-center my-5">
                            <!—flex-direction view with Margin 5-->
                            <div class="h2">All Todos</div>
                            <a href="{{route("todo.create")}}" class="btn btn-primary btn-lg">Add Todo</a>
                        </div>
                        <!-- {{print_r($todos)}} -->
                        <table class="table table-stripped table-dark">
                            <tr>
                                <th>Task Name</th>
                                <th>Description</th>
                                <th>Due date</th>

                            </tr>
                            @foreach($todos as $todo)
                                <tr valign="middle">
                                    <td>{{$todo->name}}</td>
                                    <td>{{$todo->work}}</td>
                                    <td>{{$todo->duedate}}</td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
