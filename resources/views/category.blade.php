<!DOCTYPE html>
<html>

<head>
    <title>Laravel Category Treeview Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="{{ asset('css/treeview.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">Manage Category TreeView</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Category List</h3>
                        <ul id="tree1">
                            @foreach ($categories as $category)
                                <li>
                                    {{ $category->title }}
                                    @if (count($category->childs))
                                        @include('manageChild', ['childs' => $category->childs])
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h3>Add New Category</h3>

                        <form action="{{ route('add-category') }}" method="POST">
                            @csrf

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif

                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="title">Title:</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Enter Title" value="{{ old('title') }}">
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            </div>

                            <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                                <label for="parent_id">Category:</label>
                                <select name="parent_id" id="parent_id" class="form-control"
                                    placeholder="Select Category">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach ($allCategories as $categoryId => $categoryName)
                                        <option value="{{ $categoryId }}"
                                            {{ old('parent_id') == $categoryId ? 'selected' : '' }}>
                                            {{ $categoryName }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Add New</button>
                            </div>
                        </form>
                    </div>

                </div>


            </div>
        </div>
    </div>
    <script src="{{ asset('/js/treeview.js') }}"></script>
</body>

</html>
