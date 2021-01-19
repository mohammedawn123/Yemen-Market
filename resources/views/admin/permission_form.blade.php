@extends('layouts.admin.index')
 @section('content')

  <!-- Main content -->



  <div class="container-fluid">

      <div class="panel panel-default">

      <div class="panel-heading">

        <h3 class="panel-title"><i class="fa fa-list"> </i> {{trans('permission.text_form')}}</h3>
      </div>
      <div class="panel-body">


        <div class="row">


            <form action="{{ $action }}" method="post"  class="form-horizontal" id="permission_form">
            {{ csrf_field()}}

               <div class="form-group">
                <label class="col-sm-2 control-label" for="input-name">
                    &nbsp;  &nbsp;      {{trans('permission.label_name')}} </label>
                <div class="col-sm-8">
                <div class="input-group">

                    <div class="input-group-btn">
                        <button  type="button"  class="btn btn-default dropdown-toggle" data-toggle="dropdown">

                            <span class="glyphicon glyphicon-user"></span>
                        </button>
                    </div>
                    <input type="text" name="name" value="{{old('name',isset($permission->name)? $permission->name : '')}}"
                           placeholder="  {{trans('permission.entry_name')}} "
                           id="input-name" class="form-control"/>
                    <input type="hidden" name="permission_id"
                           value="{{isset($permission->id) ?  $permission->id  :''}}"/>

                </div>
                    @error('name')
                    <span class="text-danger">
                      <i class="fa fa-info-circle"></i>
                        {{$message}}
                      </span>
                    @enderror

                </div>

            </div>
                <div class="form-group">
                <label class="col-sm-2 control-label" for="input-slug">   &nbsp;  &nbsp;  {{trans('permission.label_slug')}} </label>
                <div class="col-sm-8">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button  type="button"  class="btn btn-default dropdown-toggle" data-toggle="dropdown">

                            <span class="glyphicon glyphicon-screenshot"></span>
                        </button>
                    </div>
                    <input type="text"   name="slug" value="{{old('slug', isset($permission->slug)  ?  $permission->slug :  '')}}"
                           placeholder=" {{trans('permission.entry_slug')}}"
                           id="input-slug" class="form-control"/>

                </div>
                    @error('slug')
                    <span class="text-danger">
                      <i class="fa fa-info-circle"></i>
                        {{$message}}
                      </span>
                     @enderror

                </div>


            </div>


                  <div class="form-group" >
                      <label class="col-sm-2 control-label" for="input-path">   &nbsp;  &nbsp; {{trans('permission.label_http_path')}}</label>
                      <div class="col-sm-8  routesAdmin">
                          <div class="input-group">

                              <div class="input-group-btn">
                              <button  type="button"  class="btn btn-default dropdown-toggle" data-toggle="dropdown">

                                  <span class="caret"></span>
                              </button>
                          </div>
                              <input type="text" name="path"
                                     placeholder="{{trans('permission.entry_http_path')}}" id="input-path"
                                     class="form-control">

                          </div>
                          <div id="permission-path" class="well well-sm"
                               style="height: 150px; overflow: auto;">

                        <?php if(isset($routeAdmin)){

                               $old_http_uri = old('permission_paths',($permission)?explode(',', $permission->http_uri):[]);

                           foreach($routeAdmin as  $route)  {
                                if( in_array($route['uri'], $old_http_uri) ) { ?>
                                                  <div id="permission-path"><i class="fa fa-minus-circle" style="color:#d9534f;"></i>
                                                      {{ ($route['name'])?$route['method'].'::'.$route['name']:$route['uri'] }}
                                                      <input class="permission_paths" type="hidden" name="permission_paths[]" value="{{ $route['uri'] }}"  />
                                                  </div>
                                              <?php }   } }?>


                          </div>
                      </div>
                  </div>





        </form>
        </div>
    </div>
  </div>

  @push('permission_form_scripts')
  <script type="text/javascript">

      // permission
      $('input[name=\'path\']').autocomplete({
          'source': function (request, response) {
              var filter_name1 = $('input[name=\'path\']').val();
              $.ajax({
                  url: "{{route('routeAdmin.autocomplete')}}",
                  type: "post",
                  dataType: 'json',
                  data: {filter_name: filter_name1 , old_http_uri:get_path()},
                  success: function (json) {
                      console.log(json)
                      response($.map(json, function (item) {

                          return {
                              label: item['uri'],
                              value: item['key'],
                              flag:item['flag']

                          }
                      }));

                  }
              });
          },
      'select': function (item) {
          $('input[name=\'path\']').val('');

          $('#permission-path' + item['value']).remove();

          $('#permission-path').append('<div id="permission-path' + item['value'] + '">' +
              '<i class="fa fa-minus-circle" style="color:#d9534f;"></i> ' + item['label'] + '<input class="permission_paths"  type="hidden" name="permission_paths[]" value="' + item['label'] + '" /></div>');
      }
      });
      $('#permission-path').delegate('.fa-minus-circle', 'click', function () {
          $(this).parent().remove();
      });
      function get_path()
      {
          var selected = [];
          $('.permission_paths').each(function(){
              selected.push($(this).val());
          });

          return selected;
      }


  </script>
  @endpush
    @endsection
