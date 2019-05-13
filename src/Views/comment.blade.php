<h1>Comments</h1>
<hr>
<ul>
    <?php

    function lc($cat){
        $category=\Hosein\Comments\Comment::select("*")->where("parent",$cat)->get();
        foreach ($category as $value){
            echo "<li>
                $value->name------
                <a href='".url("comment/$value->id")."'>reply</a>-------
                <a href='".url("commentLike/$value->id")."'>$value->like--like</a>-------
                <a href='".url("commentDislike/$value->id")."'>$value->dislike--dislike</a>-------
                <span>".countComment($value->id)."--Count reply</span>-------";

                echo "<ul>";
                lc($value->id);
                echo "</ul>";

            echo "</li>";
        }
    }
    lc(0);
    function countComment($id){
        return \Hosein\Comments\Comment::select("*")->where("parent",$id)->get()->count();
    }
    ?>

</ul>
<hr>
@if(session("regsComment"))<p>{{session("regsComment")}}</p>@endif
<form action="@if(isset($id)){{url("createMessage")}}/{{$id}}@else{{url("createMessage")}}@endif" method="post">
    {{csrf_field()}}
    <input type="text" name="name" placeholder="Enter Your Name">
    <br><br>
    <input type="text" name="email" placeholder="Enter Your Email">
    <br><br>
    <textarea name="message" placeholder="Enter Your Message" id="" cols="30" rows="10"></textarea>
    <br><br>
    <input type="submit" name="send" value="send">
</form>