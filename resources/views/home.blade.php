@extends('layout.web')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

        <div class="button-group sort-by-button-group">
            <button class="btn btn-sm btn-primary shadow-sm  is-checked" data-sort-value="name,impressions,conversions,revenue" />Name</button>
            <button class="btn btn-sm btn-primary shadow-sm " data-sort-value="impressions,name,conversions,revenue" />Impressions</button>
            <button class="btn btn-sm btn-primary shadow-sm " data-sort-value="conversions,name,impressions,revenue" />Conversions</button>
            <button class="btn btn-sm btn-primary shadow-sm  " data-sort-value="revenue,name,impressions,conversions" />Revenue</button>
        </div>
     </div>

    <!-- Content Row -->
    <div class="row grid">

        <!-- User Card Example -->
        @foreach($users as $user)
            <div class="col-xl-4 col-md-6 mb-4 user-card grid-item" data-revenue="{{number_format($user->logs()->pluck('revenue')->sum(), 2)}}" data-conversions="{{$user->logs()->where('type', 'conversion')->pluck('type')->count()}}" data-impressions="{{$user->logs()->where('type', 'impression')->pluck('type')->count()}}">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="d-inline-flex">
                                    <div class="avatar">
                                        @if($user->avatar && File::exists($user->avatar))
                                            <img class="img-profile rounded-circle" src="{{$user->avatar}}">
                                        @else
                                            <span class="text-avatar">{{$user->name[0]}}</span>
                                        @endif
                                    </div>
                                    <div class="details">
                                        <div class="sort-name h5   font-weight-bold text-primary text-uppercase mb-1">
                                            {{$user->name}}</div>
                                        <div class="text-xs mb-0 font-weight-bold text-gray-800">{{$user->occupation}}</div>
                                    </div>
                                </div>
                                <div class="agg d-flex">
                                    <div class="chart">
                                        <div></div>
                                        <canvas  class="conversion-chart" id="conversion{{$user->id}}"></canvas>

                                      @push('custom-scripts')

                                            createChart('conversion{{$user->id}}', {!!$user->getChartData($user->id)->pluck('count')!!}, {!! $user->getChartData($user->id)->pluck('date') !!} )
                                        @endpush
                                    </div>
                                    <div class="states text-right">
                                        <p class="states-count sort-impressions">{{$user->logs()->where('type', 'impression')->pluck('type')->count()}}</p>
                                        <p class="states-title">Impressions </p>
                                        <p class="states-count sort-conversions">{{$user->logs()->where('type', 'conversion')->pluck('type')->count()}}</p>
                                        <p class="states-title">Conversions </p>
                                        <p class="states-count sort-revenue">${{number_format($user->logs()->pluck('revenue')->sum(), 2)}}</p>
                                        <p class="states-title">Revenue</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection

@push('custom-scripts')
    var qsRegex;
    // init Isotope
    var $grid = $('.grid').isotope({
    itemSelector: '.grid-item',
    layoutMode: 'fitRows',
    filter: function() {
    return qsRegex ? $(this).text().match( qsRegex ) : true;
    },

    getSortData: {
        impressions: '[data-impressions]',
        conversions: '[data-conversions]',
        revenue: '[data-revenue]',
    name: '.sort-name'
    },
    // sort by color then number
    sortBy: [ 'name', 'impressions', 'conversions', 'revenue']
    });

    // bind sort button click
    $('.sort-by-button-group').on( 'click', 'button', function() {
    var sortValue = $(this).attr('data-sort-value');
    if('name,impressions,conversions,revenue' == sortValue)
    {
    so = true
    }
    else
    {
    so = false
    }
    sortValue = sortValue.split(',');
    $grid.isotope({ sortBy: sortValue, sortAscending: so});
    });

    // change is-checked class on buttons
    $('.button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
    });
    });

    // use value of search field to filter
    var $quicksearch = $('.quicksearch').keyup( debounce( function() {
    qsRegex = new RegExp( $quicksearch.val(), 'gi' );
    $grid.isotope();
    }, 200 ) );

    // debounce so filtering doesn't happen every millisecond
    function debounce( fn, threshold ) {
    var timeout;
    threshold = threshold || 100;
    return function debounced() {
    clearTimeout( timeout );
    var args = arguments;
    var _this = this;
    function delayed() {
    fn.apply( _this, args );
    }
    timeout = setTimeout( delayed, threshold );
    };
    }


@endpush
