<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Application - User List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="navbar navbar-dark bg-dark">
    <div class="container">
        <a href="#" class="navbar-brand">CRUD APPLICATION</a>
    </div>
</div>

<div class="container" style="padding-top: 10px;">
    <div class="row">
        <div class="col-md-12">
            <?php
                $success = $this->session->userdata('success');
                if($success != "") {
            ?>
                <div class="alert alert-success"><?php echo $success;?></div>
            <?php
                }
            ?>
            <?php
                $error = $this->session->userdata('error');
                if($error != "") {
            ?>
                <div class="alert alert-danger"><?php echo $error;?></div>
            <?php
                }
            ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6"><h3>User List</h3></div>
        <div class="col-md-6">
            <a href="<?php echo base_url();?>user/create" class="btn btn-success pull-right"><i class="fa fa-user-plus" aria-hidden="true"></i> Create New User</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created_at</th>
                    <th>Action</th>
                </tr>
                <?php if(!empty($users)) { foreach($users as $user) { ?>
                <tr>
                    <td><?php echo $user['user_id']?></td>
                    <td><?php echo $user['name']?></td>
                    <td><?php echo $user['email']?></td>
                    <td><?php echo $user['created_at']?></td>
                    <td><a href="<?php echo base_url().'user/edit/'.$user['user_id']?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a> | 
                        <a href="<?php echo base_url().'user/delete/'.$user['user_id']?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                </tr>
                <?php } } else { ?>
                <tr>
                    <td colspan="5">Record not found.</td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    
</div>
    
</body>
</html>