<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h2>Blog editor</h2>
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
                        <th class="text-right">
                            Actions
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
                            <td class="text-right">
                                <a href="/posts/<?php echo $post->id; ?>/edit" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
                                <a href="/posts/<?php echo $post->id; ?>/remove" class="btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Remove</a>
                            </td>
                        </tr>
                    <?php } ?> 
                </tbody>
            </table>

        </div>

    </div>
</div>