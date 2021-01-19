<!DOCTYPE html>
 
<html lang="en">
<head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Install DataTables in Laravel - Tutsmake.com</title>
<link href="{{url('/')}}/css/bootstrap.min.css" rel="stylesheet">  
<link  href="{{url('/')}}/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="{{url('/')}}/css/jquery.js"></script>  
<script src="{{url('/')}}/css/bootstrap.min.js"></script>
<script src="{{url('/')}}/css/jquery.dataTables.min.js"></script>
</head>
      <body>
         <div class="container">
                   <h2>Laravel DataTable - Tuts Make</h2>
      <table class="table table-bordered" id="laravel_datatable">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Created at</th>
                      
                  </tr>
               </thead>
            </table>  
         </div>
   <script>
   $(document).ready( function () {
    $('#laravel_datatable').DataTable({
           processing: true ,
           serverSide: true ,
           ajax: "{{ url('users-list') }}",
           columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'created_at', name: 'created_at' } 
                 ]
        });
     });
  </script>
   </body>
</html>