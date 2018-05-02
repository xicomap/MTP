  <footer>
    <div class="footer-top">
      <!-- <div class="footer-col1">
        <img src="{{ asset('/asset/logo.png') }}" alt="METIP" />
        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum </p>
      </div> -->
      <div class="footer-col2">
        <h3>Marketing</h3>
        <ul>
          <li><a href="{{ url('/article_list') }}">Article</a></li>
          <li><a href="{{ url('/product_list') }}">Product</a></li>
        </ul>
        
        
        <h3>Documentation</h3>
        <ul>
            <li class=""><a href="{{route('tools')}}">Tools/Machinery</a></li>
            <li class=""><a href="{{route('rules')}}">Rules and Regulation</a></li>
        </ul>
        
        <h3><a href="{{ route('mlthome') }}">MLT</a></h3>
        <!-- <ul>
			<li class=""><a href="{{ route('mlthome') }}">MLT</a></li>
        </ul> -->
      </div>
      <div class="footer-col2">
        <h3>Innovation</h3>
        <ul>
          <li><a href="{{route('competition')}}">Idea Competition</a></li>
          <li><a href="{{route('challenge')}}">Public Challenge</a></li>
          <li><a href="{{route('send_challenge')}}">Send Public Challenge</a></li>
          <li><a href="{{route('sponser') }}">Sponser / Invester</a></li>
          <li><a href="{{route('winner')}}">Winners</a></li>
          @if(!Auth::guard('user')->check() OR (Auth::guard('user')->check() && (Auth::guard('user')->user()->user_type == 4) ) )
              <li class=""><a href="{{ route('metec') }}">Metec Employee</a></li>

            @else
              <li class=""><a href="{{ route('userpost') }}">Metec Employee</a></li>
            @endif
        </ul>
      </div>
      <div class="footer-col2">
        <h3>Usefull links</h3>
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('/static/about-us') }}">About us</a></li>
		  <li><a href="{{ url('/faq') }}">FAQ</a></li>
          <!-- <li><a href="#;">Innovation</a></li>
          <li><a href="#;">Marketing</a></li> -->
          <li><a href="#;">Support</a></li>
          <li><a href="{{ url('/contact') }}">Contact</a></li>
        </ul>
      </div>
      <div class="footer-col3">
        <h3>Contact Us</h3>
        @if(isset($footercontent))
        {!! $footercontent->content !!}
        @endif
       <!--  <p>22/121 Apple Street, New York, NY 10012, USA</p>
        <p>Phone: +123-456-7890<br>
          Mail@mteip.com</p> -->
        <div class="social-links">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <!-- <a href="#"><i class="fab fa-google-plus-g"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a> -->
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="copyright">
      Copyright &copy; 2018 METIP Site. All Rights Reserved.
    </div>
  </footer>