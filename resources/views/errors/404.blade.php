@extends('backpack::layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">

      <div class="error-page">
        <h2 class="headline text-red">403</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-red"></i> You are not allowed to Access this Resource.</h3>

          <p>
              <?php
              $default_error_message = "Please return to <a href='".url('')."'>our homepage</a>.";
              ?>
            {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
          </p>

        </div>
      </div>
      <!-- /.error-page -->

    </section>
    <!-- /.content -->
  </div>

@endsection
