<div class="modal fade" id="newEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hiiden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background:green;">
              <h5 class="modal-title" id="exampleModalCenterTitle" style="color:white; font-family:mali-reg;">CREATE EVENT</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hiiden="true">&times;</span>
              </button>
            </div>
            <form class="modal-body" enctype="multipart/form-data">
                <div class="form-row">
                  <div class="col-12 form-group">
                      <label for="">Event Name :</label>
                      <input type="text" id="event_name" placeholder="Type in event name here..." class="form-control flat-field" required/>
                  </div>
                  <div class="col-12 form-group">
                      <label for="">Organiser :</label>
                      <input type="text" id="organiser" placeholder="Enter organising company, group or individual" class="form-control flat-field" required/>
                  </div>
                  <div class="col-8 form-group">
                      <label for="">Location / Venue :</label>
                      <input type="text" id="venue" placeholder="Enter full location of venue" class="form-control flat-field" required/>
                  </div>
                  <div class="col-4 form-group">
                      <label for="">Type :</label>
                      <select  id="type" class="form-control flat-field">
                          <option value="" disabled selected>Select type</option>
                          <option value="Gospel">Gospel</option>
                          <option value="Social">Social</option>
                          <option value="Professional">Professional</option>
                          <option value="Other">Other</option>
                      </select>
                  </div>
                </div>
                <div class="form-row">
                <div class="col-6 form-group">
                      <label for="">Date :</label>
                      <input type="date" id="date_of_event" placeholder="Date of Event" class="form-control datepicker-here flat-field" required/>
                  </div>
                  <div class="col-6 form-group">
                      <label for="">Time :</label>
                      <input type="time" id="time_of_event" class="form-control flat-field" required/>
                  </div>
                  <!-- PRICES START -->
                      <div class="col-6 form-group">
                        <label for="">Price 1 (Regular) :</label>
                        <input type="number" min="100" step="100" value="" placeholder="Enter amount in Kwacha" id="regular_price"  class="form-control flat-field">
                      </div>
                      <div class="col-6 form-group">
                        <label for="">Price 2 (VIP) :</label>
                        <input type="number" step="100" placeholder="Enter amount in Kwacha" min="100" value="" id="vip_price" class="form-control flat-field">
                      </div>
                  <!-- END PRICES -->


                  <div class="col-12 form-group">
                      <label for="">Description :</label>
                      <textarea id="desc" placeholder="Maximum number of characters is 1000" class="form-control flat-field" cols="30" rows="5"></textarea>
                  </div>
                  <div class="col-12 form-group">
                  <div class="input-group">
                        <div class="custom-file">
                          <input id="file" name="file" type="file" class="custom-file-input"
                            aria-describedby="inputGroupFileAddon01">
                          <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                      </div>
                  </div>
                </div>

            <input type="reset" hidden id="reset_modal">
            </form>
            <div class="modal-footer">
              <button type="reset" id="modal_dismiss" class="btn btn-secondary btn-md flat-field" data-dismiss="modal">DISCARD</button>
              <button type="button" id="add_event_btn" class="btn btn-primary btn-md flat-field">CREATE EVENT</button>
            </div>
          </div>
        </div>
      </div>