<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title')</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>
<body>
@component('mail::message')
# INTERNSHIP

@foreach($users as $user)
Greetings {{$user->fname}}, this email is to notify you as a field supervisor to register for the Makerere University Internship System. Simply click the "Register" button below.

<a href='localhost:8000/registerfieldsupervisor/{{$user->id}}'>
<button class="btn btn-primary">
Register
</button></a>
@endforeach

<br>Thanks,<br>
{{ config('app.name') }}
@endcomponent
</body>
</html>