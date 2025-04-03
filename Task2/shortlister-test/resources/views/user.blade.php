<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shortlister</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9ecef;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar styling */
        .navbar {
            background-color: #007bff;
        }

        .navbar-brand {
            font-weight: bold;
            color: #fff !important;
        }

        /* Card styling */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-bottom: none;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        /* Table styling */
        .table thead {
            background-color: #007bff;
            color: #fff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        /* Button styling */
        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Shortlister</a>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container">
        <div class="row g-4">
            {{-- Form Card --}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Add User</h5>
                    </div>
                    {{-- Card body with form --}}
                    <div class="card-body">
                        <form id="userForm" method="POST" action="{{ route('user.add') }}">
                            @csrf
                            {{-- Full name field --}}
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name"
                                    placeholder="John Doe" value="{{ old('full_name') }}">
                                @error('full_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Email field --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    placeholder="name@example.com" value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Phone number field --}}
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number"
                                    placeholder="e.g. +123456789" value="{{ old('phone_number') }}">
                                @error('phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Date of birth field --}}
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    max="{{ date('Y-m-d') }}" value="{{ old('date_of_birth') }}">
                                @error('date_of_birth')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Add User</button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Users Table Card --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Users</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            {{-- Table --}}
                            <table id="userTable" class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Age</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->full_name }}</td>
                                            <td>
                                                <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                            </td>
                                            <td>{{ $user->phone_number }}</td>
                                            <td>{{ $user->age }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No users found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id='pagination' class="card-footer bg-white">
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Toast messages --}}
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        {{-- Success toast message --}}
        <div id='successToast' name='successToast' class="toast align-items-center text-white bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>

        {{-- Error toast message --}}
        <div id='errorToast' class="toast align-items-center text-white bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>

        // Check for flash message and show toast after reload
$(document).ready(function() {
    var successMessage = "{{ session('success') }}";
    if (successMessage) {
        var toastSuccess = new bootstrap.Toast(document.getElementById('successToast'));
        toastSuccess.show();
    }

    var successMessage = "{{ session('error') }}";
    if (successMessage) {
        var toastSuccess = new bootstrap.Toast(document.getElementById('errorToast'));
        toastSuccess.show();
    }
});

        $(document).ready(function() {

            // Email regex validation
            function isValidEmail(email) {
                var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            //Validates full name field
            function validateFullName() {
                var fullName = $('#full_name').val().trim();
                $('#full_name').next('.error').remove();
                if (fullName === "") {
                    $('#full_name').after('<small class="error text-danger">Please enter your full name.</small>');
                    return false;
                }
                return true;
            }

            //Validates email
            function validateEmail() {
                var email = $('#email').val().trim();
                $('#email').next('.error').remove();
                if (email === "") {
                    $('#email').after('<small class="error text-danger">Please enter your email address.</small>');
                    return false;
                } else if (!isValidEmail(email)) {
                    $('#email').after(
                        '<small class="error text-danger">Please enter a valid email address.</small>');
                    return false;
                }
                return true;
            }

            //Validates phone number
            function validatePhoneNumber() {
                var phoneNumber = $('#phone_number').val().trim();
                $('#phone_number').next('.error').remove();
                var phoneRegex = /^\+[0-9]{10,15}$/;
                if (phoneNumber === "") {
                    $('#phone_number').after(
                        '<small class="error text-danger">Please enter your phone number.</small>');
                    return false;
                } else if (!phoneRegex.test(phoneNumber)) {
                    $('#phone_number').after(
                        '<small class="error text-danger">Phone number must be in the format +123456789. And it needs to containt 10-15 digits</small>'
                    );
                    return false;
                }
                return true;
            }

            // Validates date of birth
            function validateDateOfBirth() {
                var dob = $('#date_of_birth').val().trim();
                $('#date_of_birth').next('.error').remove();
                if (dob === "") {
                    $('#date_of_birth').after(
                        '<small class="error text-danger">Please select your date of birth.</small>');
                    return false;
                } else if (isNaN(Date.parse(dob))) {
                    $('#date_of_birth').after(
                        '<small class="error text-danger">Please enter a valid date.</small>');
                    return false;
                }
                return true;
            }

            // Attach blur event to each field so that it validates when user leaves the field
            $('#full_name').on('blur', validateFullName);
            $('#email').on('blur', validateEmail);
            $('#phone_number').on('blur', validatePhoneNumber);
            $('#date_of_birth').on('blur', validateDateOfBirth);

            // Form submission handler
            $('#userForm').on('submit', function(e) {
                e.preventDefault(); // Prevent immediate submission

                // Clear all previous errors
                $('.error').remove();

                // Validate all fields
                var validFullName = validateFullName();
                var validEmail = validateEmail();
                var validPhoneNumber = validatePhoneNumber();
                var validDob = validateDateOfBirth();

                if (!validFullName || !validEmail || !validPhoneNumber || !validDob) {
                    return false;
                }

                // Gather form data
                var formData = {
                    full_name: $('#full_name').val().trim(),
                    email: $('#email').val().trim(),
                    phone_number: $('#phone_number').val().trim(),
                    date_of_birth: $('#date_of_birth').val().trim(),
                    _token: $('input[name="_token"]').val()
                };

                // Submit the form data via AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log('User added successfully:');
                        $('#userForm')[0].reset();
                        location.reload();
                    },
                    error: function(xhr) {
                        // Handle server-side validation errors (HTTP 422)
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                $('#' + field).after(
                                    '<small class="error text-danger">' + messages
                                    .join(' ') + '</small>');
                            });
                        } else {
                            $('#userForm')[0].reset();
                            location.reload();
                            console.log('Error:', xhr.responseJSON);
                        }
                    }
                });
            });
        });
    </script>


</body>

</html>
