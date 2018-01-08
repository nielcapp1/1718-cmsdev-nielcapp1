/* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
console.log(document.getElementById("mySidenav"))
function openNav() {
    document.getElementById("mySidenav").style.width = "100%";
    document.getElementById("main").style.marginLeft = "100%";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    document.body.style.backgroundColor = "white";
}

// Ervaring | Block
$(window).on( "load", function() { 
    $('.experience-block').height($('.experience-image').outerHeight());
});
$(window).resize(function(){
    $('.experience-block').height($('.experience-image').outerHeight());
});

// Home | Block
$(window).on( "load", function() { 
    $('.home-block').height($('.home-image').outerHeight());
});
$(window).resize(function(){
    $('.home-block').height($('.home-image').outerHeight());
});

// Cars | Block
$(window).on( "load", function() { 
    $('.cars-block').height($('.cars-image').outerHeight());
});
$(window).resize(function(){
    $('.cars-block').height($('.cars-image').outerHeight());
});
