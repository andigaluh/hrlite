<?php 
if(isset($list)){	
	$val=$list->row_array();
}else{
    $val=array();
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <?php if($this->session->flashdata('message')){?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('message');?>
            </div>
        <?php }?>

       <form id="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('/config')?>/submit" class="form-horizontal formular" role="form">
            <div id="general" class="tab-pane in active">
					   <div class="form-group">
			   
			   <?php echo form_hidden('id',isset($val['id']) ? $val['id'] : '')?>
						   <?php $nm_f="code";?>
						   <div class="col-sm-3">
			   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
			   </div>
			   <div class="col-sm-9">
					<div class="clearfix">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-xs-10 col-sm-4 validate[required]">
					</div>
			</div>
		   </div>
		   
		   
		   <div class="space-4">&nbsp;</div>
		   <div class="form-group">
			   
			   <?php $nm_f="name";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="form-control validate[required] text-input">
			   </div>
		   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="short_name";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
				   </div><div class="col-sm-9">
				   <input type="text" name="<?php echo $nm_f?>"  id="<?php echo $nm_f?>" value="<?php echo $a= (isset($val[$nm_f]) ? $val[$nm_f] : '') ?>" class="col-sm-2 validate[required]">
			   </div>
		   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="address";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
				   </div><div class="col-sm-6">
				   <?php echo form_textarea($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required] form-control'");?>
			   </div>
		   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="cp1";?>
			   <div class="col-sm-2">
				   <label for="<?php echo $nm_f?>">Contact Person</label>
				   </div>
				   <div class="col-sm-1"><label class="pull-right"> #1</label>
				   </div>
				   <div class="col-sm-4">
				   <?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required] form-control'");?>
			   </div>
			   <div class="col-sm-1">
				   
				   <?php $nm_f="cp2";?>
				   <label for="<?php echo $nm_f?>" class="pull-right"	>#2</label>
				   </div><div class="col-sm-4">
				   <?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required] form-control'");?>
			   </div>
			   
		   </div>
		  
		   <div class="form-group">
			   
			   <?php $nm_f="phone1";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Phone</label>
				   
				   </div>
				<div class="col-sm-4">
				   <?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required] form-control'");?>
			   </div>
			   <?php $nm_f="phone2";?>
			   <div class="col-sm-1">
				   <label for="<?php echo $nm_f?>">/</label>
				   </div><div class="col-sm-4">
				   <?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required] form-control'");?>
			   </div>
			   
		   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="fax1";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>">Facsimile</label>
				   </div><div class="col-sm-4">
				   
				   <?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required] form-control'");?>
			   </div>
			   <?php $nm_f="fax2";?>
			   <div class="col-sm-1">
				   <label for="<?php echo $nm_f?>">/</label>
				   
				   </div><div class="col-sm-4">
				   <?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required] form-control'");?>
			   </div>
		   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="email";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
				   
				   </div><div class="col-sm-9">
				   <?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required] col-sm-3'");?>
			   </div>
			   
		   </div>
		   <div class="form-group">
			   
			   <?php $nm_f="website";?>
			   <div class="col-sm-3">
				   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
				   
				   </div><div class="col-sm-9">
				   <?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required] col-sm-3'");?>
			   </div>
			   
		   </div>
					   <!--div class="form-group">
						   <label for="exampleInputEmail3">Is Active?</label> 
						   <input data-no-uniform="true" type="checkbox" <?php echo $a = ($val['is_active']=='Active' ? 'checked' : '');?> name="is_active" class="iphone-toggle">
					   </div-->
				   </div>
				   
				   <div id="detail" class="tab-pane">
					   <div class="form-group">
						   
						   <div class="col-sm-3">
						   <?php $nm_f="company_type";?>
						   <label for="<?php echo $nm_f?>">Company Type</label>
						   </div>
						   <div class="col-sm-9">
						   <?php $a="BUMN";
										$mark=($val[$nm_f]==$a ? TRUE : FALSE);
										//echo $mark;
							   $data = array(
							   'name'        => $nm_f,
							   'id'          => $nm_f,
							   'value'       => $a,
							   'checked'     => $mark,
							   'style'       => 'margin:10px',
							   
							   );
							   
							   echo form_radio($data);
										
						   ?>
						   <label for="<?php echo $nm_f?>"><?php echo $a?></label>&nbsp;&nbsp;&nbsp;&nbsp;
						   
						   
							<?php $a="Public Listed";
								   $mark=($val[$nm_f]==$a ? TRUE : FALSE);
								   //echo $mark;
							$data = array(
							   'name'        => $nm_f,
							   'id'          => $nm_f,
							   'value'       => $a,
							   'checked'     => $mark,
							   'style'       => 'margin:10px',
							   );
							   
							   echo form_radio($data);
										
						   ?>
							   <label for="<?php echo $nm_f?>"><?php echo $a?></label>&nbsp;&nbsp;&nbsp;&nbsp;
							   
							   <?php $a="PMA";
								   $mark=($val[$nm_f]==$a ? TRUE : FALSE);
							   $data = array(
							   'name'        => $nm_f,
							   'id'          => $nm_f,
							   'value'       => $a,
							   'checked'     => $mark,
							   'style'       => 'margin:10px',
							   );
							   
							   echo form_radio($data);
										
						   ?>
							   <label for="<?php echo $nm_f?>"><?php echo $a?></label>&nbsp;&nbsp;&nbsp;&nbsp;
						   
							   <?php $a="Private Company";
								   $mark=($val[$nm_f]==$a ? TRUE : FALSE);
							   $data = array(
							   'name'        => $nm_f,
							   'id'          => $nm_f,
							   'value'       => $a,
							   'checked'     => $mark,
							   'style'       => 'margin:10px',
							   );
							   
							   echo form_radio($data);
										
						   ?>
							   <label for="<?php echo $nm_f?>"><?php echo $a?></label>&nbsp;&nbsp;&nbsp;&nbsp;
							   
							   <?php $a="Others";
								   $mark=($val[$nm_f]==$a ? TRUE : FALSE);
							  $data = array(
							   'name'        => $nm_f,
							   'id'          => $nm_f,
							   'value'       => $a,
							   'checked'     => $mark,
							   'style'       => 'margin:10px',
							   );
							   
							   echo form_radio($data);
										
						   ?>
							   <label for="<?php echo $nm_f?>"><?php echo $a?></label>&nbsp;&nbsp;&nbsp;&nbsp;
						   
						   
						   
						   </div>
						   
					   </div>
					   <div class="form-group">
						   
						   <div class="col-sm-3">
						   <?php $nm_f="npwp";?>
						   <label for="<?php echo $nm_f?>">NPWP No.</label>
						   </div>
						   <div class="col-sm-4">
						   <?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required] form-control'");?>
						   </div>
						   
						   <div class="col-sm-2">
						   <?php $nm_f="corporate_date";?>
						   
						   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
						   </div>
						   <div class="col-sm-3">
							   
							   <div class="input-group">
						   <?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required,custom[date]] form-control date-picker' data-date-format='yyyy-mm-dd'");?>
								   <span class="input-group-addon">
									   <i class="fa fa-calendar bigger-110"></i>
								   </span>
								</div>
						   </div>
						   
					   </div>
					   <div class="form-group">
						   
						   <div class="col-sm-3">
						   <?php $nm_f="siup";?>
						   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
						   </div>
						   <div class="col-sm-4">
						   <?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required] form-control'");?>
						   </div>
						   
						   <div class="col-sm-2">
						   <?php $nm_f="siup_date";?>
						   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
						   </div>
						   <div class="col-sm-3">
							   
							   <div class="input-group">
						   <?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required,custom[date]] form-control date-picker' data-date-format='yyyy-mm-dd'");?>
							   <span class="input-group-addon">
								   <i class="fa fa-calendar bigger-110"></i>
							   </span>
						   </div>
						   </div>
						   
					   </div>
					   <div class="form-group">
						   <div class="col-sm-3">
						   <?php $nm_f="public_listing";?>
						   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
						   </div>
						   <div class="col-sm-4">
						   <?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='form-control'");?>
						   </div>
						   <div class="col-sm-2">
						   <?php $nm_f="listed_date";?>
						   <label for="<?php echo $nm_f?>"><?php echo ucfirst($nm_f)?></label>
						   </div>
						   <div class="col-sm-3">
							   
							   <div class="input-group">
						   <?php echo form_input($nm_f,$a= (isset($val[$nm_f]) ? $val[$nm_f] : ''),"id='$nm_f' class='validate[required,custom[date]] form-control date-picker' data-date-format='yyyy-mm-dd'");?>
								   <span class="input-group-addon">
									   <i class="fa fa-calendar bigger-110"></i>
								   </span>
							   </div>
						   </div>
						   
					   </div>

    		<div class="form-group">
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
            
             </div>
				   </div>
                            </div>
    </section>
                            </form>
</div>