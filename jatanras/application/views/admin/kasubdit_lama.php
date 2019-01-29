<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h2 class="page-header">Kasubdit</h2>
<?php $this->load->view('messages'); ?>
<div class="mb-3">
  <a href="<?php echo site_url('/admin/kasubdit/edit_details'); ?>" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Add Kasubdit</a>
</div>
<div class="card">
  <div class="card-header">Kasubdit list</div>
  <div class="card-body">
    <form action="<?php echo site_url('admin/kasubdit/get_results'); ?>" method="POST">
      <div class="row">
        <div class="col-sm-5">
          <div class="form-inline">
            <?php $options = array('10'=>'10','20'=>'20','30'=>'30','50'=>'50','100'=>'100'); ?>
            Show <?php echo form_dropdown('limit', $options, $this->session->userdata('kasubdit.filter.limit'), 'onchange="this.form.submit();" class="form-control form-control-sm mx-sm-2"'); ?> entries
          </div>
        </div>
        <div class="col-sm-7">
          <div class="form-inline float-sm-right">
            Search: <input type="text" name="search" class="form-control form-control-sm ml-sm-2" placeholder="Search" value="<?php echo $this->session->userdata('kasubdit.filter.search'); ?>">
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
                  <th scope="col">NRP</th>
                  <th scope="col">Nama Lengkap</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Telpon</th>
                  
                  <th scope="col">Activated</th>
                </tr>
              </thead>
              <tbody>                    
                <?php foreach($users as $user): ?>
                  <?php if($user->id <> 'x'): ?>
        
                  <tr>
                    <td><?php echo $user->id; ?></td>
                    <td><a href="<?php echo site_url('/admin/users/edit_details/'.$user->id); ?>"><?php echo $user->nrp; ?></a></td>
                    <td><?php echo $user->nama; ?></td>
                    <td><?php echo $user->alamat; ?></td>
                    <td><?php echo $user->telpon; ?></td>
                    
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