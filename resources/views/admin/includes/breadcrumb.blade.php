@if(Session('breadcrumbs'))

<div class="page-header not-print" style="border-bottom: 1px solid #e9e9e9;">
    <div class="container-fluid" id="breadcrumb">
       <div class="pull-right">
          <?php echo Session('breadcrumbs')['buttons'] ; ?>
       </div>
        <div class="pull-left">
      <h1 > {!!  Session('breadcrumbs')['heading_title']!!}  <small></small></h1>
<ul class="breadcrumb">
    @foreach ( Session('breadcrumbs')['breadcrumbs'] as $breadcrumbs )
        <li><a href="{{ route($breadcrumbs['href']) }}">  {!!  $breadcrumbs['text'] !!} </a></li>
    @endforeach
</ul> </div>
</div>
</div>

@endif
