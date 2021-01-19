@extends('layouts.admin.index')
 @section('content')

  <!-- Main content -->


  <div class="container-fluid">

      <div class="panel panel-default">

      <div class="panel-heading">

        <h3 class="panel-title"><i class="fa fa-list"> </i>  {{trans('role.text_list')}}</h3>
      </div>
      <div class="panel-body">


        <div class="row">




        <form action="{{$action}}" method="post"  class="form-horizontal" id="role_form">
            {{ csrf_field()}}

               <div class="form-group">
                <label class="col-sm-2 control-label" for="input-name">
                    &nbsp;  &nbsp; {{ trans('role.label_name') }}  </label>
                <div class="col-sm-8">
                    <input type="text" name="name" value="{{old('name',isset($role->name)? $role->name : '')}}"
                           placeholder="{{ trans('role.entry_name') }} "
                           id="input-name" class="form-control"/>
                    <input type="hidden" name="role_id"
                           value="{{isset($role->id) ?  $role->id  :''}}"/>


                    @error('name')
                    <span class="text-danger">
                      <i class="fa fa-info-circle"></i>
                        {{$message}}
                      </span>
                    @enderror

                </div>

            </div>
                <div class="form-group">
                <label class="col-sm-2 control-label" for="input-slug">   &nbsp;  &nbsp;  {{ trans('role.label_slug') }}  </label>
                <div class="col-sm-8">
                    <input type="text"   name="slug" value="{{old('slug', isset($role->slug)  ?  $role->slug :  '')}}"
                           placeholder="{{ trans('role.entry_slug') }}"
                           id="input-slug" class="form-control"/>


                    @error('slug')
                    <span class="text-danger">
                      <i class="fa fa-info-circle"></i>
                        {{$message}}
                      </span>
                     @enderror

                </div>


            </div>



                  <div class="form-group" >
                      <label class="col-sm-2 control-label" for="input-permission"><span
                              data-toggle="tooltip"
                              title="{{trans('product.help_category')}}">   &nbsp;  &nbsp; {{ trans('role.label_permissions') }}</span></label>
                      <div class="col-sm-8  permission">
                          <input type="text" name="permission"
                                 placeholder="{{ trans('role.entry_permissions') }}" id="input-permissions"
                                 class="form-control"/>
                          <div id="role-permission" class="well well-sm"
                               style="height: 150px; overflow: auto;">
                              <div class="col-sm-5">
                                  @if(isset($role))
                                      <?php  foreach ($role->permissions as $permission) { ?>
                                      <div id="role-permission"><i class="fa fa-minus-circle" style="color:#d9534f;"></i>
                                          {{$permission->name}}
                                          <input type="hidden" name="role_permissions[]" value="{{$permission->id}}" />
                                      </div>
                                      <?php } ?>
                                  @endif
                              </div>
                          </div>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-user"><span
                              data-toggle="tooltip"
                              title="{{trans('product.help_category')}}">   &nbsp;  &nbsp; {{ trans('role.label_user') }}</span></label>
                      <div class="col-sm-8 users">
                          <input type="text" name="user"
                                 placeholder="{{ trans('role.label_user') }}" id="input-users"
                                 class="form-control"/>
                          <div id="role-user" class="well well-sm"
                               style="height: 150px; overflow: auto;">
                              <div class="col-sm-5">
                                  @if(isset($role))
                                      <?php  foreach ($role->users as $user) { ?>
                                      <div id="role-user"><i class="fa fa-minus-circle" style="color:#d9534f;"></i>
                                          {{$user->name}}
                                          <input type="hidden" name="role_users[]" value="{{$user->id}}" />
                                      </div>
                                      <?php } ?>
                                  @endif
                              </div>
                          </div>
                      </div>
                  </div>



        </form>
        </div>
    </div>
  </div>

  @push('roles_scripts')
  <script type="text/javascript">

      // permission
      $('input[name=\'permission\']').autocomplete({
          'source': function (request, response) {
              var filter_name1 = $('input[name=\'permission\']').val();
              $.ajax({
                  url: "{{route('admin.permissions.autocomplete')}}",
                  type: "post",
                  dataType: 'json',
                  data: {filter_name: filter_name1},
                  success: function (json) {
                      response($.map(json, function (item) {
                          return {
                              label: item['name'],
                              value: item['id']
                          }
                      }));
                  }
              });
          },
      'select': function (item) {
          $('input[name=\'permission\']').val('');

          $('#role-permission' + item['value']).remove();

          $('#role-permission').append('<div id="role-permission' + item['value'] + '">' +
              '<i class="fa fa-minus-circle" style="color:#d9534f;"></i> ' + item['label'] + '<input type="hidden" name="role_permissions[]" value="' + item['value'] + '" /></div>');
      }
      });
      $('#role-permission').delegate('.fa-minus-circle', 'click', function () {
          $(this).parent().remove();
      });
      // users
      $('input[name=\'user\']').autocomplete({
          'source': function (request, response) {
              var filter_name1 = $('input[name=\'user\']').val();
              $.ajax({
                  url: "{{route('admin.users.autocomplete')}}",
                  type: "post",
                  dataType: 'json',
                  data: {filter_name: filter_name1},
                  success: function (json) {
                      response($.map(json, function (item) {
                          return {
                              label: item['name'],
                              value: item['id']
                          }
                      }));
                  }
              });
          },
          'select': function (item) {
              $('input[name=\'user\']').val('');

              $('#role-user' + item['value']).remove();

              $('#role-user').append('<div id="role-user' + item['value'] + '"><i class="fa fa-minus-circle" style="color:#d9534f;"></i> ' + item['label'] +
                  '<input type="hidden" name="role_users[]" value="' + item['value'] + '" /></div>');
          }
      });


      $('#role-user').delegate('.fa-minus-circle', 'click', function () {
          $(this).parent().remove();
      });



  </script>
  @endpush
    @endsection
