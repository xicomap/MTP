@extends('user.layout.app')
@section('content')
<section class="content">
	<div class="user-page">
  <div class="row">
    @include('user.includes.links')           
    <div class="col-md-9 user-rigtpart">
    	@include('common.notify')
      <h1>{{$idea->title}}</h1>
      <p>{!! $idea->description !!}</p>
       <form action="{{route('submitproposal',$id)}}" method="post">
            {{ csrf_field() }}        
        <div class="input-row">
          <input type="text" placeholder="Quotation" name="quotation" id="quotation" required>
        </div>
        <div class="input-row">
          <textarea placeholder="Your comments" required name="description"></textarea>
        </div>

        <div class="input-row">
          <button type="submit" class="btn btn-primary yellow">Post your reply</button>
          <a href="{{route('proposals')}}"><button type="button" class="btn btn-primary yellow">Back</button></a>
        </div>
      </form>
    </div>
  </div>
</div>
</section>
@endsection