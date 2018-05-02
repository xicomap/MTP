<div class="modal fade" id="registerPopup" tabindex="-1" role="dialog" aria-labelledby="registerPopupLabel" aria-hidden="true">
  <form role="form" method="POST" action="{{ url('/register') }}">
  {{ csrf_field() }}
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerPopupLabel">Register</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="reg-profile-pic">
          <div class="rpp"><img src="{{ asset('/asset/images/profile-default.jpg') }}" alt=""></div>
          <label class="upload-picture">
            <input type="file">
            Upload Picture
          </label>
        </div>
        <div class="input-row">
          <input type="text" placeholder="First Name" name="first_name" id="FirstName">
        </div>
        <div class="input-row">
          <input type="text" placeholder="Last Name" id="LastName" name="last_name">
        </div>
        <div class="input-row">
          <input type="email" placeholder="E-mail" name="email" id="email">
        </div>
        <div class="input-row">
          <input type="password" placeholder="Password" name="password" id="password">
        </div>
        <div class="input-row">
          <input type="password" placeholder="Confirm Password" name="password_confirmation" id="PasswordConfirmation">
        </div>
        <div class="input-row">
          <div class="i-agree">
            <input type="checkbox" name="agree" id="agree"> I agree with <a href="#">Terms &amp; Conditions</a>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary yellow">Registration</button>
      </div>
    </div>
  </div>
  </form>
</div>