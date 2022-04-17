<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{$category->name}}</h3>
    </div>


    <form method="post" action="{{route('admin.category.update', ['category' => $category->id])}}">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Category Name</label>
                <input type="text" name="name" value="{{$category->name}}" class="form-control" id="exampleInputEmail1" placeholder="Category Name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Category Description</label>
                <textarea name="description" class="form-control" id="exampleInputPassword1" placeholder="Category description">
                    {{$category->description}}
                </textarea>
            </div>
        </div>

        <div class="card-footer">
            @method('PUT')
            @csrf
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>