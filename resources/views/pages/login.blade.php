<section class="auth bg-base d-flex flex-wrap">  
    <div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
            <img src="{{ asset('public/assets/images/logo.png') }}" alt="">
        </div>
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            <div>
                @if ($errors->any())
                       @foreach ($errors->all() as $error)
                           <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between mb-2" role="alert">
                            {{ $error }}
                            <button class="remove-button text-danger-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                        </div>
                       @endforeach
                @endif
                <h4 class="mb-12">Login</h4>
                <p class="mb-12 text-secondary-light text-lg">Management Information System (MIS)</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="icon-field mb-16">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                    <input type="email" name="email" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Email">
                </div>
                <div class="position-relative mb-20">
                    <div class="icon-field">
                        <span class="icon top-50 translate-middle-y">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span> 
                        <input type="password" name="password" class="form-control h-56-px bg-neutral-50 radius-12" id="your-password" placeholder="Password">
                    </div>
                    <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                </div>
                <div class="">
                    <!-- <div class="d-flex justify-content-between gap-2">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input border border-neutral-300" type="checkbox" value="" id="remeber">
                            <label class="form-check-label" for="remeber">Remember me </label>
                        </div>
                         <a href="javascript:void(0)" class="text-primary-600 fw-medium">Forgot Password?</a> 
                    </div> -->
                </div>

                 <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Sign In</button> 

               {{--<a href="?page=dashboard" class="btn btn-danger text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">Sign in as Manager</a>
                <a href="?page=dashboard1" class="btn btn-info text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">Sign in as Distributor</a>
               <a href="?page=dashboard2" class="btn btn-success text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">Sign in as Retailer</a> --}}
             
               <a href="{{ route('register') }}" class="btn text-sm btn-link px-12 py-16 w-100 radius-12 mt-32">Click to Register</a>
            </form>
            <p class="mt-20 text-secondary-light text-sm text-center">{{ env('APP_NAME') }} {{ env('APP_VER') }}</p>
        </div>
    </div>
</section>