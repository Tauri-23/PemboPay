$(document).ready(function() {
    const monthArr = [
        'Jan 1-15', 
        'Jan 16-31', 
        'Feb 1-15', 
        'Feb 16-29',
        'Mar 1-15', 
        'Mar 16-31', 
        'Apr 1-15', 
        'Apr 16-30', 
        'May 1-15', 
        'May 16-31', 
        'Jun 1-15', 
        'Jun 16-30', 
        'Jul 1-15', 
        'Jul 16-31', 
        'Aug 1-15', 
        'Aug 16-31', 
        'Sep 1-15', 
        'Sep 16-30', 
        'Oct 1-15', 
        'Oct 16-31', 
        'Nov 1-15', 
        'Nov 16-30', 
        'Dec 1-15',
        'Dec 16-31'
    ];
    const yearsArr = [2023, 2024, 2025, 2026, 2027];

    const salaryChartMonthsTestData = [300000, 200000, 150000, 290000, 270000, 275000, 273000, 270000, 290000, 280000, 211123, 212232];

    const salaryChart = [];
    const salaryMonthChart = [];

    empSalaries.forEach(element => {
        salaryChart.push(element.total_net_pay);
        salaryMonthChart.push(element.payroll_period.slice(0, -4));
    });

    const deptSalaries = [];
    const depts = [];
    departments.forEach(department => {
        let deptId = department.id;
        let totalDeptSal = 0;
        payrollRecordsEmp.forEach(payRecord => {
            if(payRecord.employee.department == deptId) {
                totalDeptSal += payRecord.net_pay;
            }
        });
        depts.push(department.department_name);
        deptSalaries.push(totalDeptSal);
    });

    //canvases
    const compensationChart = $('#compentsation-chart');
    const budgetChart = $('#budget-chart');
    const employeeChart = $('#employee-chart');

    createLineChart(compensationChart, salaryMonthChart, salaryChart, 'Salary', 'rgba(67, 119, 254, .3)', 'rgb(67, 119, 254)');
    createBarChart(budgetChart, depts, deptSalaries, 'Department Salary', 'rgba(255, 184, 0, .3)', 'rgba(255, 184, 0, 1)');
    // createLineChart(employeeChart, monthArr, [200, 190], 'Employees');

    
    
});