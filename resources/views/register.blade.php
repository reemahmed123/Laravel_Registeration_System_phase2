@extends('layouts.master')

@section('title', 'Registeration Form')

@section('content')
<!DOCTYPE html>
<html lang="en">

<body class="bg-light">

    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class=" border-light shadow shadow-md rounded-3">
                <div class="row g-0">
                    <div class="col-12 col-md-5">
                        <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy"
                            src="{{ asset('images/penguin.jpg') }}"
                            alt="register Logo">
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <h2 class="h2 text-dark pb-2">Registration Form</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-3 gy-md-4 overflow-hidden">
                                <div class="col-md-11">
                                    @if (session('success'))
                                        <div class="alert alert-success" id="successMessage">{{ session('success') }}</div>
                                    @else
                                    <form id="registrationForm" class="ps-3 p-4 bg-white" action="{{ route('register.store') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="full_name" value="{{ old('full_name') }}" id="fullName"
                                                placeholder="fullName" required>
                                            <label for="fullName">Full Name</label>
                                            <div id="fullNameAlert" class="alert alert-danger d-none mt-2 p-2"></div>

                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" id="userName"
                                                placeholder="username" required>
                                            <label for="username">Username</label>
                                            <div id="usernameAlert" class="alert alert-danger d-none mt-2 p-2"></div>
                                            <div id="usernameAlertS" class="alert alert-success d-none mt-2 p-2"></div>

                                        </div>
                                        <span id="username_status"></span> <!-- Message area -->
                                        <div class="form-floating mb-3">
                                            <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}" id="phone"
                                                placeholder="Phone (9 to 11) digits " required>
                                            <label for="phone">Phone</label>
                                            <div id="phoneAlert" class="alert alert-danger d-none mt-2 p-2"></div>
                                        </div>

                                        <div class="d-flex">
                                            <select name="countryPrefix" value="{{ old('countryPrefix') }}"
                                                class="form-select w-auto rounded-end-0 phone-prefix"
                                                id="countryPrefix">
                                                <option value="20" selected>+20</option>
                                                <option value="966">+966</option>
                                                <option value="1">+1</option>
                                                <option value="44">+44</option>
                                                <option value="49">+49</option>
                                                <option value="33">+33</option>
                                                <option value="34">+34</option>
                                                <option value="39">+39</option>
                                                <option value="91">+91</option>
                                                <option value="81">+81</option>
                                                <option value="86">+86</option>
                                                <option value="7">+7</option>
                                                <option value="82">+82</option>
                                                <option value="62">+62</option>
                                                <option value="55">+55</option>
                                                <option value="52">+52</option>
                                                <option value="234">+234</option>
                                                <option value="27">+27</option>
                                                <option value="971">+971</option>
                                                <option value="90">+90</option>
                                            </select>
                                            <div class="form-floating mb-3 d-flex">
                                                <input type="tel" class="form-control rounded-end-0 rounded-start-0"
                                                    name="whatsapp" value="{{ old('whatsapp') }}" id="whatsappNumber" placeholder="whatsappNumber"
                                                    required>
                                                <label for="whatsappNumber">WhatsApp</label>
                                                <button type="button"
                                                    class="btn btn-outline-dark rounded-start-0 p-0 px-1"
                                                    id="checkWhatsappNumberBtn">Check</button>
                                            </div>
                                        </div>
                                        <p id="whatsappMsg" class="text-success"></p>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="address"value="{{ old('address') }}" id="address"
                                                placeholder="address" required>
                                            <label for="address">Address</label>
                                            <div id="addressAlert" class="alert alert-danger d-none mt-2 p-2"></div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email"
                                                placeholder="email" required>
                                            <label for="email">Email</label>
                                            <div id="emailAlert" class="alert alert-danger d-none mt-2 p-2"></div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="password" value="{{ old('password') }}" id="password"
                                                placeholder="password" required>
                                            <label for="password">Password</label>
                                        </div>
                                        <div id="passwordAlert" class="alert alert-danger d-none mt-2"></div>

                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}"
                                                id="confirmPassword" placeholder="Confirm Password" required>
                                            <label for="confirmPassword">Confirm Password</label>
                                            <div id="confirmPasswordAlert" class="alert alert-danger d-none mt-2"></div>
                                        </div>
                                        <div id="confirmPasswordAlert" class="alert alert-danger d-none mt-2"></div>

                                        <div class="mb-3 d-flex align-items-center w-auto">
                                            <input type="checkbox" id="viewPassword" style="width: 20px; height: 20px">
                                            <label for="viewPassword" class="ps-2">View Password</label>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Upload Image</label>
                                            <input type="file" class="form-control" name="user_image"  id="fileInput"
                                                required>
                                        </div>


                                        <button type="submit" class="btn btn-primary w-100 py-2"
                                            name="submit">Register</button>
                                    </form>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger" id="errorMessage">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div id="errorMessage" class="alert alert-danger d-none" role="alert">Please correct all errors before submitting.</div>
        
                                    <div id="successMessage" class="alert alert-success d-none " role="alert">Registration successful! Welcome aboard.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <style>
        @media screen and (min-width: 700px) {
            .container {
                width: 80% !important;
            }
        }
    </style>
</body>

</html>
@endsection
