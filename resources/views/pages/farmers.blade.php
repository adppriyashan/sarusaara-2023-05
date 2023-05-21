@extends('layouts.app')

@section('content')
    @include('layouts.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('layouts.navbar')
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                @include('layouts.flash')
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 w-100" id="usersTable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Image</th>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NIC</th>
                                            <th
                                                class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($farmers as $farmer)
                                            <tr>
                                                <td class="text-xs text-secondary mb-0">
                                                    <img src="{{ $farmer->img }}" class="avatar avatar-sm me-3"
                                                        alt="user1">
                                                </td>
                                                <td class="text-xs text-secondary mb-0">{{ $farmer->name }}</td>
                                                <td class="text-center text-xs text-secondary mb-0">{{ $farmer->nic }}</td>
                                                <td class="text-xs text-secondary mb-0 text-left"><span
                                                        class="badge badge-sm bg-gradient-{{ (new App\Models\Colors())->getColor($farmer['status']) }}">{{ App\Models\Farmer::$status[$farmer['status']] }}</span>
                                                </td>
                                                <td class="text-xs text-secondary mb-0 text-end">
                                                    <i onclick="doEdit({{ $farmer->id }})"
                                                        class="fa-solid fa-pen-to-square mx-2 text-warning"></i>
                                                    <i onclick="doDelete({{ $farmer->id }})"
                                                        class="fa-solid fa-trash mx-2 text-danger"></i>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-xs text-danger">No Data Found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-end">
                                <div class="mt-4">
                                    {{ $farmers->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <form autocomplete="off" action="{{ route('admin.farmers.enroll') }}" enctype="multipart/form-data"
                        method="POST" id="enrollment_form">
                        @csrf
                        <input type="hidden" id="isnew" name="isnew"
                            value="{{ old('isnew') ? old('isnew') : '1' }}">
                        <input type="hidden" id="record" name="record"
                            value="{{ old('record') ? old('record') : '' }}">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Add/Edit Farmers</h5>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row mt-1">
                                                <div class="col-md-12 mt-1">
                                                    <label for="name"><small class="text-dark">
                                                            Name{!! required_mark() !!}</small></label>
                                                    <input value="{{ old('name') }}" type="text" name="name"
                                                        id="name" class="form-control">
                                                    @error('name')
                                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12">
                                                    <label for="nic"><small class="text-dark">
                                                            National Identity Card Number{!! required_mark() !!}</small></label>
                                                    <input value="{{ old('nic') }}" type="number" name="nic"
                                                        id="nic" class="form-control">
                                                    @error('nic')
                                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12">
                                                    <label for="address"><small class="text-dark">
                                                            Address</small></label>
                                                    <textarea class="form-control" name="address" id="address" cols="30" rows="5">{{ old('address') }}</textarea>
                                                    @error('address')
                                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12">
                                                    <label for="notes"><small class="text-dark">
                                                            Special Notes</small></label>
                                                    <textarea class="form-control" name="notes" id="notes" cols="30" rows="5">{{ old('notes') }}</textarea>
                                                    @error('notes')
                                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12">
                                                    <label for="image"><small class="text-dark">
                                                            User's Image</small></label>
                                                            <br>
                                                    <label for="image">
                                                        <img id="imageview"
                                                            src="{{ asset('assets/img/uploads/default.png') }}"
                                                            alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                                                    </label>
                                                    <input type="file" name="image" id="image" class="d-none">
                                                    @error('price')
                                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-md-12">
                                                    <label for="status"><small class="text-dark">
                                                            Status</small></label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="1">Active</option>
                                                        <option value="2">Inactive</option>
                                                    </select>
                                                    @error('status')
                                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <hr class="my-2">
                                            <div class="row">
                                                <div class="col-md-6"> <input id="submitbtn"
                                                        class="btn text-white bg-success w-100" type="submit"
                                                        value="Submit">
                                                </div>
                                                <div class="col-md-6 mt-md-0 mt-1"><input
                                                        class="btn bg-gradient-danger w-100" type="button"
                                                        form="enrollment_form" id="resetbtn" value="Reset">
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @include('layouts.footer2')
        </div>
    </main>

    <script>
        function doEdit(id) {
            showAlert('Are you sure to edit this record ?', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.farmers.get.one') }}",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $('#name').val(response.name);
                        $('#address').val(response.address);
                        $('#nic').val(response.nic);
                        $('#notes').val(response.notes);
                        $('#imageview').attr('src', response.img);
                        $('#isnew').val('2').trigger('change');
                        $('#record').val(response.id);
                        $('#status').val(response.status);
                    }
                });
            });
        }

        function doDelete(id) {
            showAlert('Are you sure to delete this record ?', function() {
                window.location = "{{ route('admin.farmers.delete.one') }}?id=" + id;
            });
        }

        @if (old('record'))
            $('#record').val({{ old('record') }});
        @endif

        @if (old('isnew'))
            $('#isnew').val({{ old('isnew') }}).trigger('change');
        @endif
    </script>
@endsection
