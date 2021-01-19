@extends('layouts.admin.index')
  @section('content')
<br>
<br>
<br>
<br>
      <div class="row" style="margin-bottom: 250px">
          <div class="col-md-12">
              <div class="box-body">
                  <div class="error-page text-center">
                      <h3 class="text-red">403</h3>

                      <h4 class="text-red">Permission denied!</h4>
                      @if ($url)
                        <strong> <span><i class="fa fa-warning text-red" aria-hidden="true"></i> You can not access to url <code>{{ $url }}</code> </span></strong>
                      @endif
                  </div>
              </div>
          </div>
      </div>

    @endsection

@if ($url)
    <script>
        window.history.pushState("", "", '{{ $url }}');
    </script>
@endif
