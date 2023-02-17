@extends('layout.web')
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title">Search Filter</h5>
                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                    <div class="col-md-4 user_role"></div>
                    <div class="col-md-4 user_plan"></div>
                    <div class="col-md-4 user_status"></div>
                </div>
            </div>
            <div id="result_container">
                @include('common.paginate')
            </div>

            <!-- Offcanvas to add new user -->
         </div>

        <!-- pricingModal -->
        <!--/ pricingModal -->

    </div>
    <!-- / Content -->

@endsection


