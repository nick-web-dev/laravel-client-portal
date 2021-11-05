class pageProfile {
	static init($){
        jQuery("#collapseDiv-key").on('show.bs.collapse hidden.bs.collapse', function () {
            jQuery(".key-div-container").toggleClass("border-orange-20 border-direct");
            jQuery(".key-div svg").toggleClass("fa-flip-vertical");
        })

        jQuery(".collapse-div").on("show.bs.collapse hidden.bs.collapse", function(){
            jQuery(this).parent().toggleClass("option-container");
            jQuery(this).parent().find("svg").toggleClass("fa-flip-vertical");
        })
    }
}

jQuery(() => { pageProfile.init(); });