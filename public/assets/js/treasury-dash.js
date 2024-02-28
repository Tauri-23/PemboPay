$(document).ready(function() {
    const monthArr = ['Jan', 'Feb', 'March', 'Apr', 'May', 'June', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const yearsArr = [2023, 2024, 2025, 2026, 2027];

    const salaryChartMonthsTestData = [300000, 200000, 150000, 290000, 270000, 275000, 273000, 270000, 290000, 280000, 211123, 212232];

    //canvases
    const compensationChart = $('#compentsation-chart');
    const budgetChart = $('#budget-chart');
    const employeeChart = $('#employee-chart');

    createLineChart(compensationChart, monthArr, [503100, 50291], 'Salary', 'rgba(67, 119, 254, .3)', 'rgb(67, 119, 254)');
    createLineChart(budgetChart, monthArr, [503100, 50291], 'Budget', 'rgba(255, 184, 0, .3)', 'rgba(255, 184, 0, 1)');
    createLineChart(employeeChart, monthArr, [200, 190], 'Employees');

    
});