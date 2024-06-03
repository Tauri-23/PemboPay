// inputs
const timesheetMonths = $('#timesheet-months');

timesheetMonths.change(function() {
    window.location.href = `/EmployeeTimesheet/${$(this).val()}`;
});