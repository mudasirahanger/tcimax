@include('components/header')
 @include('components/aside')
  <main class="dashboard-main">
    @include('components/top')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Users</h6>
            </div>
            {{-- @if($success)
            {{ $success }}
            @endif --}}
            <div class="card h-100 p-0 radius-12">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
                    <div class="d-flex align-items-center flex-wrap gap-3">
                        {{-- <span class="text-md fw-medium text-secondary-light mb-0">Show</span>
                        <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                        </select>
                        <form class="navbar-search">
                            <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Search">
                            <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                        </form>
                        <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                            <option>Status</option>
                            <option>Active</option>
                            <option>Inactive</option>
                        </select> --}}
                    </div>
                    <a href="{{ route('users-add') }}" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2"> 
                        <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
                        Add New User
                    </a>
                </div>
                <div class="card-body p-24">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table sm-table mb-0">
                          <thead>
                            <tr>
                              <th scope="col">
                                <div class="d-flex align-items-center gap-10">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border input-form-dark" type="checkbox" name="checkbox" id="selectAll">
                                    </div>
                                    S.L
                                </div>
                              </th>
                              <th scope="col">Join Date</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Role</th>
                              <th scope="col" class="text-center">Status</th>
                              <th scope="col" class="text-center">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if($users)
                            @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-10">
                                        <div class="form-check style-check d-flex align-items-center">
                                            <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox" id="SL">
                                        </div>
                                        {{ $user['sr'] }}
                                    </div>
                                </td>
                                <td>{{ $user['created_at'] }}</td>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="flex-grow-1">
                                    <span class="text-md mb-0 fw-normal text-secondary-light">{{ $user['name'] }}</span>
                                  </div>
                                </div>
                              </td>
                              <td><span class="text-md mb-0 fw-normal text-secondary-light">{{ $user['email'] }}</span></td>
                              <td>{{ $user['role'] }}</td>
                              <td class="text-center">
                                @if($user['status'])
                                <span class="bg-success-focus text-success-600 border border-success-main px-24 py-4 radius-4 fw-medium text-sm">Active</span>                                     
                                @else
                                <span class="bg-danger-focus text-danger-600 border border-danger-main px-24 py-4 radius-4 fw-medium text-sm">Inactive</span>                                     
                                @endif
                             </td>
                              <td class="text-center"> 
                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                    <button type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"> 
                                        <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                                    </button>
                                </div>
                              </td>
                            </tr>
                            @endforeach
                            @endif
                 
                              
                          </tbody>
                        </table>
                    </div>
    
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
                    {!! $paginations !!}
                    </div>
                </div>
            </div>


        </div>
        @include('components/bottom')
  </main>
@include('components/footer')