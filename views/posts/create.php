<div class="container">
    <div class="row">

<h1>Create New Post</h1>

        <form class="form-horizontal" role="form" method="post" action="/posts/create">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="title" placeholder="Title" value="">
                </div>
            </div>

            <div class="form-group">
                <label for="message" class="col-sm-2 control-label">Content</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="10" name="content"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Tags</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="tags" placeholder="Tags" value="">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                    <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
                </div>
            </div>
        </form>
</div>

</div>