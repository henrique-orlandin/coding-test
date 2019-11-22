<section class="site-section cta-big-image pb-0 mt-4">
    <div class="container">

        <div class="card">

            <!-- card header -->
            <div class="card-header bg-dark">
                <div class="row">
                    <div class="col-6 text-white"><h2 class="mb-0 mt-2">Employees</h2></div>
                    <div class="col-6 text-right">
                        <a href="<?php echo site_url('employees/form'); ?>" class="btn btn-light"><i class="fa fa-plus"></i> Add</a>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <?php if(count($employees)) { ?>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Phone</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- employees list -->
                            <?php foreach($employees as $each_employee) { ?>
                            <tr>
                                <td class="align-middle"><?php echo $each_employee->name; ?></td>
                                <td class="align-middle"><?php echo $each_employee->email; ?></td>
                                <td class="align-middle"><?php echo $each_employee->position; ?></td>
                                <td class="align-middle"><?php echo $each_employee->phone; ?></td>
                                <td class="text-center align-middle actions-col">
                                    <a href="<?php echo site_url('employees/show/'.$each_employee->id); ?>" class="btn btn-primary ajax-loader show-employee" title="Details">
                                        <span><i class="fa fa-eye"></i></span>
                                        <div class="spinner-border text-white" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </a>
                                    <a href="<?php echo site_url('employees/form/'.$each_employee->id); ?>" class="btn btn-info" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo site_url('employees/delete/'.$each_employee->id); ?>" class="btn btn-danger text-white ajax-loader delete-employee" title="Delete">
                                        <span><i class="fa fa-close"></i></span>
                                        <div class="spinner-border text-white" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
                
                <!-- empty list case -->
                <div class="empty<?php echo count($employees) ? ' d-none' : ''; ?>">
                    <p class="mb-0">No employee registered</p>
                </div>

            </div>
        </div>

        <!-- pagination -->
        <div class="col-12 my-4">
            <nav>
                <?php echo $pages; ?>
            </nav>
        </div>
    </div>

</section>

<!-- modal details -->
<aside>
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
</aside>