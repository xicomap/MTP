@extends('user.layout.app')
@section('content')
<section class="content">
	<div class="map">
		<div id="map-canvas"></div>
	</div>
	<div class="contact-section">
		<h1>Get in touch</h1>
		 @include('common.notify')
		<div class="row">
		 <form action="{{url('contact')}}" method="post">
            {{ csrf_field() }}
			<div class="col-md-8">
				<div class="contact-form">
					<div class="row">
						<div class="col-md-6">
							<input type="text" placeholder="First Name" name="first_name" id="FirstName">
						</div>
						<div class="col-md-6">
							<input type="text" placeholder="Last Name" name="last_name" id="LastName">
						</div>
						<div class="col-md-6">
							<input type="email" placeholder="Email Address" name="email" id="email">
						</div>
						<div class="col-md-6">
							<input type="text" placeholder="Subject" name="subject" id="subject">
						</div>
						<div class="col-md-12">
							<textarea placeholder="Message" name="message" id="message"></textarea>
						</div>
						<div class="col-md-12">
							<button type="submit" class="btn btn-primary yellow">Submit</button>
						</div>
					</div>
				</div>
			</div>
			</form>
			<div class="col-md-4">
				<div class="contact-address">
					<h2>Address</h2>
					<ul>
						<li><i class="fas fa-map-marker-alt"></i> #100, Loram ipsum, DC
							20037,<br> United States</li>
						<li><i class="fas fa-phone"></i> +123 1234567890</li>
						<li><i class="fas fa-envelope"></i> info@metip.com</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJlxpv-At0D1_b8VP1-MJNncWHEXikTuc" type="text/javascript"></script>
<script>
$(window).ready(function() {
var $ = jQuery;
var LocationData = [[40.551162,-76.2459007]];
var map;
var infowindow;
var myOptions = {
    zoom: 10,
    panControl: false,
    scaleControl: false,
    zoomControl: true,
    scrollwheel: false,
    zoomControlOptions: {style: google.maps.ZoomControlStyle.LARGE,position: google.maps.ControlPosition.TOP_LEFT},
    styles:[
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#e9e9e9"
            },
            {
                "lightness": 17
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f5f5f5"
            },
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#c9c9c9"
            },
            {
                "lightness": 17
            },
            {
                "weight": 4
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#ffffff"
            },
            {
                "lightness": 29
            },
            {
                "weight": 0.2
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#d3d3d3"
            },
            {
                "lightness": 30
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#ffffff"
            },
            {
                "lightness": 16
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f5f5f5"
            },
            {
                "lightness": 21
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#e5e5e5"
            },
            {
                "lightness": 21
            }
        ]
    },
    {
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#ffffff"
            },
            {
                "lightness": 16
            }
        ]
    },
    {
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "saturation": 36
            },
            {
                "color": "#333333"
            },
            {
                "lightness": 40
            }
        ]
    },
    {
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f2f2f2"
            },
            {
                "lightness": 19
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#fefefe"
            },
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#fefefe"
            },
            {
                "lightness": 17
            },
            {
                "weight": 1.2
            }
        ]
    }
]
    };
function initialize()
{
    map = new google.maps.Map(document.getElementById('map-canvas'), myOptions);
    var bounds = new google.maps.LatLngBounds();
    infowindow = new google.maps.InfoWindow();
    var inc_count = 1;
    for (var i in LocationData)
    {
        var p = LocationData[i];
        var latlng = new google.maps.LatLng(p[0], p[1]);
        bounds.extend(latlng);
        var marker = new google.maps.Marker({position: latlng,map: map,title: p[2], address:p[3], link:p[4]});
        marker.setIcon("{{ asset('/asset/images//map-icon.png') }}");
      //   google.maps.event.addListener(marker, "click", function(){
      //   infowindow.open(map, this);
      // });
    }
    map.setCenter(marker.getPosition());
    //map.fitBounds(bounds);
}
google.maps.event.addDomListener(window, 'load', initialize);
});
</script>
@endsection