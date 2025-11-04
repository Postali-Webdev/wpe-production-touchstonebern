jQuery(document).ready(function ($) {

    //Return query text string
    function buildQueryString(data) {
        var queryString = data;
        $('#attorneys > .container > .columns > .column-full').prepend(`<p class="query-string">Results for: <span>"${queryString}"</span></p>`);
    } 

    function filterByName(e) {
        var search = $('#name-filter').val(); 
        $('.attorney-list').append("<div class='loading-wheel'></div>");
        $.ajax({
            type: "POST",
            datType: "html",
            url: ajax_filter_attorneys.ajaxurl,
            data: {
                action: 'filter_by_name',
                name: search
            },
            success: function (data) {
                $('#title').val("");
                $('#services').val("");
                $('.attorney-list').empty();
                $('.attorney-list').append(data);
                if ($('.query-string').length) { 
                    $('.query-string').remove();
                }
                buildQueryString(search);
            },
            error : function(jqXHR, textStatus, errorThrown) {
				console.log('error: ' + errorThrown);
			}
        })
    }

    $('#name-filter-btn').on('click', function (e) {
        filterByName(e)
    });

    $('input#name-filter').keydown(function(e) {
        if (e.key === 'Enter') {
            filterByName(e);
        }
    });

    // Filter by title
    function titleFilter(urlTitle) {
        $('.attorney-list').append("<div class='loading-wheel'></div>");
        if (!$(urlTitle).is('select')) {
            var title = urlTitle;    
            var titleName = urlTitle.replace(/-/g, " ");
        } else {
            var title = $(urlTitle).val();
            var titleName = $(urlTitle).find('option:selected').text();
        }
        
        $.ajax({
            type: "POST",
            datType: "html",
            url: ajax_filter_attorneys.ajaxurl,
            data: {
                action: 'filter_by_title',
                occupation: title
            },
            success: function (data) {
                $('#name-filter').val("");
                $('#services').val("");
                $('.attorney-list').empty();
                $('.attorney-list').append(data);
                if ($('.query-string').length) { 
                    $('.query-string').remove();
                }
                buildQueryString(titleName);
            },
            error : function(jqXHR, textStatus, errorThrown) {
				console.log('error: ' + errorThrown);
			}
        })
    }

    // Run title filter on page load if param exists
    var currentUrl = $(location).attr('href');
    var urlParams = new URLSearchParams(new URL(currentUrl).search);
    var titleParam = urlParams.get("title");
    if (titleParam) {
        titleFilter(titleParam);
        $('#title').val(titleParam);
        $(document).ready(function () {
            $('.attorney-list').empty();
            $('.attorney-list').append("<div class='loading-wheel'></div>");
        })
    }

    // Run title filter on search
    $('#title').on('change', function (e) {
        titleFilter(this);
    });

    // Filter by service
    $('#services').on('change', function (e) {
        var service = $(this).val(); 
        var serviceTitle = $(this).find('option:selected').text();
        $('.attorney-list').append("<div class='loading-wheel'></div>");
        $.ajax({
            type: "POST",
            datType: "html",
            url: ajax_filter_attorneys.ajaxurl,
            data: {
                action: 'filter_by_service',
                service: service
            },
            success: function (data) {
                $('#name-filter').val("");
                $('#title').val("");
                $('.attorney-list').empty();
                $('.attorney-list').append(data);
                if ($('.query-string').length) {
                    $('.query-string').remove();
                }
                buildQueryString(serviceTitle);
            },
            error : function(jqXHR, textStatus, errorThrown) {
				console.log('error: ' + errorThrown);
			}
        })
    });

    // Clear filters
    $('#clear-filters').on('click', function (e) {
        $('.attorney-list').append("<div class='loading-wheel'></div>");
        $.ajax({
            type: "POST",
            datType: "html",
            url: ajax_filter_attorneys.ajaxurl,
            data: {
                action: 'clear_filters',
            },
            success: function (data) {
                $('#name-filter').val("");
                $('#title').val("");
                $('#services').val("");
                $('.attorney-list').empty();
                $('.attorney-list').append(data);
                if ($('.query-string').length) {
                    $('.query-string').remove();
                }
            },
            error : function(jqXHR, textStatus, errorThrown) {
				console.log('error: ' + errorThrown);
			}
        })
    });

})