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
    @include('components/menu')
  </aside>