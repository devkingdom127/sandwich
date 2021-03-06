@extends("layouts.app")

@section("title")
    Join Us Today!
@endsection

@section("content")
    @includeIf('layouts.header')

    <section class="register">
        <div class="breadcrumns">
            <h1>
                Reach new customers, get more sales
            </h1>
            <p>Join Talabat, The Middle East's Largest Delivery Platform</p>
        </div>
        <div class="container container-custom">
            <div class="box-form">
                <h3>Join Us Today!</h3>
                <form action="{{route('rider_post')}}" class="ajaxForm rider_post" data-name="rider_post"
                      method="post">
                    {{csrf_field()}}
                    <input id="id" name="id" type="hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Your First Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                       placeholder="Your Phone Number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="text" class="form-control" id="email" name="email"
                                       placeholder="Your Email Address">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Your Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                       name="password_confirmation"
                                       placeholder="Your Confirm Password">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="role">Nationality</label>
                                <select class="form-control" id="city_id" name="city_id">
                                    @foreach($city_id as $r)
                                        <option value="{{$r->id}}">{{$r->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="role">Driving License Taup</label>
                                <select class="form-control" id="license" name="license">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>


                    </div>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </section> <!-- End Conainer -->

    @includeIf('layouts.footer')
@endsection
