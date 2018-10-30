@include('includes.front_header')

<body>

    <!-- Navigation -->
    @include('includes.front_nav')

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                @yield('content')
                

                
                
               
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                @yield('sidebar')
            </div>
            {{-- @include('includes.front_sidebar') --}}

        </div>
        <!-- /.row -->

 @include('includes.front_footer')      
