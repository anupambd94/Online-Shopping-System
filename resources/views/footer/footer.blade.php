<footer id="footer"><!--Footer-->        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quick Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Laptop</a></li>
                                <li><a href="#">Mobile</a></li>
                                <li><a href="#">Accessories</a></li>
                                <li><a href="#">Camera</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Payment System</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Contact Us</h2>
                            @if (Session::has('message'))
                                <div class="text-success">
                                    <ul class="list-unstyled">
                                        <li>{{ Session::get('message') }}</li>
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="text-danger">
                                    <ul class="list-unstyled">
                                        <li>{{ Session::get('message') }}</li>
                                    </ul>
                                </div>
                            @endif
                            @if (count($errors) > 0)
                                <div class="text-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('comment') }}" method="POST" class="searchform">
                               
                               {!! csrf_field() !!}
                                <input type="text" name="name" placeholder="Name" /></br></br>
                                <input type="text" name="email" placeholder="Your email address" /></br></br>
                                <textarea rows="4" name="body" placeholder="Write your Comment."></textarea></br></br>
                                <button type="submit" class="btn btn-default">Click Here!</button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                   
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->