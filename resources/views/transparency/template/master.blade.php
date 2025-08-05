<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>@yield('title')</title>
    <!-- Google font-->
    @includeIf('manager.template.partials.meta')
    @includeIf('manager.template.partials.css')
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader"></div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-sidebar" id="pageWrapper">
      <!-- Page Header Start-->
      @includeIf('transparency.template.partials.header')
      <!-- Page Header Ends -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper horizontal-menu">
        <!-- Page Sidebar Start-->
        @includeIf('transparency.template.partials.sidebar_transparency')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid pt-4">
            {{-- <div class="page-header">
              <div class="row">

                <div class="col-sm-6">
                  <!-- Bookmark Start-->
                  <div class="bookmark">
                    <ul>
                        @yield('bookmark')
                    </ul>
                  </div>
                  <!-- Bookmark Ends-->
                </div>
              </div>
            </div>
          </div> --}}


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif



            @yield('content')

          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        {{--  <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 footer-copyright">
                <p class="mb-0"> </p>
              </div>
              <div class="col-md-6">
                <p class="pull-right mb-0"> </p>
              </div>
            </div>
          </div>
        </footer>  --}}
      </div>
    </div>
    <!-- latest jquery-->
    @includeIf('manager.template.partials.js')
  </body>
</html>

