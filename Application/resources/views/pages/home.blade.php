@extends('layouts.pages')
@section('title', $seo->seo_title)
@section('content')
   <div class="rodiondevfiles-drag-zone" id="rodiondevfiles-drag-zone">
      <div class="ibobdrag rodiondevfiles-drag-zone-place">
         <div class="rodiondevfiles-home-modal">
            <div class="modal modal-blur fade" id="modal-full-width" tabindex="-1" role="dialog" aria-hidden="true">
               <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">
                           <span class="d-none d-md-flex">{{__('JPEG JPG PNG GIF PDF DOC DOCX XLX XLSX CSV TXT MP4 M4V WMV MP3 M4A WAV APK ZIP RAR - ')}}{{__('Max '.$settings->max_filesize.' MB')}}</span>
                        </h5>
                        <span class="float-right rodiondevfiles-reset-button d-none">
                        <div class="upload-more" id="rodiondevfiles-upload-clickable">
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                              <polyline points="9 15 12 12 15 15" />
                              <line x1="12" y1="12" x2="12" y2="21" />
                           </svg>
                           {{__('Upload more')}}
                        </div>
                     </span>
                        <button type="button" class="btn-close btn-close-here" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <div class="rodiondevfiles-main-upload-section">
                           <div id="upload-process">
                              <div id="rodiondevfiles-uploader-box" class="rodiondevfiles-uploader-box">
                                 <div id="rodiondevfiles-upload-clickable" class="rodiondevfiles-uploder-place">
                                    <div class="rodiondevfiles-upload-icon">
                                       <img class="img-responsivee" src="{{ asset('images/sections/upload.png') }}" alt="Upload">
                                    </div>
                                    <h3>{{__('Drag and drop or ')}}<span>{{__('browse')}}</span>{{__(' files here to upload')}}</h3>
                                    <p>{{__('You can upload '.$settings->onetime_uploads.' files in one time.')}}</p>
                                    <p><span>{{__('Max Filesize. '.$settings->max_filesize.' MB(s)')}}</span></p>
                                 </div>
                              </div>
                              <div class="uploaded-success row" id="rodiondevfiles-preview-uploads"></div>
                              <div>
                                 <div id="rodiondevfiles-drop-template" class="col-lg-4 mb-3 m-auto rodiondevfiles-uploader-area d-none">
                                    <div class="rodiondevfiles-card fade-in">
                                    <span class="success-icon-box d-none fade-in">
                                       <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                    </span>
                                       <span class="error-icon-box d-none fade-in">
                                       <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                                    </span>
                                       <div class="remove-icon">
                                          <i data-dz-remove class="fa fa-remove"></i>
                                       </div>
                                       <img class="rodiondevfiles-upload-icon" src="{{ asset('images/sections/loading.gif') }}">
                                       <div class="rodiondevfiles-files-upload">
                                          <div class="rodiondevfiles-files-name text-overflow" data-dz-name></div>
                                          <div class="rodiondevfiles-uploder-progress">
                                             <div class="alert alert-danger alert-error d-none" role="alert"></div>
                                             <label for="copy" class="link-label d-none">Download file link</label>
                                             <div class="input-group mb-3">
                                                <input readonly id="" class="form-control anchor1 success-input d-none" value="">
                                                <button id="copy" data-id="" class="btn btn-success success-button d-none">{{__('Copy')}}</button>
                                             </div>
                                             <label for="view" class="link-label d-none">Online view link</label>
                                             <div class="input-group mb-3">
                                                <input readonly id="" class="input-view-copy form-control anchor2 success-input d-none" value="">
                                                <button id="view" data-id="" class="btn btn-success success-button d-none" onclick="copyText()">{{__('Copy')}}</button>
                                             </div>
                                             <a href="#" target="_blank" class="btn btn-primary btn-download d-none w-100">{{__('Go to download page')}}</a>
                                             <a href="#" target="_blank" class="btn btn-primary view-btn d-none w-100">{{__('Go to online view page')}}</a>
                                             <div class="progress upload-progress">
                                                <div data-dz-uploadprogress class="progress-bar bg-primary progress-bar-striped" role="progressbar" style="width: 0%"
                                                     aria-valuemin="0" aria-valuemax="100">{{__('Uploading...')}}</div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @if($ads->home_ads_top != null)
            <div class="top-Ads container">
               <div class="rodiondevfiles__top_ads text-center">
                  {!! $ads->home_ads_top !!}
               </div>
            </div>
         @endif
         <div class="rodiondevfiles-uploader-out" id="rodiondevfiles-uploader-out">
            <div id="rodiondevfiles-upload-clickable" class="rodiondevfiles-home-page-content rodiondevfiles-uploder-out-place">
               <div class="container-xl">
                  <div class="row justify-content-center">
                     <div class="col-10">
                        <div class="rodiondevfiles-home-text text-center">
                           <svg xmlns="http://www.w3.org/2000/svg" class="faa-bounce animated icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" /><polyline points="9 15 12 12 15 15" /><line x1="12" y1="12" x2="12" y2="21" /></svg></span>
                           <h2 class="rodiondevfiles-big-title">{{ $settings->home_heading }}</h2>
                           <p class="rodiondevfiles-description d-mobile-none">
                              {{ $settings->home_descritption }}
                           </p>
                           <button id="rodiondevfiles-upload-clickable" class="rodiondevfiles-strat-uploading btn btn-primary">{{__('Start uploading')}}</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @if($ads->home_ads_bottom != null)
            <div class="bottom-Ads container">
               <div class="rodiondevfiles__bottom_ads text-center">
                  {!! $ads->home_ads_bottom !!}
               </div>
            </div>
         @endif
      </div>
   </div>
@endsection
