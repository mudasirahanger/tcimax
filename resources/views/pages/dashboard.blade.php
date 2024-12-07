@include('components/top')

<div class="dashboard-main-body">
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Dashboard</h6>
  </div>

  <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">
   
    <div class="col">
      <div class="card shadow-none border bg-gradient-start-2 h-100">
        <div class="card-body p-20">
          <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
              <p class="fw-medium text-primary-light mb-1">Sales Achieved</p>
              <h6 class="mb-0">1376</h6>
            </div>
            <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
              <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
            </div>
          </div>
          <!-- <p class="fw-medium text-sm text-primary-light mt-12 mb-0">
              <span class="text-danger-main"><iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon> -800</span> 
              Last 30 days subscription
            </p> -->
        </div>
      </div><!-- card end -->
    </div>
    
    <div class="col">
      <div class="card shadow-none border bg-gradient-start-4 h-100">
        <div class="card-body p-20">
          <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
              <p class="fw-medium text-primary-light mb-1">Sales Pending</p>
              <h6 class="mb-0">42,500</h6>
            </div>
            <div class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
              <iconify-icon icon="solar:wallet-bold" class="text-white text-2xl mb-0"></iconify-icon>
            </div>
          </div>
          <!-- <p class="fw-medium text-sm text-primary-light mt-12 mb-0">
              <span class="text-success-main"><iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +$20,000</span> 
              Last 30 days income
            </p> -->
        </div>
      </div><!-- card end -->
    </div>
    <div class="col">
      <div class="card shadow-none border bg-gradient-start-5 h-100">
        <!-- <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
              <div>
                <p class="fw-medium text-primary-light mb-1">Total Expense</p>
                <h6 class="mb-0">$30,000</h6>
              </div>
              <div class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                <iconify-icon icon="fa6-solid:file-invoice-dollar" class="text-white text-2xl mb-0"></iconify-icon>
              </div>
            </div>
            <p class="fw-medium text-sm text-primary-light mt-12 mb-0">
              <span class="text-success-main"><iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +$5,000</span> 
              Last 30 days expense
            </p>
          </div> -->
      </div><!-- card end -->
    </div>
  </div>

  <div class="row gy-4 mt-1">
    <div class="col-xxl-12 col-xl-12">
      <div class="card h-100">
        <div class="card-body">
          <div class="d-flex flex-wrap align-items-center justify-content-between">
            <h6 class="text-lg mb-0">Stock Statistic</h6>
            <select class="form-select bg-base form-select-sm w-auto">
              <option>Yearly</option>
              <option>Monthly</option>
              <option>Weekly</option>
              <option>Today</option>
            </select>
          </div>
          <div class="d-flex flex-wrap align-items-center gap-2 mt-8">
            <h6 class="mb-0">27,200</h6>
            <span class="text-sm fw-semibold rounded-pill bg-success-focus text-success-main border br-success px-8 py-4 line-height-1">
              10% <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon>
            </span>
            <span class="text-xs fw-medium">+ 1500 Pcs Per Day</span>
          </div>
          <div id="chart" class="pt-28 apexcharts-tooltip-style-1"></div>
        </div>
      </div>
    </div>




  </div>
</div>


@include('components/bottom')