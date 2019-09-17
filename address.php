<?php display_message(); ?>
	<div class="form-row">
	<div class="col-md-6 mb-3">
	  <label for="validationCustom01">Name</label>
	  <input type="text" class="form-control" name="name" id="validationCustom01" placeholder="Name" value="<?php echo $_SESSION['name']; ?>" disabled required>
	  <div class="invalid-feedback">
	    Please provide your name.
	  </div>
	</div>

	<div class="col-md-6 mb-3">
	  <label for="validationCustom02">Address Line 1</label>
	  <input type="text" class="form-control" name="address1" id="validationCustom02" placeholder="Door no, Street .." required>
	  <div class="invalid-feedback">
	    Please provide a valid address.
	  </div>
	</div>
	<div class="col-md-12 mb-3">
	  <label for="validationCustom02">Address Line 2</label>
	  <input type="text" class="form-control" name="address2" id="validationCustom02" placeholder="Block, City/Town .." required>
	  <div class="invalid-feedback">
	    Please provide a valid address.
	  </div>
	</div>
	</div>
	<div class="form-row">

	  <input type="hidden" class="form-control" name="city" id="validationCustom03" value="Mangalore" placeholder="Mangalore" required>
	  


	  <input type="hidden" class="form-control" name="state" id="validationCustom04" value="Karnataka" placeholder="Karnataka" required>
	  


	<div class="col-md-4 mb-3">
	  <label for="validationCustom03">City</label>
	  <input type="text" class="form-control" id="validationCustom03" value="Mangalore" placeholder="Mangalore" disabled>
	  <div class="invalid-feedback">
	    Please provide a valid city.
	  </div>
	</div>
	<div class="col-md-4 mb-3">
	  <label for="validationCustom04">State</label>
	  <input type="text" class="form-control" id="validationCustom04" value="Karnataka" placeholder="Karnataka" disabled>
	  <div class="invalid-feedback">
	    Please provide a valid state.
	  </div>
	</div>

	<div class="col-md-4 mb-3">

    <div class="form-group">
      <label for="exampleFormControlSelect1">Zip</label>
      <select class="form-control" id="exampleFormControlSelect1" name="zip" value="<?php echo $row['pin']; ?>" required>
        <?php display_pincodes(); ?>
        <div class="invalid-feedback">
           Please provide a valid zip.
        </div>
      </select>
    </div>




<!-- 	  <label for="validationCustom05">Zip</label>
	  <input type="text" class="form-control" name="zip" id="validationCustom05" placeholder="Zip"  value="<?php echo $row['pin']; ?>" required>
	  <div class="invalid-feedback">
	    Please provide a valid zip.
	  </div> -->
	</div>
	</div>
	<div class="form-row">
	<div class="col-md-6 mb-3">
	  <label for="validationCustom03">Phone Number</label>
      <div class="input-group-prepend">
        <div class="input-group-text">+91</div>
        <input type="number" class="form-control" name="contactnumber1" id="validationCustom03" placeholder="Contact Number" value="<?php echo $row['contact_number']; ?>" required>
      </div>

	  <div class="invalid-feedback">
	    Please provide a valid number.
	  </div>
	</div>

	<div class="col-md-6 mb-3">
	  <label for="validationCustom03">Alternative Phone Number</label>
      <div class="input-group-prepend">
        <div class="input-group-text">+91</div>
        <input type="number" class="form-control" name="contactnumber2" id="validationCustom03" value="<?php echo $row['alternative_contact_number']; ?>" placeholder="Contact Number 2">
      </div>
      
	  <div class="invalid-feedback">
	    Please provide a valid number.
	  </div>
	</div>
	</div>