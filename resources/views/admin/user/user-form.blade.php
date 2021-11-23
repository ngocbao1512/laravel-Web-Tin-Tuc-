<?php
    $action = !isset($user) ? 'create' : 'edit';
    $userId = !isset($user) ? 0 : $user->id;
    $firstName = !isset($user) ? '' : $user->first_name;
    $middleName = !isset($user) ? '' : $user->middle_name;
    $lastName = !isset($user) ? '' : $user->last_name;
    $email = !isset($user) ? '' : $user->email;
    $userName = !isset($user) ? '' : $user->user_name;
    $password = !isset($user) ? '' : $user->password;
    $avatar = !isset($user) ? '' : $user->avatar;
?>
<div class="modal-header">
    <h4>
        @if($action == 'create')
            {{trans('user.create_user')}}
        @else
            {{trans('user.edit_user')}}
        @endif
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">
    <div class="row" > 
        <div class="col-12" style="min-height: 70vh">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <form class="tm-edit-product-form" enctype="multipart/form-data">
                    @csrf
                    <div class="row tm-edit-product-row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-3 col-sm-4">
                                        <label for="firstname">
                                            <b>
                                                {{trans('user.first_name')}}
                                            </b>
                                        </label>
                                        <input id="first_name-{{$userId}}"  name="first_name" value="{{$firstName}}" type="text"  placeholder="{{trans('user.first_name')}}" class="form-control validate" required/>
                                    </div>
                                    <div class="col-xs-3 col-sm-4">
                                        <label for="middlename">
                                            <b>
                                                {{trans('user.middle_name')}}
                                            </b>
                                        </label>
                                        <input id="middle_name-{{$userId}}" name="middle_name" value="{{$middleName}}" type="text"  placeholder="{{trans('user.middle_name')}}" class="form-control validate" required/>
                                    </div>
                                    <div class="col-xs-3 col-sm-4">
                                        <label for="lastname">
                                            <b>
                                                {{trans('user.last_name')}}
                                            </b>
                                        </label>
                                        <input id="last_name-{{$userId}}" name="last_name" type="text" value="{{$lastName}}" placeholder="{{trans('user.last_name')}}" class="form-control validate" required/>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <label for="gmail">
                                            <b>
                                                {{trans('user.email')}}
                                            </b>
                                        </label>
                                        <input id="email-{{$userId}}" name="gmail" type="email" value="{{$email}}"  placeholder="{{trans('user.email')}}" class="form-control validate" required/>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <label for="user_name">
                                            <b>
                                                {{trans('user.user_name')}}
                                            </b>
                                        </label>
                                        <input id="user_name-{{$userId}}" name="user_name" type="text" value="{{$userName}}"  placeholder=" {{trans('user.user_name')}}" class="form-control validate" required/>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <label for="psw">
                                            <b>
                                                {{trans('user.pass_word')}}
                                            </b>
                                        </label>
                                        <input id="password-{{$userId}}" name="password" value="{{$password}}" type="password"  placeholder="{{trans('user.pass_word')}}" class="form-control validate" required/>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <label for="psw-repeat">
                                            <b>
                                                {{trans('user.re_pass_word')}}
                                            </b>
                                        </label>
                                        <input id="repeat_password-{{$userId}}" name="password_repeat" value="{{$password}}" type="password"  placeholder="{{trans('user.re_pass_word')}}" class="form-control validate" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
    
                            <div class="tm-product-img-dummy mx-auto" style=" background-color : rgb(243, 243, 243); min-height : 20vh;
                                border-radius : 10px; display: flex; justify-content : center; text-align : center;"
                                onclick="document.getElementById('input-avatar-{{$userId}}').click();">
                                <img id="preview-avatar-{{$userId}}" 
                                src="{{showImage('avatar',$avatar)}}" 
                                alt="" style="max-width: 100%; max-height : 30vh;" />
                            </div>
                            
                            <div class="custom-file mt-3 mb-3">
                                <input id="input-avatar-{{$userId}}" type="file" style="display:none;" name="avatar" required target-id="#preview-avatar-{{$userId}}"
                                    onchange="initReadImage(this);"
                                />
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label for="role">
                                        <b>
                                            roles
                                        </b>
                                    </label>
                                </div>
                                @foreach ($roles as $role)
                                    <input type="checkbox" class="role_checkbox" name="roles" value="{{$role->name}}" 
                                    @isset($user) 
                                        @foreach ($user->roles as $role_user) 
                                        @if ($role_user->name == $role->user) 
                                            checked 
                                        @endif 
                                        @endforeach
                                    @endisset> 
                                     {{ "  ".$role->name}}<br>
                                @endforeach
                            </div>
                        </div>   
                    </div>
                    <div class="col-12">
                        @if ($action =='create')
                            <button  type="button" class="btn btn-primary btn-block text-uppercase "
                                style="color:white;background-color:rgb(24 89 230);"
                                onclick="saveData(this,'{{trans('user.do_you_want.create')}}')"
                            >
                            {{trans('user.save_user')}}  
                            </button>
                        @else
                            <button  type="button" class="btn btn-primary btn-block text-uppercase "
                                style="color:white;background-color:rgb(24 89 230);"
                                onclick="saveData(this,'{{trans('user.do_you_want.update')}}',{{$userId}})"
                            >
                            {{trans('user.edit_user')}}
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>         
    </div>
</div>
