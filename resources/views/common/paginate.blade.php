

<div class="card-datatable">
    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
        <div class="row mx-2">

            <div class="col-md-2">
                <div class="me-3">
                    <div class="dataTables_length" id="DataTables_Table_0_length">
                        <label>
                            <select class="form-select">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                        <label>
                            <input type="search" class="form-control" placeholder="Search.." aria-controls="DataTables_Table_0"></label>
                    </div>
                    <div class="dt-buttons">
                        @if($pagination->actions)
                            {!! add_button($pagination->actions) !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <table class="table table-striped table-bordered">
                <tr>
                    @foreach( $pagination->column as $column)
                        <th>{{$column->title}}</th>
                    @endforeach
                </tr>
                @foreach($data as $row)
                    <tr>
                        @foreach( $pagination->column as $column)
                            <td>
                                @if($column->data == 'action')
                                    <div class="demo-inline-spacing">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                            <ul class="dropdown-menu dropdown-menu-end">

                                                @foreach($pagination->actions as $action)
                                                    @if($action->type == 'delete')
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        <li>
                                                            <form method="post" action="{{route($action->route, $row->id )}}">
                                                                @csrf

                                                                @method('DELETE')
                                                                <button type="submit" class="text-danger dropdown-item" href="">{!! $action->icon ? '<i class="bx bx-'.$action->icon.'-alt me-1"></i>' : ''!!}{{$action->label}}</button>
                                                            </form>
                                                        </li>

                                                        </form>

                                                        </li>
                                                    @else
                                                        <li><a class="dropdown-item" href="{{route($action->route, $row->id )}}">{!! $action->icon ? '<i class="bx bx-'.$action->icon.'-alt me-1"></i>' : ''!!}{{$action->label}}</a></li>

                                                    @endif
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                @elseif(property_exists($column, 'render'))
                                    @if(is_callable($column->render))
                                        @php
                                            $render = $column->render;
                                        @endphp
                                        {!!$render($row)!!}

                                    @endif
                                @else

                                    {{$row[$column->data]}}
                                @endif
                            </td>
                        @endforeach

                    </tr>
                @endforeach
            </table>

            <!-- Basic Pagination -->
            <div class="m-4">
                {!! $data->links('pagination::bootstrap-4') !!}
            </div>
            <!--/ Basic Pagination -->
        </div>
    </div>
</div>


@push('scripts')
    <script type="text/javascript">
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                }else{
                    getData(page);
                }
            }
        });
        $(document).ready(function()
        {
            $(document).on('click', '.pagination a',function(event)
            {
                event.preventDefault();
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                param = ss.urlParams($(this).attr('href'));
                console.log(param)
                ss.getPaginateData($(this).attr('href'), param, '#result_container')
            });

            $(document).on('click', 'a[data-ajax=1]',function(event)
            {
                event.preventDefault();
                href = $(this).attr('href');
                title = $(this).attr('data-title');
                ss.getAjaxModal(href, {title : title }, '#ajax_content', '#ajaxModal')
            });
        });

    </script>
@endpush
