<section class="site-section cta-big-image pb-0 mt-4" id="about-section">
    <div class="container">

        <div class="card">
            <!-- card header -->
            <div class="card-header bg-dark">
                <div class="row">
                    <div class="col-6 text-white"><h2 class="mb-0 mt-2">Employees</h2></div>
                    <div class="col-6 text-right">
                        <a href="<?php echo site_url('employees'); ?>" class="btn btn-light" id="back-button">Go Back</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="<?php echo site_url('employees/save/'.(isset($employee) ? $employee[0]->id : '')); ?>" class="bg-white col ajax-form" type="POST">
                    <input type="hidden" name="csrf_test_name" value="<?php echo $csrf_test_name; ?>">
                    
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label class="text-black" for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required value="<?php echo isset($employee) ? $employee[0]->name : ''; ?>">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label class="text-black" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required value="<?php echo isset($employee) ? $employee[0]->email : ''; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label class="text-black" for="position">Position</label>
                            <input type="text" id="position" name="position" class="form-control" required value="<?php echo isset($employee) ? $employee[0]->position : ''; ?>">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label class="text-black" for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" class="form-control phone-mask" required value="<?php echo isset($employee) ? $employee[0]->phone : ''; ?>">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label class="text-black" for="salary">Salary</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">CAD$</span>
                                </div>
                                <input type="text" id="salary" name="salary" class="form-control money" required value="<?php echo isset($employee) ? $employee[0]->salary : ''; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label class="text-black" for="date_hired">Date Hired</label>
                            <input type="text" id="date_hired" name="date_hired" class="form-control datepicker date-mask" required value="<?php echo isset($employee) ? $employee[0]->date_hired : ''; ?>">
                        </div>
                    </div>

                    <div class="row form-group mt-4">
                        <div class="col-12 text-right">
                            <p class="message d-block d-md-inline-block mb-0 mr-4"></p>
                            <button type="submit" class="btn btn-primary text-white ajax-loader">
                                <span>Save</span>
                                <div class="spinner-border text-white" role="status">
                                    <span class="sr-only"></span>
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>