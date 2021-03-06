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
                <form action="{{route('restaurant_post')}}" class="ajaxForm restaurant_post" data-name="restaurant_post"
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
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                       placeholder="Your Confirm Password">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="store">Store Name</label>
                                <input type="text" class="form-control" id="store_name" name="store_name"
                                       placeholder="Your Store Name">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="city_id">Store City</label>
                                <select class="form-control" id="city_id" name="city_id">
                                    @foreach($city_id as $r)
                                        <option value="{{$r->id}}">{{$r->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    @foreach($category_id as $r)
                                        <option value="{{$r->id}}">{{$r->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="web">Website/Instagram </label>
                                <input type="text" class="form-control" id="website" name="website"
                                       placeholder="Your Website | Instagram">
                            </div>
                        </div>

                        <h6>Does your store do its own delivery?</h6>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Restaurant Address </label>
                                <input type="text" class="form-control" id="address" name="address"
                                       placeholder="Your Restaurant Address">
                            </div>
                        </div>

                        <div class="box-map">
                            <img src="assets/img/map.png" alt="">
                        </div>


                    </div>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </section> <!-- End Conainer -->

    @includeIf('layouts.footer')
@endsection
