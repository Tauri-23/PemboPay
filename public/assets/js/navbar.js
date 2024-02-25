$(document).ready(function() {
    const smallPfpBtn = $('#nav-pfp');
    const navSmallOption = $('#nav-small-option');

    smallPfpBtn.on('click',function() {
        navSmallOption.toggleClass('d-none');
    });
    

    
});