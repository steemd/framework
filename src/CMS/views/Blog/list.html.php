<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h2>Posts list</h2>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            Title
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Author
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post) { ?>
                        <tr>
                            <td>
                                <?php echo $post->title ?>
                            </td>
                            <td>
                                <?php echo date('F j, Y', strtotime($post->date)) ?>
                            </td>
                            <td> 
                               <?php echo $post->name ?>
                            </td>
                            <td>
                                <a href="/posts/<?php echo $post->id; ?>/edit" class="btn btn-default">Edit</a>
                            </td>
                        </tr>
                    <?php } ?> 
                </tbody>
            </table>

        </div>

    </div>
</div>