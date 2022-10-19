@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Input Data</div>
                <div class="card-body">
                    <form id="add_edit_user">
                        @csrf
                        @if(session("success"))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        <input type="hidden" name="id" id="id" value="">
                        
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-3 text-end">
                                    <label for="email" class="form-label">Email</label>
                                </div>
                                <div class="col-6">
                                    <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" required>
                                </div>
                                <div class="col-3 text-end">
                                    @error('email')
                                        <div class=" text-center">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-3 text-end">
                                    <label for="username" class="form-label ">Username</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="username" id="username" value="{{old('username')}}" required>
                                </div>
                                <div class="col-3 text-end">
                                    @error('username')
                                        <div class=" text-center">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-3 text-end">
                                    <label for="password" class="form-label ">Password</label>
                                </div>
                                <div class="col-6">
                                    <input type="password" class="form-control" name="password" id="password" value="">
                                </div>
                                <div class="col-3 text-end">
                                    @error('password')
                                        <div class=" text-center">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-3 text-end">
                                    <label for="confirm_password" class="form-label ">Confirm Password</label>
                                </div>
                                <div class="col-6">
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" value="">
                                </div>
                                <div class="col-3 text-end">
                                    @error('confirm_password')
                                        <div class=" text-center">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-3 text-end">
                                    <label for="name" class="form-label ">Name</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" required>
                                </div>
                                <div class="col-3 text-end">
                                    @error('name')
                                        <div class=" text-center">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-3 text-end">
                                    <label for="surname" class="form-label ">Surname</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="surname" id="surname" value="{{old('surname')}}" required>
                                </div>
                                <div class="col-3 text-end">
                                    @error('surname')
                                        <div class=" text-center">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary ">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Result</div>
                    <div class="card-body">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Create At</th>
                                    <th scope="col">Update At</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="showdata">
                                @php($i = 1)
                                @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$i}}</th>
                                    <td>{{$user->name}} {{$user->surname}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_date}}</td>
                                    <td>{{$user->update_date}}</td>
                                    <th><a style="cursor:pointer;" class="text-primary edit_user" data-id="{{$user->id}}">Edit</a></th>
                                    <th><a onclick="return confirm('Are you sure you want to delete this item?');" href="{{url('user/softdelete/'.$user->id)}}" class="text-danger delete_user">Delete</a></th>
                                </tr>
                                @php($i++)
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var selection = document.querySelector('.alert') !== null;
    if (selection) {
        var alertList = document.querySelectorAll('.alert')
        var alerts =  [].slice.call(alertList).map(function (element) {
            return new bootstrap.Alert(element)
        })
        setTimeout(function() {  
            var alertNode = document.querySelector('.alert')
            var alert = bootstrap.Alert.getInstance(alertNode)
            alert.close()
        }, 1000);
    }

    function fetchdata()
    {

    }

    document.querySelector('#add_edit_user').addEventListener('submit', (event) => {
        event.preventDefault();
        const id =  document.getElementById("id").value;
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const username = document.getElementById("username").value;
        const surname = document.getElementById("surname").value;
        const password = document.getElementById("password").value;
        const confirm_password = document.getElementById("confirm_password").value;

        let formdata = new FormData();
        formdata.append('id', id);
        formdata.append('name', name);
        formdata.append('email', email);
        formdata.append('username', username);
        formdata.append('surname', surname);


        if(name=="")
        {
            alert("Name Must Be Fill");
            return false;
        }
        if(email=="")
        {
            alert("Email Must Be Fill");
            return false;
        }
        if(username=="")
        {
            alert("Username Must Be Fill");
            return false;
        }
        if(surname=="")
        {
            alert("Surname Must Be Fill");
            return false;
        }

        if(id=="")
        {
            if(password=="")
            {
                alert("Password Must Be Fill");
                return false;
            }

            if(confirm_password=="")
            {
                alert("Confirm Password Must Be Fill");
                return false;
            }

            if(password!=confirm_password)
            {
                alert("Please Check Password And Confirm Password");
                return false;
            }
            
            formdata.append('password', password);

            let url = 'api/user';
            fetch(url, {
                method: "POST",
                body: formdata,
                mode: 'no-cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                redirect: 'follow', // manual, *follow, error
                referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            })
            .then(response => response.json()) 
            .then(data => {

            });
        }
        else
        {
            if(password!=confirm_password)
            {
                alert("Please Check Password And Confirm Password");
                return false;
            }

            if(password!="")
            {
                formdata.append('password', password);
            }

            let url = 'api/user/'+id;
            fetch(url, {
                method: "PUT",
                body: formdata,
                mode: 'no-cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                redirect: 'follow', // manual, *follow, error
                referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            })
            .then(response => response.json()) 
            .then(data => {

            });
        }



        return false;
    });

    document.querySelectorAll('.edit_user').forEach((li) => {
    li.addEventListener('click', (event) => {
        const thisid = li.getAttribute("data-id");

        let url = 'api/user/'+thisid;
        fetch(url, {
            method: "GET",
            mode: 'no-cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
              },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        })
        .then(response => response.json()) 
        .then(data => {
            (console.log(data));
            document.getElementById("id").value = data.enc_id;
            document.getElementById("name").value = data.name;
            document.getElementById("email").value = data.email;
            document.getElementById("username").value = data.username;
            document.getElementById("surname").value = data.surname;
        });
    });
});
</script>
@endsection