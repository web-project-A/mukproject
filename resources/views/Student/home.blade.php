
@extends('layouts.stud')

@section('title', 'Student')
@section('content')
 <!-- Page Wrapper -->
 <div id="wrapper">

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-2 text-gray-800">ITEMS</h1>
    <a href="/Student/guidelines" class="d-none d-sm-inline-block btn btn-sm bg-white shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> View Guidelines</a>
  </div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      @if(session()->has('Success'))
      <div class="alert alert-success alert-block" role="">
      <button type="button" class="close" data-dismiss="alert">×</button>
          <div class="card-body">
              {{session()->get('Success')}}
          </div>
      </div>
    @endif
    
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <tbody>
            <tr>
              <td>Placement Details</td>
              <td><input type="checkbox" @php echo $placement_check; @endphp  class="btn btn-success btn-circle btn-sm"></td>
              <td>
                <a href="/placementDetailsEdit">
                    <button type="" class="btn btn-primary" >Edit</button>
                </a>
              </td>
            </tr>
            <tr>
              <td>Placement Letter</td>
              <td>@php echo $upload_number; @endphp</td>
              <td>
                <button type="" class="btn btn-primary" onclick="location.href='/Student/viewdocuments'">Edit</button>
              </td>
            </tr>
            <tr>
              <td>Daily Journals</td>
              <td>@php echo $journal_number; @endphp</td>
              <td>
                <a href="/Student/journaledit">
                  <button type="" class="btn btn-primary" >View</button>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
<div class="card">
       @foreach($upload as $upload)
             @if($upload->user_id == $user->id)
                 <h4 class="card-header"><strong>Uploaded Documents</strong></h4>
                   @break
                  @endif
               @endforeach
           <div class="">
        @foreach($file as $file)
     @if($file->user_id == $user->id)
          <div class="container">
            <a href="/Student/view/{{ $file->id }}/{{ $file->user_id }}"><h6>{{ $file->name }}</h6> </a>
            </div>              
        @endif
         @endforeach               
         </div>                        
     </div> <br>
     @foreach($display as $display)
         @if($display->user_id == $user->id)
            <a class="btn btn-primary" href="/Student/placementletter">{{ __('Upload') }}</a> 
               @break
          @endif
     @endforeach

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>
<!-- End of Page Wrapper -->

@endsection
