@extends('layout.web')
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title">Importer Settings</h5>

               {{$importer->maps}}
                       </div>
            <div id="settings_container">
                <form class="card-body" method="post" action="{{route('importer.settings.store', request()->route('id'))}}">
                    <h6 class="mb-b fw-semibold"Importer Field Map</h6>
                    @csrf
                    @foreach($importerHeader  as $header)
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="{{strtolower($header)}}">{{$header}}</label>
                        <div class="col-sm-9">

                            <select  id="{{strtolower($header)}}" name="{{$header}}" class="select2 form-select" data-allow-clear="true">
                                <option value="">Select an Option</option>
                                @foreach($productImportHeader as $importHeader)
                                <option value="{{$importHeader}}"
                                    @php
                                        if (isset(json_decode($importer->maps)->{$header}) && json_decode($importer->maps)->{$header} == $importHeader) { echo 'selected'; }
                                        elseif ($header == $importHeader) { echo 'selected'; }
                                     @endphp
                                >{{ucwords($importHeader)}}</option>
                                @endforeach
                           </select>
                           </div>
                    </div>
                        @endforeach
                    <div class="pt-4">
                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary me-sm-2 me-1">Submit</button>
                                <a data-ajax="1" href="{{route('importer.run.import', request()->route('id'))}}"  class="btn btn-success ">Start Importing</a>
                                <a  href="{{route('importer.view.products', request()->route('id'))}}"  class="btn btn-info ">View Products</a>
                                <a  data-ajax="1"  data-confirm="1" href="{{route('importer.delete.products', request()->route('id'))}}"  class="btn btn-danger delete_products">Delete Products</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Offcanvas to add new user -->
        </div>

        <!-- pricingModal -->
        <!--/ pricingModal -->

    </div>
    <!-- / Content -->

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });

    </script>
@endpush
