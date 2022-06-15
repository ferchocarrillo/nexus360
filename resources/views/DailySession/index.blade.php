@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' . config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Daily Sessions')


@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />
    <style>
        .skeleton .line:not(:last-child) {
            margin-bottom: 7px;
        }

        .skeleton .line {
            height: 13px;
            border-radius: 2px;
            background: linear-gradient(90deg,
                    #e5e5e5 30%,
                    #f0f0f0 38%,
                    #f0f0f0 40%,
                    #e5e5e5 48%);
            background-size: 200% 100%;
            background-position: 100% 0;
            animation: load 2s infinite;
        }

        @keyframes load {
            100% {
                background-position: -100% 0;
            }
        }

        .employee-info {
            background-color: #ededed;
            border-radius: .5rem;
            border: 1px solid #ddd;
            padding: .5rem;
            margin-bottom: 1rem;
        }

    </style>
@stop

@section('content_header')
    <h1 class="d-inline">Daily Sessions</h1>
    @can('dailysessions.create')
        <button type="button" id="newRecord" class="btn btn-primary float-right">
            <i class="fas fa-plus"></i> New Record
        </button>
    @endcan
@stop

@section('content')
    <div class="card">
        <div class="card-body p-2">
            <form class="form-custom" id="form-filter">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            {!! Form::label('start_date', 'Start Date') !!}
                            {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group mb-md-0">
                            {!! Form::label('end_date', 'End Date') !!}
                            {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    @can('dailysessions.filters')
                    <div class="col-md-6">
                        <div class="row">
                            <div class="form-group col-md-6 mb-0">
                                {!! Form::label('campaign', 'Campaign') !!}
                                {!! Form::select('campaign', $campaigns, null, ['class' => 'form-control', 'placeholder' => 'Select a Campaign']) !!}
                            </div>
                            <div class="form-group col-md-6 mb-0">
                                {!! Form::label('team_leader', 'Team Leader') !!}
                                {!! Form::select('team_leader', [], null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-12 mb-md-0">
                                {!! Form::label('agent', 'Agent') !!}
                                {!! Form::select('agent', [], null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    @endcan
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col mb-2">
                                <button type="button" id="applyFilter" class="btn  btn-primary btn-block mt-md-4">
                                    <i class="fas fa-filter"></i> Apply filter
                                </button>
                            </div>
                            <div class="col mb-2">
                                <button type="button" id="clearFilter" class="btn  btn-primary btn-block mt-md-4">
                                    <i class="fas fa-eraser"></i> Clear filter
                                </button>
                            </div>
                            @can('dailysessions.download')
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-block" id="download">
                                    <i class="fas fa-download"></i> Download Data
                                </button>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row" id="dailySessions"></div>
    <div class="row loading" style="display: none;">
        <div class="col-xl-3 col-md-4 col-sm-6 mb-2">
            <div class="card">
                <div class="card-body  h-100 skeleton">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6 mb-2">
            <div class="card">
                <div class="card-body  h-100 skeleton">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6 mb-2">
            <div class="card">
                <div class="card-body  h-100 skeleton">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6 mb-2">
            <div class="card">
                <div class="card-body  h-100 skeleton">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDailySession" tabindex="-1" role="dialog" aria-labelledby="modalDailySession"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content shadow"></div>
        </div>
    </div>
@stop

@push('js')

    <script type="text/javascript" src="{{ asset('vendor/select2/js/select2.min.js') }} "></script>
    <script>
        $.fn.select2.defaults.set("theme", "bootstrap4");
        $.fn.select2.defaults.set("width", "auto");
        const employess = @json($employess);
        let page = 1
        let lastPage = 1
        let scrolling = false;
        let params = '';
        $(document).ready((e) => {
            const formFilter = document.getElementById('form-filter');

            $('#campaign').select2({
                placeholder: "Select a Campaign"
            });
            $('#team_leader').select2({
                placeholder: "Select a Team Leader"
            });
            $('#agent').select2({
                placeholder: "Select a Agent"
            });

            $('#clearFilter').click((e) => {
                formFilter.reset();
                $('#campaign').val('').trigger('change')
                params = '';
                fetchData(true);
            })

            const filterLists = () => {
                var campaign = $('#campaign').val();
                var team_leader = $('#team_leader').val();
                var agent = $('#agent').val();

                var list = employess;

                if (campaign && team_leader && agent) {
                    list = list.filter(e => e.full_name == agent)
                }
                if (campaign && team_leader) {
                    list = list.filter(e => e.supervisor == team_leader)
                }
                if (campaign) {
                    list = list.filter(e => e.campaign == campaign)
                }

                var lists = {
                    campaign: [...new Set(list.map(e => e.campaign))],
                    team_leader: [...new Set(list.map(e => e.supervisor))],
                    agent: list.map(e => {
                        // return e.full_name
                        return {
                            id: e.id,
                            text: e.national_id + ' - ' + e.full_name
                        }
                    })
                }

                return lists
            }

            $('#campaign').change((e) => {
                $('#agent').empty();
                $('#team_leader').empty();
                if ($(e.target).val()) {
                    $('#team_leader')
                        .select2({
                            placeholder: "Select a Team Leader",
                            data: filterLists()['team_leader']
                        })
                        .val('')
                        .trigger('change');
                }
            })
            $('#team_leader').change((e) => {
                $('#agent').empty();
                if ($(e.target).val()) {
                    $('#agent').select2({
                        data: filterLists()['agent'],
                        placeholder: "Select a Agent"
                    }).val('').trigger('change');
                }
            })

            const fetchData = (refreshData = false) => {
                if (scrolling) return;
                if (refreshData) page = 1
                if (page > lastPage) return;
                scrolling = true;
                $('.loading').show();
                $.ajax({
                    url: `/dailysessions?page=${page}&${params}`,
                    type: 'GET',
                    data: {},
                    success: res => {
                        if (refreshData) {
                            $('#dailySessions').html(res.html)
                        } else {
                            $('#dailySessions').append(res.html)
                        }

                        $('.loading').hide();
                        lastPage = res.lastPage
                        page++;
                        scrolling = false;
                        if (window.innerHeight + window.pageYOffset >= (document.body.offsetHeight -
                                10))
                            fetchData()
                    }
                })
            }

            $('#applyFilter').click((e) => {
                let filters = $('#form-filter').serializeArray().filter(f => f.value);
                params = jQuery.param(filters);
                fetchData(true);
            })

            fetchData();

            $(document).on('click','#download',function(e){
                $('#logoLoading').modal('show')
                let filters = $('#form-filter').serializeArray().filter(f => f.value);
                filters = filters.map(f=>{return {[f.name]:f.value}})
                filters = Object.assign({},...filters);
                axios({
                    url: '/dailysessions/download',
                    method: 'POST',
                    responseType: 'blob',
                    data: filters
                }).then((res)=>{
                    var fileURL = window.URL.createObjectURL(new Blob([res.data]));
                    var fileLink = document.createElement('a');
                    $('#logoLoading').modal('hide')

                    fileLink.href = fileURL;
                    fileLink.setAttribute('download', 'DailySessionsReport.xlsx');
                    document.body.appendChild(fileLink);
                    fileLink.click();
                    fileLink.remove();
                })
            })

            $(document).on('click', '.showDailySession', function(e) {
                e.preventDefault();
                let dailySessionId = $(e.target).parents('.showDailySession').data("id");
                if (dailySessionId) {
                    $.ajax({
                        url: '/dailysessions/' + dailySessionId,
                        type: 'GET',
                        cache: false,
                        success: res => {
                            $('#modalDailySession .modal-content').html(res);
                            $('#modalDailySession').modal('show');
                        }
                    })
                }
            });

            window.onscroll = () => {
                if (window.innerHeight + window.pageYOffset >= (document.body.offsetHeight - 10)) fetchData()
            }

        });
    </script>
    {{-- New Record --}}
    <script>
        $(document).ready((e) => {
            $('#newRecord').click(e => {
                if (!$('#agent').val()) {
                    alert('Agent is required')
                    $('#agent').focus()
                    return;
                }
                $.ajax({
                    url: '/dailysessions/create',
                    type: 'GET',
                    cache: false,
                    data: {
                        agent_id: $('#agent').val()
                    },
                    success: res => {
                        $('#modalDailySession .modal-content').html(res);
                        $('#modalDailySession').modal('show');
                    }
                })
            })
            $("#modalDailySession").on("hidden.bs.modal", function() {
                $('#modalDailySession .modal-content').html('');
            });
        });
    </script>
@endpush
