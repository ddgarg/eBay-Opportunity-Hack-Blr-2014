var searchPage = {
    initialized: false,
    init: function() {
    	if(searchPage.initialized != true){
    		searchPage.initialized = true;
            var filters = $('[name="categories"],[name="volunteer"],[name="location"],[name="language"],[name="timeLeft"],[name="percentFunded"],[name="fundingStatus"]');
            filters.click(function() {
                searchPage.filterCall();
            });
            searchPage.filterCall();
            $('.modernCheckBoxWrapper').each(function () {
                var element = $(this).attr('data-bind');
                if ($(element).is(":checked")) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });
            $('.modernRadioButtonWrapper').each(function () {
                var element = $(this).attr('data-bind');
                if ($(element).is(":checked")) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });
            $('.modernCheckBoxWrapper').click(function () {
                $(this).toggleClass('active');
                var element = $(this).attr('data-bind');
                $(element).trigger('click');
            });
            $('.modernRadioButtonWrapper').click(function () {
                var elementGroup = $(this).attr('data-bind-group'),
                    element = $(this).attr('data-bind');
                $('[name=' + elementGroup + ']').attr("checked", false);
                $('[data-bind-group=' + elementGroup + ']').removeClass('active');
                if (!$(element).is(':checked')) {
                    $(this).toggleClass('active');
                    $(element).attr("checked", true);
                }
            });
    	}        
    },
    filterCall: function() {
        var onFilterSuccess = function(data) {
        	var listCount = 0;
            $.get('js/templates/searchPageTemplate.mst', function(patientDescriptionSecTemplate) {
                $.each(data, function(i, field) {
                	if(listCount < 9){
                		listCount++;
                		var patientDescriptionSecTemplateRendered = Mustache.render(patientDescriptionSecTemplate, {
                            imageSrc: field.imageSrc,
                            amountRaised: field.amountRaised,
                            amountNeeded: field.amountNeeded,
                            amountRemaining: field.amountRemaining,
                            percentageRaised: field.percentageRaised,
                            locations: field.locations,
                            timeLeft: field.timeLeft,
                            patientName: field.patientName
                        });                    
                        $('.searchResultsDisplaySec').append(patientDescriptionSecTemplateRendered);
                	}
                    
                });
            });

        };
        var onFilterError = function(data) {

        };
        var data = {
            "categories": ["Life Threatening", "Livelihood At Risk"],
            "volunteer": "Open",
            "location": "Bangalore",
            "language": "English",
            "timeLeft": "0-5",
            "percentFunded": "0-100",
            "fundingStatus": "All"
        };
        data = JSON.stringify(data);
        callToDB('/rangde-api/rest/search', 'POST', data, onFilterSuccess, onFilterError);
    }
};