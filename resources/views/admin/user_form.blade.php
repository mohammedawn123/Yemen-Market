@extends('layouts.admin.index')
 @section('content')

  <!-- Main content -->



  <div class="container-fluid">
      <div class="panel panel-default">
      <div class="panel-body">
        <div class="row">
        <form action="{{$action}}" method="post" enctype="multipart/form-data" class="form-horizontal" id="user_form">
            {{ csrf_field()}}
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-general"
                                      data-toggle="tab">{{trans('user.tab_general')}}</a></li>
                <li><a href="#tab-data" data-toggle="tab">{{trans('user.tab_privlages')}}</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab-general">
                <div class="form-group">
                <label class="col-sm-2 control-label" for="input-name">  &nbsp;   &nbsp;{{trans('user.label_username')}}</label>
                <div class="col-sm-8">
                    <input type="text" name="name" value="{{isset($user->name)? $user->name : ''}}"
                           placeholder="{{trans('user.entry_username')}}"
                           id="input-name" class="form-control"/>
                    <input type="hidden" name="user_id"
                           value="{{isset($user->id) ?  $user->id  :''}}"/>
                    @error('name')

                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
                <div class="form-group">
                <label class="col-sm-2 control-label" for="input-email">  &nbsp;  &nbsp;{{trans('user.label_email')}}</label>
                <div class="col-sm-8">
                    <input type="text" autocomplete="off" name="email" value="{{old('email', isset($user->email)  ?  $user->email :  '')}}"
                           placeholder="your-email@your-domain.com"
                           id="input-email" class="form-control"/>


                    @error('email')

                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                    <span id="email_reset" > <i class="fa fa-refresh"></i></span>

            </div>

                <div class="form-group">
                <label class="col-sm-2 control-label" >  &nbsp;  &nbsp;{{trans('user.label_photo')}}</label>
                <div class="col-sm-3">
                    <a href="" id="thumb-image" data-toggle="image" class="thumbnail">
                        <img name="user_photo"
                             src="{{old('user_photo' ,  isset($user->photo  ) ?  asset( '/view/image/'.$user->photo)  :   asset('/view/image/user_photo4.png') )}}"
                             alt="" title="" data-placeholder=""/>
                    </a>
                    <input type="hidden" name="image" value="{{old('image' ,  isset($user->photo  ) ?  $user->photo :   'catalog/customers_photo/user_photo4.png' )}}" id="input-image">

                </div>
            </div>
                <div class="form-group">
                <label class="col-sm-2 control-label" for="input-password">  &nbsp;  &nbsp; {{trans('user.label_password')}} </label>
                <div class="col-sm-8">
                    <input type="password" name="password"
                           placeholder="{{trans('user.entry_password')}}"
                           id="input-password" class="form-control"/>
                   @if(isset($user))
                    <span class="help-block">Leave blank if you don't want to change the password  </span>
                    @endif
                    @error('password')

                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                  <span id="password_reset" > <i class="fa fa-refresh"></i></span>
                </div>
               <div class="form-group">
                <label class="col-sm-2 control-label" for="password_confirmation">  &nbsp;  &nbsp; {{trans('user.label_Confirm')}} </label>
                <div class="col-sm-8">
                    <input type="password" name="password_confirmation"
                           placeholder=" {{trans('user.entry_confirm')}} "
                           id="password_confirmation" class="form-control password_confirmation"/>
                    @if(isset($user))
                    <span class="help-block">Leave blank if you don't want to change the password  </span>
                    @endif
                    @error('password_confirmation')

                    <div class="text-danger">{{$message}}</div>
                    @enderror

                </div>
                   <span id="password_confirmation_reset" > <i class="fa fa-refresh"></i></span>

            </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-status">
                          {{trans('customer.status')}}
                      </label>
                      <div class="col-sm-8">
                          <select name="status" id="input-status"
                                  class="form-control">
                              <option value="1" {{old('status' ,$user->status ?? '')===1 ? 'selected' : '' }}> Enabled</option>
                              <option value="0" {{old('status' ,$user->status ?? '')===0 ? 'selected' : '' }}> Disabled</option>
                          </select>
                      </div>
                  </div>
              </div>
               <div class="tab-pane" id="tab-data">
                   <div class="form-group">
                       <label class="col-sm-2 control-label" for="input-roles">  &nbsp;  &nbsp;<span
                               data-toggle="tooltip"
                               title="{{trans('product.help_category')}}"> {{trans('user.label_roles')}} </span></label>
                       <div class="col-sm-8 permission">
                           <input type="text" name="roles"
                                  placeholder="{{trans('user.entry_roles')}} " id="input-roles"
                                  class="form-control"/>
                           <div id="user-role" class="well well-sm"
                                style="height: 150px; overflow: auto;">

                                   @if(isset($user))
                           <?php  foreach ($user->roles as $role) { ?>
                          <div id="user-role"><i class="fa fa-minus-circle" style="color:#d9534f;"></i>
                              {{$role->name}}
                               <input type="hidden" name="user_roles[]" value="{{$role->id}}" />
                                            </div>
                               <?php } ?>
                                   @endif

                           </div>
                       </div>
                   </div>
                   <div class="form-group">
                       <label class="col-sm-2 control-label" for="input-permission"><span
                               data-toggle="tooltip"
                               title="{{trans('product.help_category')}}">  &nbsp;  &nbsp;{{trans('user.label_permissions')}}</span></label>
                       <div class="col-sm-8 permission"  >
                           <input type="text"  name="permission"
                                  placeholder="{{trans('user.entry_permissions')}}" id="input-permission"
                                  class="form-control"/>
                           <div id="user-permission" class="well well-sm"
                                style="height: 150px; overflow: auto;">


                         @if(isset($user))

                           <?php  foreach ($user->permissions as $permission) { ?>
                             <div id="user-permission" >
                                 <i class="fa fa-minus-circle" style="color:#d9534f;"></i>
                                 {{$permission->name}}
                               <input type="hidden" name="user_permissions[]" value="{{$permission->id}}" />
                                            </div>
                               <?php   } ?>
                                   @endif
                           </div>


                       </div>
                   </div>


               </div>
            </div>
        </form>
        </div>
    </div>
  </div>

  @push('users_scripts')
  <script type="text/javascript">
      $("#email_reset").click(function () {
          $('input[name=\'email\']').val('');
      });
      $("#password_reset").click(function () {
          $('input[name=\'password\']').val('');
      });
      $("#password_confirmation_reset").click(function () {
          $('input[name=\'password_confirmation\']').val('');
      });
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

          $('#user-permission' + item['value']).remove();

          $('#user-permission').append('<div id="user-permission' + item['value'] + '"><i class="fa fa-minus-circle" style="color:#d9534f;"></i> ' + item['label'] + '<input type="hidden" name="user_permissions[]" value="' + item['value'] + '" /></div>');
      }
      });
      // roles
      $('input[name=\'roles\']').autocomplete({
          'source': function (request, response) {
              var filter_name1 = $('input[name=\'roles\']').val();
              $.ajax({
                  url: "{{route('admin.roles.autocomplete')}}",
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
              $('input[name=\'roles\']').val('');

              $('#user-role' + item['value']).remove();

              $('#user-role').append('<div id="user-role' + item['value'] + '"><i class="fa fa-minus-circle" style="color:#d9534f;"></i> ' + item['label'] + '<input type="hidden" name="user_roles[]" value="' + item['value'] + '" /></div>');
          }
      });

      $('#user-permission').delegate('.fa-minus-circle', 'click', function () {
          $(this).parent().remove();
      });
      $('#user-role').delegate('.fa-minus-circle', 'click', function () {
          $(this).parent().remove();
      });



  </script>
  @endpush
    @endsection
