@extends("layouts.app")

@section("title")
    {{$item->name}}
@endsection

@section("content")
    @includeIf('layouts.header')

    <div class="container global-pages">
        <div class="box-content">
            <section class="content" style="margin-top: 50px">
                <h1 class="wow animate__animated animate__fadeInUp">
                    {{$item->name}}
                </h1>
                <img src="{{$item->img()}}" alt="{{$item->name}}">
                {!! $item->summary !!}
            </section>
        </div> <!-- End box-content -->
    </div> <!-- End Conainer -->

    @includeIf('layouts.footer')
@endsection
