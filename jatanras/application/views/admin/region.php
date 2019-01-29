<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h2 class="page-header">Cabang</h2>
<?php $this->load->view('messages'); ?>
<div class="mb-3">
  <a href="<?php echo site_url('/admin/region/edit_details'); ?>" class="btn btn-success"><span class="fa fa-plus-circle"></span> Add Cabang</a>
</div>
<div class="card">
  <div class="card-header">Cabang list</div>
  <div class="card-body">
    <form action="<?php echo site_url('admin/region/get_results'); ?>" method="POST">
      <div class="row">
        <div class="col-sm-5">
          <div class="form-inline">
            <?php $options = array('10'=>'10','20'=>'20','30'=>'30','50'=>'50','100'=>'100'); ?>
            Show <?php echo form_dropdown('limit', $options, $this->session->userdata('region.filter.limit'), 'onchange="this.form.submit();" class="form-control form-control-sm mx-sm-2"'); ?> entries
          </div>
        </div>
        <div class="col-sm-7">
          <div class="form-inline float-sm-right">
            Search: <input type="text" name="search" class="form-control form-control-sm ml-sm-2" placeholder="Search" value="<?php echo $this->session->userdata('region.filter.search'); ?>">
          </div>
        </div>
      </div>
      <div class="row">
        <?php if(empty($region)): ?>
          <div class="alert alert-warning">No result found</div>
        <?php else: ?>
          <div class="col-12 mt-3 mb-3">
            <div class="table-responsive">
              <table class="table table-sm table-striped table-bordered table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Edit</th>                        
                  </tr>
                </thead>
                <tbody>                    
                  <?php foreach($region as $rows): ?>
                    <tr>
                      <td><?php echo $rows->id; ?></td>
                      <td><a href="<?php echo site_url('admin/files/index/'.$rows->id); ?>"><?php echo $rows->name; ?></a></td>
                      <td align="center">
            <a href="<?php echo site_url('/admin/region/edit_details/'.$rows->id);?>"><span class="fa fa-edit"></span></a>
            <!--
            <a href="<?php echo site_url('/admin/region/hapus_details/'.$country->id);?>"><span class="fa fa-trash"></span></a>
          -->
      </td>
                    </tr>
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