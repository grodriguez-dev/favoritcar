<h1>Brands List</h1>
<a href="{{route('brands.create')}}">Crear</a>
<div class="container">
	<table class="table table-bordered">
	    <thead>
	        <tr>
	            <th>Name</th>
	            <th>Imagen</th>
	            <th>Acciones</th>
	        </tr>
	    </thead>
	    <tbody>
	    	@foreach($brands as $brand)
	        <tr>
	            <td>{{$brand->name}}</td>
	            <td>
	                <img class="img-thumbnail rounded" src="{{asset('assets/brands/'.$brand->image)}}" width="50">
	            </td>
	            <td>
	                <form method="POST" action="{{route('brands.destroy', $brand->id)}}"> 
	                	@csrf
	                	@method('DELETE')
	                	<a href="{{route('brands.show', $brand->id)}}" class="btn btn-primary">Ver</a>
	                	<button type="submit" class="btn btn-danger">Borrar</button>                                                     
	                </form>
	            </td>
	        </tr>
	        @endforeach
	    </tbody>
	</table>
</div>
