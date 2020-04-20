<!-- Delete -->
<div class="modal fade" id="del<?php echo $row['company_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Delete</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$del=mysqli_query($conn,"select * from user where userid='".$row['userid']."'");
					$drow=mysqli_fetch_array($del);
				?>
				<div class="container-fluid">
					<h5><center>Firstname: <strong><?php echo $drow['firstname']; ?></strong></center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <a href="delete.php?id=<?php echo $row['userid']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                </div>
				
            </div>
        </div>
    </div>
<!-- /.modal -->

<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $row['company_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="exampleModalCenterTitle">Editing Client #: <?php echo $row['company_id']; ?> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   
                </div>
                <div class="modal-body">
				<?php
					$edit=mysqli_query($conn,"SELECT * FROM company_details JOIN indulstry WHERE company_details.company_id = '".$row['company_id']."' AND company_details.indulstry = indulstry.indulstry_id
                    ORDER BY indulstry.name ASC");
					$erow=mysqli_fetch_assoc($edit);
				?>
				<div class="container-fluid">
				<form method="POST" action="php_scripts/edit.php?id=<?php echo $erow['company_id']; ?>">
					<div class="row">
						<div class="col-lg-12 form-group">
                        <label style="position:relative; top:7px;">Company name:</label>
							<input type="text" name="company_name" class="form-control form-control-sm" value="<?php echo $erow['company_name']; ?>">
						</div>
					</div>
					
					<div class="row">	
						<div class="col-lg-7 form-group">
                            <label style="position:relative; top:7px;">Email Address:</label>
							<input type="email" name="email_address" class="form-control form-control-sm" value="<?php echo $erow['email_address']; ?>">
                        </div>
                        <div class="col-lg-5 form-group">
                        <label style="position:relative; top:7px;">Phone Number:</label>
							<input type="tel" name="phone_number" class="form-control form-control-sm" value="<?php echo $erow['phone']; ?>">
						</div>
                    </div>

                    
                    <div class="row">
                    <div class="col-lg-12 form-group">
                            <label style="position:relative; top:7px;">physical Address / Location:</label>
							<input type="text" name="phy_address" class="form-control form-control-sm" value="<?php echo $erow['phy_address']; ?>">
                        </div>
                    </div>
                    
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm flat-field" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Ignore</button>
                    <button type="submit" class="btn btn-warning btn-sm flat-field"><span class="glyphicon glyphicon-check"></span> Update</button>
                </div>
				</form>
            </div>
        </div>
    </div>