@include('components/header')
 @include('components/aside')
  <main class="dashboard-main">
    @include('components/top')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Users</h6>
            </div>
        
            <div class="card h-100 p-0 radius-12">
              <div class="card-body p-24">
                  <div class="row justify-content-center">
                      <div class="col-xxl-6 col-xl-8 col-lg-10">
                          <div class="card border">
                              <div class="card-body">
                                  {{-- <h6 class="text-md text-primary-light mb-16">Profile Image</h6> --}}
  
                                  <!-- Upload Image Start -->
                                  {{-- <div class="mb-24 mt-16">
                                      <div class="avatar-upload">
                                          <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                              <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" hidden>
                                              <label for="imageUpload" class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                  <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                              </label>
                                          </div>
                                          <div class="avatar-preview">
                                              <div id="imagePreview"> </div>
                                          </div>
                                      </div>
                                  </div> --}}
                                  <!-- Upload Image End -->

                                  @if ($errors->any())
                                  @foreach ($errors->all() as $error)
                                      <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-100 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between mb-2" role="alert">
                                       {{ $error }}
                                       <button class="remove-button text-danger-600 text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                                   </div>
                                  @endforeach
                                  @endif
                                  
                                  <form action="{{ route('users-save') }}" method="POST">
                                    @csrf
                                      <div class="mb-20">
                                          <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">First Name <span class="text-danger-600">*</span></label>
                                          <input type="text" class="form-control radius-8" id="name" name="name" placeholder="Enter First Name">
                                      </div>
                                      <div class="mb-20">
                                        <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Last Name <span class="text-danger-600">*</span></label>
                                        <input type="text" class="form-control radius-8" id="lname" name="lname" placeholder="Enter Last Name">
                                      </div>
                                      <div class="mb-20">
                                          <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span class="text-danger-600">*</span></label>
                                          <input type="email" class="form-control radius-8" id="email" name="email" placeholder="Enter email address">
                                      </div>
                                      <div class="mb-20">
                                          <label for="number" class="form-label fw-semibold text-primary-light text-sm mb-8">Phone</label>
                                          <input type="text" class="form-control radius-8" id="number" name="mobile" maxlength="10"  placeholder="Enter phone number">
                                      </div>
                                      <div class="mb-20">
                                          <label for="role_id" class="form-label fw-semibold text-primary-light text-sm mb-8">Role <span class="text-danger-600">*</span> </label>
                                          <select class="form-control radius-8 form-select" id="role_id" name="role_id">
                                            <option name="*"> Please Select </option>
                                            @foreach($roles as $role)
                                              <option value="{{ $role->role_id }}"> {{ $role->name }} </option>
                                              @endforeach    
                                            </select>
                                      </div>

                                      <div class="mb-20">
                                        <label for="status" class="form-label fw-semibold text-primary-light text-sm mb-8">Status <span class="text-danger-600">*</span> </label>
                                        <select class="form-control radius-8 form-select" id="status" name="status">
                                            <option name="*"> Please Select </option>
                                            <option value="1">Active </option>
                                            <option value="0">Inactive </option>
                                        </select>
                                    </div>
                                     
                                    <div class="mb-20">
                                        <label for="number" class="form-label fw-semibold text-primary-light text-sm mb-8">Sample Password</label>
                                        <input type="text" class="form-control radius-8" id="password" name="password" placeholder="1298&ZYX" value="1298&ZYX" maxlength="8">
                                    </div>
                                  
                                      <div class="d-flex align-items-center justify-content-center gap-3">
                                          <button type="button" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8"> 
                                              Cancel
                                          </button>
                                          <button type="submit" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8"> 
                                              Save
                                          </button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

   


        </div>
        @include('components/bottom')

  </main>

@include('components/footer')