<div class="row" > 
    <div class="col-12" style="min-height: 70vh">
        <div class="float-center">
            <p class="tm-block-title d-inline-block float-center" style="font-size: 30px">Add User</p>
        </div>
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
                                            first Name
                                        </b>
                                    </label>
                                    <input id="first_name" name="first_name" type="text"  placeholder="first name" class="form-control validate" required/>
                                </div>
                                <div class="col-xs-3 col-sm-4">
                                    <label for="middlename">
                                        <b>
                                            middle Name
                                        </b>
                                    </label>
                                    <input id="middle_name" name="middle_name" type="text"  placeholder="middle name" class="form-control validate" required/>
                                </div>
                                <div class="col-xs-3 col-sm-4">
                                    <label for="lastname">
                                        <b>
                                            last Name
                                        </b>
                                    </label>
                                    <input id="last_name" name="last_name" type="text"  placeholder="last name" class="form-control validate" required/>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <label for="gmail">
                                        <b>
                                            Gmail Đăng Nhập 
                                        </b>
                                    </label>
                                    <input id="email" name="gmail" type="email"  placeholder="Enter Gmail" class="form-control validate" required/>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <label for="user_name">
                                        <b>
                                            User Name
                                        </b>
                                    </label>
                                    <input id="user_name" name="username" type="text"  placeholder="User Name" class="form-control validate" required/>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <label for="psw">
                                        <b>
                                            Pass Word
                                        </b>
                                    </label>
                                    <input id="password" name="password" type="password"  placeholder="password" class="form-control validate" required/>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <label for="psw-repeat">
                                        <b>
                                            Repeat Password
                                        </b>
                                    </label>
                                    <input id="repeat_password" name="password_repeat" type="password"  placeholder="Repeat Password" class="form-control validate" required/>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <hr>
                    <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">

                        
                        
                    </div>
                    <hr>

                    <button  type="button" class="btn btn-primary btn-block text-uppercase " data-dismiss="modal" id="mainbutton" aria-label="Close"
                     style="color:white;background-color:rgb(24 89 230);">
                     Create User
                    </button>
                </div>
            </form>
        </div>
    </div>         
</div>

@section('readFileImage')
  @include('partials.readFileImage')
@endsection
