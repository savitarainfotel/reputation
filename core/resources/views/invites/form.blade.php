<div class="row g-3 align-items-center">
  <div class="col-auto">
    <label for="firstName" class="col-form-label">@lang('Name')</label>
  </div>
  <div class="col">
    <input type="text" hidden name="id" value="{{ isset($invite) ? $invite->id : '' }}" />
    <input type="text" id="name" name="name" value="{{ isset($invite) ? $invite->name : '' }}" class="form-control" placeholder="Name">
  </div>

  <div class="col-auto">
    <label for="email" class="col-form-label">@lang('Email')</label>
  </div>
  <div class="col">
    <input type="email" id="email" name="email" value="{{ isset($invite) ? $invite->email : '' }}" class="form-control" placeholder="Email">
  </div>

  <div class="col-auto">
    <label for="phone" class="col-form-label">@lang('Phone')</label>
  </div>
  <div class="col">
    <input type="text" id="phone" name="phone" value="{{ isset($invite) ? $invite->phone : '' }}" class="form-control" placeholder="Phone">
  </div>
</div>