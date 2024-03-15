$(document).ready(function() {
    const smallPfpBtn = $('#nav-pfp');
    const navSmallOption = $('#nav-small-option');
    
    const sideNavLogo = $('#side-nav-logo');
    const sideNavLogoImg = $('#side-nav-logo-img');

    const sideNav = $('#side-nav');
    const navbar = $('#navbar');
    const content1 = $('.content-cont-1');


    smallPfpBtn.on('click',function() {
        navSmallOption.toggleClass('d-none');
    });
    

    sideNavLogo.click(function() {
        sideNav.toggleClass('minimize');
        navbar.toggleClass('maximize');
        content1.toggleClass('maximize');
        sideNavLogoImg.attr('src', sideNav.hasClass('minimize') ? '/assets/media/logos/mwp-pembo.png' : '/assets/media/logos/Logo.png');

    });

    
});