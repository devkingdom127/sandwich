@extends('layouts.app')

@section('title')
    Welcome : {{user()->name}}
@endsection


@section('content')

    @includeIf('layouts.header_home')

    <section class="admin">
        <div class="container container-custom">
            <div class="box-table">
                <div class="top-inputs">
                    <div class="left">
                        <form action="">
                            <div class="form-group">
                                <label for="title">Older</label>
                                <input type="text" class="form-control" id="title" placeholder="Title">
                            </div>
                        </form>
                    </div>

                    <div class="right">
                        <form action="{{route('export_order')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">

                                <label for="title">Sales Report</label>
                                <input type="date" name="from" class="form-control" id="title" placeholder="Period">
                            </div>
                            <div class="form-group">
                                <label for="title">To</label>
                                <input type="date" name="to" class="form-control" id="title" placeholder="Period">
                            </div>
                            <button type="submit"><i class="fas fa-file-export"></i> Export</button>
                        </form>
                    </div>
                </div>
                <section class="table">
                    <table id="keywords" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th><span>ORDER</span></th>
                            <th><span>DATE</span></th>
                            <th><span>CITY</span></th>
                            <th><span>MAP</span></th>
                            <th><span>NAME</span></th>
                            <th><span>MOBILE</span></th>
                            <th><span>PAYMENT</span></th>
                            <th><span>ITEMS</span></th>
                            <th><span>BILL</span></th>
                            <th><span>STATUS</span></th>
                            <th><span>ACTION</span></th>
                        </tr>
                        </thead>
                        <tbody>

                        @php $count = 01 ; @endphp
                        @foreach($items as $r)

                            <tr class="{{$r->status == 1 ? "not-active" : ""}}">
                                <td class="lalign"><span style="background: #FFF;color: #222">0{{$r->order_id}}</span></td>
                                <td>{{ substr($r->created_at, 0, 10) }}</td>
                                <td>{{$r->City->name}}</td>
                                <td><img src="{{path()}}map-white.png" alt=""></td>
                                <td>{{$r->name}}</td>
                                <td>{{$r->status == 1 ? "*********" : $r->phone}}</td>
                                <td>
                                    <img src="{{path()}}hand.svg" alt="">
                                    {{$r->cash()}}</td>
                                <td>{{$r->Items->count()}}</td>
                                <td>
                                    <div class="switch bill_css d-flex align-items-center">
                                        {{$r->total}}
                                        @if (substr($r->created_at, 0, 10) == $latestDate)
                                            <i class="far fa-bell"></i>
                                            <span class="d-flex custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="switch1" name="example">
                                                <label class="custom-control-label" for="switch1"></label>
                                            </span>    
                                        @endif
                                    </div>
                                </td>
                                    {!! $r->status1() !!}
                                <td class="btns-action">
                                    <a href="#" data-id="{{$r->order_id}}" class="green btn_gre"><i class="fas fa-check"></i></a>
                                    <a href="{{route('delete_order',['order_id'=>$r->order_id])}}" class="red"><i class="fas fa-times"></i></a>
                                    <a href="#" class="white" style="border: 1px solid #FFF"><i class="far fa-eye"></i></a>
                                </td>
                            </tr>
                            @php $count = 01 + $count ; @endphp
                        @endforeach

                        </tbody>
                    </table>
                    {{$items->render()}}
                </section>
            </div>
        </div>
    </section> <!-- End Conainer -->

    <div id="tag_container">
        @include('data.order')
    </div>

@endsection

@section("js")

    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.btn_gre', function () {
                getData($(this).data("id"));
            });
        });
        function getData(page) {
            $.ajax(
                {
                    data:{
                      "id" : page,
                    },
                    type: "get",
                    datatype: "html"
                }).done(function (data) {
                $("#tag_container").empty().html(data);
                $('.box-info').fadeIn(200);
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }
    </script>

@endsection