@extends('layouts.admin')
@section('title', "View file | ".$upload->main_filename)
@section('content')
<div class="view_file">
   <div class="row">
      <div class="col-lg-6 mb-3 text-center">
         <img src="{{ fileIcon($upload->file_type) }}" class="img-fluid">
         <h2 class="mt-3">{{  shortertext($upload->main_filename, 120) }}</h2>
         <a href="{{ route('download.action', $upload->file_id) }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="20" x2="12" y2="10" /><line x1="12" y1="20" x2="16" y2="16" /><line x1="12" y1="20" x2="8" y2="16" /><line x1="4" y1="4" x2="20" y2="4" /></svg>
            {{__('Download file')}}
         </a>
          <a href="{{ ($upload->file_type === 'mp4' || $upload->file_type === 'm4v' || $upload->file_type === 'wmv') ? env('APP_URL') . '/open/' . $upload->file_id : $upload->file_path }}" class="btn btn-primary" target="_blank">
              <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
              </svg>
              &nbsp;&nbsp;{{ __('View file') }}&nbsp;&nbsp;
          </a>

      </div>
      <div class="col-lg-6">
         <div class="card">
            <div class="card-header">{{__('User information')}}</div>
            <div class="card-body">
               <div class="text-center">
                  @if($upload->user_id != null)
                  <img class="rounded-circle mb-3" src="{{ asset('path/cdn/avatars/'. $upload->user->avatar) }}" alt="" width="110" height="110">
                  <h1>{{ $upload->user->name }}</h1>
                  <h3 class="text-muted">{{ $upload->user->email }}</h3>
                  <h3>
                     @if($upload->user->status == 2)
                     <span class="badge bg-danger">{{__('Banned')}}</span>
                     @elseif($upload->user->status == 1)
                     <span class="badge bg-success">{{__('Active')}}</span>
                     @endif
                     @if($upload->user->permission == 2)
                     <span class="badge bg-secondary">{{__('User')}}</span>
                     @elseif($upload->user->permission == 1)
                     <span class="badge bg-primary">{{__('Admin')}}</span>
                     @endif
                  </h3>
                  @else
                  <img class="rounded-circle mb-3" src="{{ asset('path/cdn/avatars/default.png') }}" alt="" width="110" height="110">
                  <h1>{{__('Anonymous')}}</h1>
                  @endif
               </div>
               <hr class="mb-3"/>
               <div class="divide-y-4">
                  <div class="upload-info">
                     <div class="row">
                        <div class="col">
                           <div class="text-truncate">
                              <strong>{{__('File ID :')}}</strong> {{ $upload->file_id }}
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="upload-info">
                     <div class="row">
                        <div class="col">
                           <div class="text-truncate">
                              <strong>{{__('File size :')}}</strong> {{ formatBytes($upload->file_size) }}
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="upload-info">
                     <div class="row">
                        <div class="col">
                           <div class="text-truncate">
                              <strong>{{__('Uploaded at :')}}</strong> {{ date("d/m/y  H:i A", strtotime($upload->created_at))}}
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
@endsection
