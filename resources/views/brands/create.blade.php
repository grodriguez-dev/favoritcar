<div class="container-center">
	<div class="col-md-5">
        <div class="card">
            <div class="card-header">
            	@if(empty($brand->name))
                	<h1>Create Brand</h1>
                @else
                	<h1>Edit Brand: {{$brand->name}}</h1>
                @endif
            </div>
            <div class="card-body">
                <form action="@if(empty($brand->name)) {{route('brands.store')}} @else {{route('brands.update', $brand->id)}} @endif" method="POST" enctype="multipart/form-data" >
                	@csrf
                	@if(!empty($brand->name)) 
		              @method('PUT')
		              <input type="hidden" name="hiddenimg" class="form-control" value="{{ $brand->image }}" />
		            @endif
                    <div class = "form-group">
                        <label for="txtID">Name </label>
                        <input type="text" required class="form-control" value="{{ $brand->name ?? '' }}" name="name" placeholder="Name of the brand">
                    </div>

                    <div class = "form-group">
                        <label>Imagen: </label>
                        <br/>
                        <input type="file" name="image">
                    </div>
                	
                	@if(!empty($brand->name))
	                  <button type="submit" class="btn btn-warning">Editar</button>
	                  <a href="{{ route('brands.create') }}" class="btn btn-danger">Cancelar</a>
	                @else
	                  <button type="submit" class="btn btn-success">Agregar</button>
	                @endif
                </form>
            </div>
        </div>
    </div>
</div>