@extends('layouts.admin.index')
 @section('content')
     @push('title')
         <title>{{$title}}</title>
     @endpush


  <div class="container-fluid">
      <div class="panel panel-default">


      <div class="panel-body">
          <div class="table-responsive" style="margin-bottom: 15px;padding-bottom: 5px; border-bottom: 1px solid #e9e9e9;">
              <div class="box-header1 with-border">
                  <div class="pull-right">
                      @if (!empty($topMenuRight) && count($topMenuRight))
                          @foreach ($topMenuRight as $item)
                              <div class="menu-right">
                                  {!! trim($item) !!}
                              </div>
                          @endforeach
                      @endif
                  </div>
              </div>
              <div class="box-header1 with-border">

                  <div class="pull-left">
                      @if (!empty($optionRows))
                  <div id="buttons"  >

                      <div class="btn-group">

                          <button type="button"   class="btn btn-default grid-select-all" data-toggle="tooltip"  data-original-title="{{trans('list.button_select_all')}}"><i class="fa fa-square-o"></i></button>
                          <button style="margin:0 5px 0 5px;" type="button"  class="btn  btn-danger grid-trash" data-toggle="tooltip"  data-original-title="{{trans('list.button_delete_all')}}">
                              <i class="fa fa-trash-o" ></i> </button>
                      </div>

                  </div>
                          <div id="optionRow"  >
                      <b>Show</b>
                      <div class="btn-group">
                          <form action="{{$urlSort}}" class="button_search">
                              <div   class="btn-group pull-right">
                          <select  onchange="$(this).submit();" class="form-control"  name="show_rows" id="show_rows">
                              {!! $optionRows ?? '' !!}
                          </select>
                              </div>

                          </form>
                      </div>
                     <b>entries </b>
                  </div>
                  @endif
                      @if (!empty($buttonSort))
                          <div id="selectSort"   class="menu-left">

                              <div class="btn-group" style="float: left;">
                                  <select class="form-control" name="order_sort" id="order_sort">
                                      {!! $optionSort??'' !!}
                                  </select>
                              </div>
                              <div class="btn-group">
                                  <a style="    border-top-left-radius: 0;
    border-bottom-left-radius: 0;" class="btn btn-flat btn-primary" data-toggle="tooltip" data-original-title="{{ trans('admin.sort') }}" id="button_sort">
                                      <i class="fa fa-sort-amount-asc"></i>
                                  </a>
                              </div>
                          </div>


                      @endif



                  </div>

              </div>
          </div>
              <div class="table-responsive">
              <section id="pjax-container" class="table-list">

            <table class="table table-bordered table-hover"  style="width: 100%;"   id="users_datatable">
              <thead>
              <tr>
                  <th  class="text-left" style="width:45px; background-color: #337ab7; color: #fff ;     border: 1px solid #ddd;">
                   {{--   <input type="checkbox" class="grid-row-checkbox"  checked disabled>--}}
                  </th>
                    @foreach($listTh as $key => $th)
                      <th style="background-color: #337ab7;color: #fff;    border: 1px solid #ddd;">{!! $th !!}</th>

                    @endforeach
              </tr>
              </thead>
              <tbody>
              @foreach($dataTr as $keyRow => $tr)
                  <tr>
                      <td style="width: 1px; padding: 3px;" class="text-center">
                          <input  type="checkbox" class="grid-row-checkbox"   data-id={{$tr['id']}}>
                      </td>
                      @foreach($tr as $key => $trtd)

                         <td style="{{$key === 'action' ? 'width: 170px;' : ''}} ">{!! $trtd !!}</td>

                      @endforeach

                  </tr>
               @endforeach



               </tbody>
            </table>

                  <div class="box-footer clearfix">
                      {!! $resultItems??'' !!}
                      {!! $pagination??'' !!}
                  </div>


              </section>

          </div>

      </div>


          {{--  popup  --}}
          @if(isset($page))   @include('admin.includes.pupupForms.'.$page) @endif

      </div>

  </div>

 @endsection


  @push('scripts')
      <script src="{{url('/')}}/view/javascript/jquery.pjax.js" type="text/javascript"></script>

      <script type="text/javascript">

          $('select[name="order_sort"]').on('change', function(e) {
              var url ="{{$urlSort.'?sort_order='}}"+$('#order_sort option:selected').val();
              $.pjax({url: url, container: '#pjax-container'})
          });
          $('#button_sort').click(function(event) {
              var url ='{{$urlSort??''}}?sort_order='+$('#order_sort option:selected').val();
              $.pjax({url: url, container: '#pjax-container'})
          });
          $(document).on('submit', '.button_search', function(event) {
              $.pjax.submit(event, '#pjax-container')
          })
         $('input[name="keyword"]').on('keyup click', function(e) {
             var url ="{{$urlSort.'?keyword='}}"+$(this).val();
              $.pjax({url: url, container: '#pjax-container'});
              $('#loading').hide();
          });
          $('select[name="status"]').on('change', function(e) {
              var url ="{{$urlSort.'?status='}}"+$(this).val();
              $.pjax({url: url, container: '#pjax-container'});

          });


      </script>

 <script type="text/javascript">

     $('.save').on('click', function() {
         $('#contact-form').submit();
     });

     $("#contact-form").on('submit',function (e) {
         e.preventDefault();
         $.ajax({
             data: $(this).serialize(),
             url:'{{ $urlSave?? '' }}',
             type: "POST" ,
             dataType: 'json',
             success: function (data)
             {
                 hidePopup()
                 alertJs(data.type, data.msg);
                 $.pjax.reload({container:'#pjax-container' });
             } ,
             error: function (data)
             {
                 console.log('Error:', data);
             }

         });

     });




     function deleteItem(ids)
      {

          Swal.mixin({
              customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger',
              },
              buttonsStyling: true,

          }).fire({
              title: 'Are you sure to delete this item?',
              text: "",
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, delete it!',
              confirmButtonColor: "#DD6B55",
              cancelButtonText: 'No, cancel!',
              reverseButtons: true,


              preConfirm: function() {
                  return new Promise(function(resolve) {
                      $.ajax({
                          method: 'post',
                          url: '{{ $urlDeleteItem ?? '' }}',
                          data: {ids:ids ,
                              _token: '{{ csrf_token() }}',
                          },
                          success: function (data) {
                              if(data.error == 1){
                                  //alertJs('error', data.msg);
                                  alertMsg('Access denied!', 'You not have a permission to delete this item..', 'error');
                              }else{
                                  $.pjax.reload({container:'#pjax-container' });
                                  resolve(data);

                              }

                          }
                      });
                  });
              }

          }).then((result) => {
              if (result.value) {
                  alertMsg('Success','Item has been deleted.' ,'success');
                  //alertJs('success','Item has been deleted.');
              } else if (
                  // Read more about handling dismissals
                  result.dismiss === Swal.DismissReason.cancel
              ) {
                  // swalWithBootstrapButtons.fire(
                  //   'Cancelled',
                  //   'Your imaginary file is safe :)',
                  //   'error'
                  // )
              }
          })
      } // end deleteitem function


 </script>

  @endpush

