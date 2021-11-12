<?php
    $action = !isset($blog) ? 'create' : 'edit';
    $blogId = !isset($blog) ? 0 : $blog->id;
    $title = !isset($blog) ? '' : $blog->title;
    $content = !isset($blog) ? '' : $blog->content;
    $author = !isset($blog) ? '' : $blog->user->name;
    $status = !isset($blog) ? 0 : $blog->is_verifited;
    $datePulish = !isset($blog) ? '' : $blog->publish_date;
    $password = !isset($blog) ? '' : $blog->password;
    $avatar = !isset($blog) ? '' : $blog->avatar;
?>
<div class="modal-header">
    <h4>
        @if($action == 'create')
            Create Blog
        @else
            Edit Blog
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
                    <div class="row tm-edit-product-row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <label for="title">
                                            <b>
                                                Title
                                            </b>
                                        </label>
                                        <input id="title_blog" name="title" type="text"  placeholder="Title Post" class="form-control validate" required/>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control validate" style="resize: none" class="form-control" cols="30" rows="20" placeholder="Enter descreption" name="content" id="content_blog"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
    
                            <div class="tm-product-img-dummy mx-auto" style=" background-color : rgb(243, 243, 243); min-height : 20vh;
                                margin-top : 130px; border-radius : 10px; display: flex; justify-content : center; text-align : center;">
                                <img id="preview_image" src="#" alt="" style="max-width: 100%; max-height : 30vh;"/>
                            </div>
                            
                            <div class="custom-file mt-3 mb-3">
                                <input id="patient_pic" type="file" style="display:none;" name="image" required id="image"/>
                                <input type="button" class="btn btn-primary btn-block mx-auto"
                                    value="UPLOAD IMAGE" 
                                    onclick="document.getElementById('patient_pic').click();"
                                    style="background-color:rgb(24 89 230);"
                                />
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <label for="title">
                                            <b>
                                                Post Schedule
                                            </b>
                                        </label>
                                        <div id="datepicker" data-date="12/03/2012"></div>
                                        <input type="" id="my_hidden_input">
                                    </div>
                                </div>
                            </div>
                            @if($action == 'update')
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <label for="public">
                                                Public
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <label class="switch">
                                                <input type="checkbox" name="is_verifited" @if ($status == 1)
                                                    checked 
                                                @endif>
                                                <span class="slider round"></span>
                                            </label>   
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                        </div>
                        <button  type="button" class="btn btn-primary btn-block text-uppercase " data-dismiss="modal" id="mainbutton" aria-label="Close"
                         style="color:white;background-color:rgb(24 89 230);">
                         Create Blog
                        </button>
                    </div>
                </form>
            </div>
        </div>         
    </div>
</div>
