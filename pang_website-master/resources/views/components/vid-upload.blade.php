   @if ($screenMode == 'Add')
       <div class="form-group row">
           <label class="col-sm-3 text-end control-label col-form-label">{{ $labelName }}</label>
           <div class="col-md-9">
               <div class="custom-file">
                   <button type="button" class="btn btn-outline-primary" data-vid-upload-btn>{{ $btnName }}</button>
                   <input type="file" class="custom-file-input{{ $errors->has($attr) ? ' is-invalid' : '' }}"
                       id="{{ $attr }}" name="{{ $inputName }}" accept="vsideo/mp4,video/x-m4v,video/*"
                       multiple="multiple" data-vid-file-upload hidden />
                   <br />
                   <br />
                   <div data-display-video-field class="d-flex flex-column">
                   </div>
               </div>
               @if ($errors->has($attr))
                   <span class="text-danger" role="alert">
                       <strong>{{ $errors->first($attr) }}</strong>
                   </span>
               @endif
           </div>
       </div>

       <template data-vid-template>
           <div data-vid-name>
               <video width="400" height="200" controls id="video">
                   <source src="" id="video_here" data-display-video>
                   Your browser does not support HTML5 video.
               </video>
               <button type="button" class="btn btn-danger" aria-label="Close" onclick="onDeleteVideo(this)"
                   style="position:absolute;">
                   <span aria-hidden="true">&times;</span>
           </div>
       </template>
       <script type="text/javascript" src="{{ URL::asset('js/fileAddHandling.js') }}" defer></script>
   @endif

   @if ($screenMode == 'Edit')
       <div class="form-group row">
           <label class="col-sm-3 text-end control-label col-form-label">{{ $labelName }}</label>
           <div class="col-md-9">
               <div class="custom-file">
                   <button type="button" class="btn btn-outline-primary"
                       data-vid-upload-btn>{{ $btnName }}</button>
                   <input type="file" class="custom-file-input{{ $errors->has($attr) ? ' is-invalid' : '' }}"
                       id="{{ $attr }}" name="{{ $inputName }}" accept="video/mp4,video/x-m4v,video/*"
                       multiple="multiple" data-vid-file-upload hidden />
                   <br />
                   <br />
                   @if ($list[0] == 'noVideo')
                       <div data-display-image-field class="d-flex flex-row flex-wrap"></div>
                   @else
                       <div data-display-video-field class="d-flex flex-column">
                           @foreach ($list as $videoFile)
                               <div data-vid-name="{{ $videoFile }}">
                                   <video width="400" id="video" controls data-media="{{ $videoFile }}">
                                       <source src="{{ asset($videoFile) }}" id="video_here" name="video_src">
                                       Your browser does not support HTML5 video.
                                   </video>
                                   <button type="button" class="btn btn-danger" aria-label="Close"
                                       onclick="onDeletePreviousVideo(this)">
                                       <span aria-hidden="true">&times;</span>
                               </div>
                           @endforeach
                       </div>
                   @endif
               </div>
               {{-- <input type='hidden' value='false' id="isDeletePreviousVideoHiddenField"
                   name="isDeletePreviousVideo" /> --}}
               @if ($errors->has($attr))
                   <span class="text-danger" role="alert">
                       <strong>{{ $errors->first($attr) }}</strong>
                   </span>
               @endif
           </div>
       </div>
       <template data-vid-template>
           <div data-vid-name>
               <video width="400" height="200" controls id="video">
                   <source src="" id="video_here" data-display-video>
                   Your browser does not support HTML5 video.
               </video>
               <button type="button" class="btn btn-danger" aria-label="Close" onclick="onDeleteCurrentVideo(this)">
                   <span aria-hidden="true">&times;</span>
           </div>
       </template>
       <script type="text/javascript" src="{{ URL::asset('js/fileEditHandling.js') }}" defer></script>
   @endif
