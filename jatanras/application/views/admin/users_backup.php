<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h2 class="page-header">Users</h2>
<?php $this->load->view('messages'); ?>
<div class="mb-3">
  <a href="<?php echo site_url('/admin/users/edit_details'); ?>" class="btn btn-success"><span class="fa fa-plus-circle"></span> Add User</a>
   <a href="<?php echo site_url('/admin/users/print_users'); ?>" target="_blank" class="btn btn-primary"><span class="fa fa-print"></span> Print User</a>
</div>
<div class="card">
  <div class="card-header">Users list</div>
  <div class="card-body">
    <form action="<?php echo site_url('admin/users/get_results'); ?>" method="POST">
      <div class="row">
        <div class="col-sm-5">
          <div class="form-inline">
            <?php $options = array('10'=>'10','20'=>'20','30'=>'30','50'=>'50','100'=>'100'); ?>
            Show <?php echo form_dropdown('limit', $options, $this->session->userdata('users.filter.limit'), 'onchange="this.form.submit();" class="form-control form-control-sm mx-sm-2"'); ?> entries
          </div>
        </div>
        <div class="col-sm-7">
          <div class="form-inline float-sm-right">
            Search: <input type="text" name="search" class="form-control form-control-sm ml-sm-2" placeholder="Search" value="<?php echo $this->session->userdata('users.filter.search'); ?>">
          </div>
        </div>
      </div>
      <div class="row">
        <?php if(empty($users)): ?>
          <div class="alert alert-warning">No result found</div>
        <?php else: ?>
          <div class="col-12 mt-3 mb-3">
            <div>
            <table class="table table-sm table-striped table-bordered table-hover table-responsive-sm">
              <thead class="thead-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Last Visit Date</th>
                  <th scope="col">Register Date</th>
                  <th scope="col">Activated</th>
                </tr>
              </thead>
              <tbody>                    
                <?php foreach($users as $user): ?>
                  <?php if($user->id <> '1'): ?>
        
                  <tr>
                    <td><?php echo $user->id; ?></td>
                    <td><a href="<?php echo site_url('/admin/users/edit_details/'.$user->id); ?>"><?php echo $user->name; ?></a></td>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->last_visit_date; ?></td>
                    <td><?php echo $user->register_date; ?></td>
                    <td>
                    <?php if($user->activation): ?>
                      <div class="text-success"><span class="fa fa-check"></span></div>
                    <?php else: ?>
                      <div class="text-danger"><span class="fa fa-times"></span></div>
                    <?php endif; ?>
                    </td>
                  </tr>

                  <?php endif; ?>
                <?php endforeach; ?>                                                          
              </tbody>
            </table>
          </div>
          </div>
          <div class="col-sm-6"><?php echo $enteries; ?></div>
          <div class="col-sm-6 text-right"><?php echo $pagination; ?></div>
        <?php endif; ?>
      </div>
    </form>
  </div>
</div>