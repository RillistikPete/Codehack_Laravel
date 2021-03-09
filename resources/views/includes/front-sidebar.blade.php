<div class="col-md-4">

    <!-- Blog Search Well -->
    {{-- <div class="well">
        <h4>Blog Search</h4>
        <div class="input-group">
            <input type="text" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div> --}}


    <!-- Side Widget Well -->
    <div class="well">
            <h4>Laravel Blog</h4>
            <p>Welcome to my blog. To comment on existing posts, login or register a new account. 
                You will be assigned as a subscriber.  If you have an idea for a post, contact me and I'll grant you the role "author",
                allowing you to leave posts! You can reach me at my <a href="/me#contact">email.</a></p>
    </div>

    <?php 
        if(isset($_POST['submit'])){
            $to = "petergforrest91@gmail.com"; // this is your Email address
            $from = $_POST['email']; // this is the sender's Email address
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $subject = "Form submission";
            $subject2 = "Copy of your form submission";
            $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
            $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

            $headers = "From:" . $from;
            $headers2 = "From:" . $to;
            mail($to,$subject,$message,$headers);
            mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
            echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
            // You can also use header('Location: thank_you.php'); to redirect to another page.
            }
    ?>
    
    {{-- <h1>Form submission</h1>

    <form action="" method="post">
    First Name: <input type="text" name="first_name"><br>
    Last Name: <input type="text" name="last_name"><br>
    Email: <input type="text" name="email"><br>
    Message:<br><textarea rows="5" name="message" cols="30"></textarea><br>
    <input type="submit" name="submit" value="Submit">
    </form> --}}



    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">

                    @if ($categories)

                        @foreach ($categories as $category)
                            
                            <li><a href="{{route('home.categ-posts', $category->id)}}">{{$category->name}}</a>
                            </li>

                        @endforeach

                    @endif
                </ul>
            </div>  <!-- /.col-lg-6 -->

        </div> <!-- /.row -->
    </div>
</div>

<style type="text/css">
    .well {
        box-shadow:1px;
        border-radius:10px;
    }
</style>