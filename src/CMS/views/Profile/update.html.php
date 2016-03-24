<div class="container">

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit User Profile</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" id="post-form" action="<?php echo $action ?>">
                    <div class="form-group">

                        <label class="col-sm-2 control-label">New Email</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" placeholder="email" value="<?php echo $updateUser->email ?>">
                        </div>
                        <br>
                        <br>
                        <label class="col-sm-2 control-label">New Password</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" placeholder="password" value="<?php echo $updateUser->password ?>">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $updateUser->id ?>">

                        <?php $generateToken() ?>

                        
                    </div>
                    <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-success mr-5">Save</button>
                            <a href="/" class="btn btn-danger">Cancel</a>
                        </div>
                </form>
            </div>

        </div>
    </div>
</div>