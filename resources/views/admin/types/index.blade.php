@extends('admin.dashboard')

@section('mainDash')
<div class="container types py-5">
    @include('admin.partials.validation_errors')
    @include('admin.partials.session_message')
    <div class="row row-cols-1 row-cols-md-2 flex-column align-items-center">
        <div class="col p-2">
            <form action="{{route('admin.types.store')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Full Stack" aria-label="Button" name="name" id="name">
                    <button class="btn btn-outline-secondary" type="submit">Add</button>
                </div>
            </form>
        </div>
        <div class="col">
            <div class="table-responsive-md">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Projects</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($types as $type)
                        <tr class="">
                            <td scope="row">{{$type->id}}</td>
                            <td>{{$type->name}}</td>
                            <td>{{$type->slug}}</td>
                            <td>
                                <span class="badge bg-dark">{{ $type->projects->count()}}</span>
                            </td>
                            <td>
                                <!-- Modal trigger button -->
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modal-{{$type->slug}}">
                                <i class="fa-solid fa-trash-can" style="color: #ff0000;"></i>
                                </button>
                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modal-{{$type->slug}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{$type->slug}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitle-{{$type->slug}}">Delete {{$type->title}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form action="{{route('admin.types.destroy', $type->slug)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="">
                            <td scope="row"> 👈 Add your first type </td>
                        </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>
</div>
</div>
@endsection