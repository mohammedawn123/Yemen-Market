@extends('layouts.admin.auth.index')

@section('content')

        <div class="container-fluid"><br />
            <br />
            <div class="row">
                <div class="col-sm-offset-4 col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1 class="panel-title"><i class="fa fa-lock"></i> {{trans('product.text_login')}} </h1>
                        </div>
                        <div class="panel-body">
                            <?php  if (isset($success)) { ?>
                         <div class="alert alert-success"><i class="fa fa-check-circle"></i> {{$success}}
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                            <?php } ?>
                            <?php  if (isset($error_login) ){ ?>
                            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> {{$error_login}}
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                            <?php  } ?>
                            <form action="{{route('admin.login')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="input-email">{{trans('product.entry_email')}}</label>
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" name="email"  placeholder="{{trans('product.entry_email')}}" id="input-email" class="form-control" />

                                    </div>
                                  @error('email')

                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="input-password">{{trans('product.entry_password')}}</label>
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" name="password"  placeholder="{{trans('product.entry_password')}}" id="input-password" class="form-control" />
                                    </div>
                                  @error('password')

                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                    <?php // if ($forgotten) { ?>
                                    <span class="help-block"><a href="#">{{trans('product.text_forgotten')}}</a></span>
                                    <?php // } ?>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> {{trans('product.button_login')}}</button>
                                </div>
                                <?php // if ($redirect) { ?>
                                <input type="hidden" name="redirect" value="<?php echo 'redirect'; ?>" />
                                <?php // } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
