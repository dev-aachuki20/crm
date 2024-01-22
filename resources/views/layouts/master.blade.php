@include('layouts.includes.headerlinks')

<body>
    <main class="main-screen">
        <!-- HEADER START -->
        @include('layouts.includes.header')
        <!-- HEADER END -->

        <!-- MAIN BLOCK START -->
        <section class="mainwraaper-sec d-flex justify-content-end align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="search-identify">
                            <div class="logo text-center"><img src="{{ asset('images/gestiona.svg') }}"
                                    class="img-fluid" /></div>
                            <form>
                                <div class="inputWrapper position-relative">
                                    <input id="search" type="search" name="" class="form-control"
                                        placeholder="Search by identification" />
                                    <button type="button" class="search"><img src="{{ asset('images/search.svg') }}"
                                            class="img-fluid" /></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- MAIN BLOCK END -->


        <!-- FOOTER START -->
        @include('layouts.includes.footer')
        <!-- FOOTER END -->
    </main>

    @include('layouts.includes.footerlinks')
</body>

</html>
