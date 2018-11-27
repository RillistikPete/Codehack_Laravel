<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <div class="input-group">
            <input type="text" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
        <!-- /.input-group -->
    </div>


    <!-- Side Widget Well -->
    <div class="well">
            <h4>Laravel Blog</h4>
            <p>Welcome to my blog. To create a new post or comment on existing posts, login or register a new account.
                Feel free to create a new post about anything you'd like. 
                Based on your activity, you will be assigned the role of "author" or "subscriber".</p>
    </div>


    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">

                    @if ($categories)

                        @foreach ($categories as $category)
                            
                            <li><a href="#">{{$category->name}}</a>
                            </li>

                        @endforeach

                    @endif
                </ul>
            </div>  <!-- /.col-lg-6 -->

        </div> <!-- /.row -->
    </div>


</div>