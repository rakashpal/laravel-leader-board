<!DOCTYPE html>
<html>
    <head>
        <title>Leader Board</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
      
      </head>
<body>
    @if($categories->isNotEmpty())
    <div class="wraper">
    <label for="cars">Categories</label>
    <select id="category">
        <option value="" >Select Category</option>
     @foreach($categories as $cat)
    <option value="{{$cat->category_id}}">{{$cat->category_title}}</option>
     @endforeach
    </select>
    @else
    <h1>No Category Exists</h1>
    @endif
</div>
    <div id="output">
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
      
        $(document).on('change','#category',function(e){
            e.preventDefault();
           var category_id= $(this).val();
           if(category_id!=''){
            $.ajax({
            type:'POST',
            url:'{{route("to_ten")}}',
            data:{
                "_token": "{{ csrf_token() }}",
                'category_id':category_id
            },
            success:function(response){
                if(response.status==0){
                   
 
            }else{
                $("#output").html(response.data);
            }
            }
        });
    }else{
        $("#output").html('');
    }
        })
       
    });
        </script>
</body>
</html>
