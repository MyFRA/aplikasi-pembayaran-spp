<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.partials.head')
@yield('stylesheet')
<body style="background: #ededed">
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

        <!-- Navbar -->
          @include('admin.layouts.partials.navbar')
        <!-- End of Navbar -->
        
        <!-- Sidebar -->
          @include('admin.layouts.partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
        <!-- End of Main Content -->

        <!-- Form -->
        <form method="POST" action="" id="form-delete">
          @csrf
          @method('DELETE')
        </form>

        <form method="POST" action="{{ url('/app-admin/logout') }}" id="admin-form-logout">
          @csrf
        </form>
        <!-- End of Form -->
        
        <!-- Footer -->
        @include('admin.layouts.partials.footer')
        <!-- End of Footer -->

        @section('script')
          @if(Session::get('failed'))
              <x-alert status="failed" :message="Session::get('failed')" />
          @endif

          @if(Session::get('success'))
              <x-alert status="success" :message="Session::get('success')" />
          @endif
        @endsection

        <!-- Page Specified Script -->
        @yield('script')
        <!-- End of Specified Script -->

    </div>
  </div>
</body>
</html>
