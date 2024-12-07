<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
      <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
      <a href="index.html" class="sidebar-logo">
        <img src="{{ asset('public/assets/images/logo.png') }}" alt="site logo" class="light-logo">
        <img src="{{ asset('public/assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
        <img src="{{ asset('public/assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
      </a>
    </div>
    <div class="sidebar-menu-area">
      <ul class="sidebar-menu" id="sidebar-menu">
        <li>
          <a href="{{ route('dashboard') }}">
            <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="sidebar-menu-group-title">Company CRM/MIS</li>
      
        <li>
          <a href="/add">
            <iconify-icon icon="carbon:add-filled" class="menu-icon"></iconify-icon>
            <span>Add Distributor</span>
          </a>
        </li>
        <li>
          <a href="/addr">
            <iconify-icon icon="carbon:add-filled" class="menu-icon"></iconify-icon>
            <span>Add Retailer</span> 
          </a>
        </li>
        <li>
          <a href="/amst">
            <iconify-icon icon="carbon:add-filled" class="menu-icon"></iconify-icon>
            <span>Add Monthly Sale Targets</span> 
          </a>
        </li>

        <li>
          <a href="?page=list_stock">
            <iconify-icon icon="line-md:list" class="menu-icon"></iconify-icon>
            <span>Retailer List</span> 
          </a>
        </li>

        <li>
          <a href="?page=list_stock">
            <iconify-icon icon="line-md:list" class="menu-icon"></iconify-icon>
            <span>Company Associated Retailers list</span> 
          </a>
        </li>

        <li>
          <a href="?page=list_stock">
            <iconify-icon icon="line-md:list" class="menu-icon"></iconify-icon>
            <span>Sale Approvales</span> 
          </a>
        </li>

        <li>
          <a href="?page=list_stock">
            <iconify-icon icon="line-md:list" class="menu-icon"></iconify-icon>
            <span>Total Dealers List</span> 
          </a>
        </li>

        <li>
          <a href="?page=list_stock">
            <iconify-icon icon="line-md:list" class="menu-icon"></iconify-icon>
            <span>District Wise List</span> 
          </a>
        </li>

        <li>
          <a href="?page=list_stock">
            <iconify-icon icon="line-md:list" class="menu-icon"></iconify-icon>
            <span>Schemes List</span> 
          </a>
        </li>
       
        </li>
  
     
     
        <li class="sidebar-menu-group-title">User Management</li>
        <li class="dropdown">
          <a href="javascript:void(0)">
            <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
            <span>Managers</span> 
          </a>
          <ul class="sidebar-submenu">
          <li>
              <a href="javascript:void(0)"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add User</a>
            </li>
            <li>
              <a href="javascript:void(0)"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Users List</a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)">
            <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
            <span>Distributors</span> 
          </a>
          <ul class="sidebar-submenu">
          <li>
              <a href="javascript:void(0)"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add User</a>
            </li>
            <li>
              <a href="javascript:void(0)"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Users List</a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)">
            <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
            <span>Retailers</span> 
          </a>
          <ul class="sidebar-submenu">
            <li>
              <a href="javascript:void(0)"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add User</a>
            </li>
            <li>
              <a href="javascript:void(0)"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Users List</a>
            </li>
          </ul>
        </li>
  
        <li class="sidebar-menu-group-title">App Management</li>
        <li class="">
          <a href="javascript:void(0)">
            <iconify-icon icon="icon-park-outline:setting-two" class="menu-icon"></iconify-icon>
            <span>Settings</span> 
          </a>
          <!-- <ul class="sidebar-submenu">
            <li>
              <a href=""><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Company</a>
            </li>
            <li>
              <a href="notification.html"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Notification</a>
            </li>
            <li>
              <a href="notification-alert.html"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Notification Alert</a>
            </li>
            <li>
              <a href="theme.html"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Theme</a>
            </li>
            <li>
              <a href="currencies.html"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Currencies</a>
            </li>
            <li>
              <a href="language.html"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Languages</a>
            </li>
            <li>
              <a href="payment-gateway.html"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Payment Gateway</a>
            </li>
          </ul> -->
        </li>
      </ul>
    </div>
  </aside>