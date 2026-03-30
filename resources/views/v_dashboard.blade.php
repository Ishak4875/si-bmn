@extends('layout.v_layout')
@section('content')
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <!--begin::Col-->
        <div class="col-lg-12 col-6">
            <!--begin::Small Box Widget 1-->
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{$jumlah_paket}}</h3>

                    <p>Paket Pekerjaan</p>
                </div>
                <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path class="cls-3" d="M62,11H40a1,1,0,0,0-1,1v4a1,1,0,0,0,1,1H62a1,1,0,0,0,1-1V12A1,1,0,0,0,62,11Zm-8,2v2H49V13ZM41,13h6v2H41Zm20,2H56V13h5Z" />
                </svg>
                <!-- <a
                    href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a> -->
            </div>
            <!--end::Small Box Widget 1-->
        </div>
        <!--end::Col-->


        <!--end::Col-->
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <!-- /.row (main row) -->
</div>

@endsection