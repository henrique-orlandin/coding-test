<div class="modal-header">
    <h4>Employee Details</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <dl>
        <dt>Name</dt>
        <dd><?php echo isset($employee) ? $employee->name : ''; ?></dd>
        <dt>Email</dt>
        <dd><?php echo isset($employee) ? $employee->email : ''; ?></dd>
        <dt>Position</dt>
        <dd><?php echo isset($employee) ? $employee->position : ''; ?></dd>
        <dt>Phone</dt>
        <dd><?php echo isset($employee) ? $employee->phone : ''; ?></dd>
        <dt>Salary</dt>
        <dd><?php echo isset($employee) ? $employee->salary : ''; ?></dd>
        <dt>Date Hired</dt>
        <dd><?php echo isset($employee) ? $employee->date_hired : ''; ?></dd>
    </dl>
</div>