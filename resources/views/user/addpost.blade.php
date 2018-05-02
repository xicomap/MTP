@extends('user.layout.app')
@section('content')
<section class="content">
	<div class="user-page">
  <div class="row">
    @include('user.includes.links')           
    <div class="col-md-9 user-rigtpart">
    	@include('common.notify')
      <h1>Submit a post</h1>
      
       <form action="{{url('/user/create_post')}}" method="post">
            {{ csrf_field() }}
        <input type="hidden" name="type" value="2" required>
        
        @if($checkinv == 1)
        <p>Please provide all the required information mentioned below</p>
        <div class="input-row">
          <input type="text" placeholder="Title" name="title" id="Title" required>
        </div>
        <div class="input-row">
          <textarea placeholder="Description" required name="description"></textarea>
        </div>
<!--         <div class="input-row"> -->
<!--           <label class="add-file"> -->
<!--             <input type="file"> -->
<!--             <span><i class="fas fa-paperclip"></i> Add file</span> or drop here -->
<!--           </label> -->
<!--         </div> -->
        <div class="input-row">
          <button type="submit" class="btn btn-primary yellow">Submit</button>
        </div>
        @else
        <div class="input-row">
        <br>
          <p>You are not invited yet to post new challenges. Kindly contact to administrator for more details.</p>
        </div>
        @endif
      </form>
    </div>
  </div>
</div>
</section>
@endsection