require('./bootstrap');

if($('#monitor-from').length > 0) {
    setTimeout(function() {
        $("html, body").animate({
            scrollTop: $('html, body').get(0).scrollHeight,
        }, 40000, "linear");
    },10000);

    setTimeout(function() {
        $(document).scrollTop(0);
        window.location.reload();
    }, 60000);
}

if($('#report').length > 0) {
    $(".picker").click(function () {
        let range = $(this).val();
        let now = new Date().toISOString().slice(0,10);

        switch (range) {
            case 'today':
                setTime(now, now);
                break;
            case 'yesterday':
                let yesterday = getPreviewsDay(1);
                setTime(yesterday, yesterday);
                break;
            case 'on_week':
                let startWeek = getPreviewsDay(7);
                setTime(startWeek, now);
                break;
        }
    });

    function setTime(startDate, finishDate) {
        $('#start_date').val(startDate);
        $('#finish_date').val(finishDate);
    }

    function getPreviewsDay(day) {
        let yesterday = new Date();
        yesterday.setDate(yesterday.getDate() - day);

        return yesterday.toISOString().slice(0,10);
    }
}

