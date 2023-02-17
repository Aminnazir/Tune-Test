@extends('layout.web')
@section('content')
    @if(!$ajax)
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">

                <div class="card-body">
                    @endif


                    <div class="text-center">
                        @if(request()->title)
                            <h3 class="mb-2">{{request()->title}}</h3>
                        @endif
                        <p></p>
                    </div>
                    <div class="response"></div>
                    <div>
                        {{$importer}}
                    </div>

                    @if(!$ajax)
                </div>
            </div>
        </div>

    @endif

    @if($ajax)
        <script>

        </script>
    @endif
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush

