// inputs
const timesheetMonths = $('#timesheet-months');

timesheetMonths.change(function() {
    window.location.href = `/TreasuryViewEmployee/${empId}/${$(this).val()}/timesheet`;
});