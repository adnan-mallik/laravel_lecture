<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="card mt-3">
            <div class="card-header">
                <h3>Register</h3> 
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif --}}
                {{-- <div class="alert alert-success d-none" id="success"></div> --}}
                {{-- @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif --}}
                {{-- <form action="{{ route('user.register') }}" method="post"> --}}
                <form id="student_data">
                    {{-- @csrf --}}
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name') }}" />
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name') }}" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" value="{{ old('email') }}">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="check_out" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    {{-- <button type="submit" class="btn btn-primary">Register</button> --}}
                    <button type="button" class="btn btn-primary" id="student_register_btn">Register</button>
                </form>
            </div>
        </div>
    </div>

    <script>

        let student_register_btn = document.getElementById('student_register_btn');

        student_register_btn.addEventListener('click', function(){
            
            let csrfToken = "{{ csrf_token() }}";

            var data = new FormData();
            data.append('first_name', document.getElementById('first_name').value);
            data.append('last_name', document.getElementById('last_name').value);
            data.append('email', document.getElementById('email').value);
            data.append('password', document.getElementById('password').value);

            console.log(data);
            let xhttp = new XMLHttpRequest();

            xhttp.onload = function(response) {

                let res = JSON.parse(xhttp.responseText);

                // if(response.status == 'success'){
                //     let success = document.getElementById('success');
                //     success.innerText = JSON.parse(xhttp.responseText).message;
                // }

                const newNode = document.createElement("div")
                let html_message = '';
                if(res.status == 'success'){
                    html_message = `<div class="alert alert-success" id="success">${res.message}</div>`;
                }else{
                    html_message = `<div class="alert alert-danger" id="success">${res.message}</div>`;
                }


                let parser = new DOMParser();
                let doc = parser.parseFromString(html_message, 'text/html');
                let node = doc.body.firstChild;

                console.log(node); // This will log the newly created DOM node

                let parent_element = document.getElementsByClassName('card-body')[0]
                parent_element.insertBefore(node, parent_element.firstChild);
        
                // setTimeout(() => {
                //     success.classList.add('d-none')
                // }, 2000);
            }

            xhttp.open("post", "{{ route('user.register') }}")
            xhttp.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            xhttp.send(data);

        });




    </script>
</body>
</html>