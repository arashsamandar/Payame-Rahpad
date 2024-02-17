<div id="addcontentimages"  class="modal fade" role="dialog" >
    <div class="modal-dialog modal-lg" style="width: 900px;margin:0 auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Adding Images</h4>
                <input type="hidden" id="newid" name="newid" />
            </div>
            <form method="post" action="" enctype="multipart/form-data" id="cropcontentimages" class="user_image">
                <div class="image-editor">
                    <label for="user_content_image" style="display:block;text-align: center">Choose a photo for Slider :</label>
                    <input type="file" id="user_content_image" name="user_content_image" class="cropit-image-input" style="margin:0 auto;">
                    <div class="cropit-preview" style="width: 750px;height: 460px;margin:0 auto"></div>
                    <small style="color: red;">@foreach($errors->get('userimage') as $message ) {{$message}}   @endforeach</small>
                    <input type="range" class="cropit-image-zoom-input" style="width: 50%;margin:0 auto">
                    <input type="hidden" name="image-data" id="image-data" class="hidden-image-data" />
                </div>
                <br>
                <div class="image-editor" id="second-image-editor">
                    <label for="user_content_image_small" style="display:block;text-align: center">Choose a photo for landing page :</label>
                    <input type="file" id="user_content_image_small" name="user_content_image_small" class="cropit-image-input" style="margin:0 auto">
                    <div class="cropit-preview" style="cursor:pointer;width:448px;height: 280px;margin:0 auto;" ></div>
                    <small style="color: red;">@foreach($errors->get('userimage') as $message ) {{$message}}   @endforeach</small>
                    <input type="range" class="cropit-image-zoom-input" style="width: 50%;margin:0 auto">
                    <input type="hidden" name="second-image-data" id="second-image-data" class="second-hidden-image-data" />
                </div>

                <br>


                <div class="image-editor" id="third-image-editor">
                    <label for="user_content_image_verysmall" style="display:block;text-align: center">Choose a small photo for mobile :</label>
                    <input type="file" id="user_content_image_verysmall" name="user_content_image_verysmall" class="cropit-image-input" style="margin:0 auto">
                    <div class="cropit-preview" style="width: 100px;height: 100px;margin:0 auto;"></div>
                    <small style="color: red;">@foreach($errors->get('userimage') as $message ) {{$message}}   @endforeach</small>
                    <input type="range" class="cropit-image-zoom-input" style="width: 50%;margin:0 auto">
                    <input type="hidden" name="image-data3" id="image-data3" class="third-hidden-image-data" />
                </div>


                <div class="row modal-footer">
                    <div class="col-md-3" style="margin-top: 50px">
                        <div class="form-group">
                            <input type="button" value="Return" data-dismiss="modal" class="btn btn-danger btn-block"  />
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-top: 50px">
                        <div class="form-group">
                            <input type="button" value="Save" data-dismiss="modal" class="btn btn-success btn-block"  />
                        </div>
                    </div>
                </div>
            </form>
            <div id="result" style="display: none">
                <code>$form.serialize() =</code>
                <code id="result-data"></code>
            </div>
        </div>
    </div>
</div>