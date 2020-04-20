<div class="modal fade" id="newCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hiiden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background:orange;">
              <h5 class="modal-title" id="exampleModalCenterTitle" style="color:white; font-family:mali-reg;">ADD NEW MERCHANT COMPANY</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hiiden="true">&times;</span>
              </button>
            </div>
            <form class="modal-body">
                <div class="row">
                    <div class="col-7 form-group">
                        <label for="Company name">Company name</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Enter company name here" id="company_name" requred/>
                    </div>
                    <div class="form-group col-5">
                        <label for="">Industry</label>
                        <select id="industry" class="form-control form-control-sm">
                            <option selected disabled>Choose Industry</option>
                            <?php
                                $opt = mysqli_query($conn, "SELECT * FROM indulstry ORDER BY name ASC");
                                while($row = mysqli_fetch_assoc($opt)){
                                    echo "<option value=".$row['indulstry_id'].">".$row['name']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="">Email Address</label>
                        <input type="email" class="form-control form-control-sm" placeholder="e.g youname@domain.com" id="email_address">
                    </div>
                    <div class="col-6 form-group">
                        <label for="">Phone number</label>
                        <input type="tel" class="form-control form-control-sm" placeholder="+265 145 6756" id="phone_number" required/>
                    </div>
                    <div class="col-12 form-group">
                        <label for="">Physical Address</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Enter traceable aidress here" id="phy_address" required/>
                    </div>
                </div>
                <input type="reset" hidden id="reset_modal">
              </form>
            <div class="modal-footer">
              <button type="reset" id="modal_dismiss" class="btn btn-secondary btn-sm flat-field" data-dismiss="modal">DISCARD</button>
              <button type="button" id="add_company_btn" class="btn btn-primary btn-sm flat-field">REGISTER</button>
            </div>
          </div>
        </div>
      </div>