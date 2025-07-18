<div class="container-fluid" id="reading">

</div>
<script>
    $(document).ready(function () {
        const currentYear = (new Date()).getFullYear();
        const range = (start, stop, step) => Array.from({ length: (stop - start) / step + 1 }, (_, i) => start + (i * step));
        const years = range(currentYear, currentYear - 50, -1);

        $('#reading').empty();

        $.each(years, function (index, year) {
            const d = new Date();
            let y = d.getFullYear();
            let month_now = d.getMonth();

            let badge;

            if (y == year) {
                badge = '<span class="badge badge-success">Current</span>';
            } else {
                badge = '';
            }

            $('#reading').append(`
                <div class="card">
                    <div class="card-header" data-bs-toggle="collapse" data-bs-target="#reading_${index}" aria-expanded="false" aria-controls="reading_${index}">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="container-title">${year} ${badge}</h4>
                            <i class="fa fa-chevron-down rotate-icon" id="icon_${index}"></i>
                        </div>
                    </div>
                    <div class="card-body collapse" id="reading_${index}">
                        <div id="months_${index}" class="row"></div>
                    </div>
                </div>
            `);

            $(`#reading_${index}`).on('show.bs.collapse', function () {
                const monthContainer = $(`#months_${index}`);
                monthContainer.empty();
                for (let month = 0; month < 12; month++) {
                    const monthName = new Date(year, month).toLocaleString('default', { month: 'long' });
                    const monthNumber = String(month + 1).padStart(2, '0');
                    if (month_now == month && y == year) {
                        badge = '<span class="badge badge-success">Current</span>';
                    } else {
                        badge = '';
                    }
                    monthContainer.append(`
                        <div class="col-md-3 utilityReadingModal" data-bs-toggle="modal"
                        data-bs-target="#utilityListModal" data-date="${year}-${monthNumber}">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h6 class="text-center">${monthName} ${badge}</h6>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });

        });

        $('#period').on('show.bs.collapse', function (e) {
            $(e.target).prev('.card-header').find('.rotate-icon').addClass('rotate-up');
        });

        $('#period').on('hide.bs.collapse', function (e) {
            $(e.target).prev('.card-header').find('.rotate-icon').removeClass('rotate-up');
        });
    });
</script>