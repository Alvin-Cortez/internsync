    $(document).ready(function () {
        let currentQuery = ""
        function loadLogs(page = 1){
            $.ajax({
                type: "GET",
                url: "ajax/logs.php",
                data: {action: 'get', p: page},
                dataType: 'json',
                success: function (response) {
                    $('tbody').html(response.tbody);
                    $('.logs-pagination-btns').html(renderPagination(page, response.totalPages, false));
                    $('.logs-summary-text').text(`Showing ${response.start} to ${response.end} of ${response.total} results`);
                },
                error: function () {
                    $('tbody').html('<tr><td colspan="6">Failed to load activities.</td></tr>');
                }
            });
        }

        function searchLogs(query, page = 1){
            $.ajax({
                type: "GET",
                url: "ajax/search.php",
                data: {action: 'search', search: query, p: page},
                dataType: 'json',
                success: function (response) {
                    $('tbody').html(response.tbody);
                    $('.logs-pagination-btns').html(renderPagination(page, response.totalPages, true));
                    $('.logs-summary-text').text(`Showing ${response.start} to ${response.end} of ${response.total} results`);
                }
            });
        }

        function renderPagination(currentPage, totalPages, isSearch){
            let html = '';
            if (currentPage > 1) {
                html += `<button class="page-btn" data-page="${currentPage - 1}" data-search="${isSearch ? 1 : 0}"><</button>`;
            }
            let start = Math.max(1, currentPage - 1);
            let end = Math.min(totalPages, currentPage + 1);

            if (currentPage === 1) {
                end = Math.min(totalPages, 3);
            }

            if (currentPage === totalPages) {
                start = Math.max(1, totalPages - 2);
            }

            for (let i = start; i <= end; i++) {
                html += `<button class="page-btn ${i === currentPage ? 'active' : ''}" data-page="${i}" data-search="${isSearch ? 1 : 0}">${i}</button>`;
            }

            if (currentPage < totalPages) {
                html += `<button class="page-btn" data-page="${currentPage + 1}" data-search="${isSearch ? 1 : 0}">></button>`;
            }
            return html;
        }

        $(document).on('click', '.page-btn', function () {
            const page = $(this).data('page');
            const isSearch = $(this).data('search');
            if (isSearch && currentQuery.length > 0) {
                searchLogs(currentQuery, page);
            } else {
                loadLogs(page);
            }
        });

        $(document).on('keyup', '#search', function () {
            const query = $(this).val().trim();
            currentQuery = query;
            if (query.length > 0) {
                searchLogs(query);
            } else {
                loadLogs();
            }
        });


        $('.logs-add-btn').on('click', function () {
            $('#addActivityModal').addClass('show').css('display', 'flex');
        });


        $(document).on('click', '.logs-edit', function () {
            const row = $(this).closest('tr');
            $('#editActivityModal').addClass('show').css('display', 'flex');
            $('#editActivityModal #modal-date').val(row.data('date'));
            $('#editActivityModal #modal-time-in').val(row.data('timein'));
            $('#editActivityModal #modal-time-out').val(row.data('timeout'));
            $('#editActivityModal #modal-desc').val(row.data('activity'));
            $('#edit-log-id').val(row.data('id'));
        });


        $('#closeAddModal, #closeEditModal, .modal-close, .modal-cancel, .edit-cancel, .modal-btn').on('click', function () {
            $('#addActivityModal').removeClass('show').css('display', 'none');
            $('#editActivityModal').removeClass('show').css('display', 'none');
            $('#modal-delete').removeClass('show').css('display', 'none');
        });

        $('#modal-add').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "http://localhost/internsync/index.php?page=add-logs",
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    loadLogs();
                    $('#addActivityModal').removeClass('show');
                    $('#modal-add')[0].reset();
                    showToast({ type: response.status, message: response.msg });
                }
            });
        });

        $('#modal-edit').on('submit', function (e){ 
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "http://localhost/internsync/index.php?page=update-logs",
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        loadLogs();
                        $('#editActivityModal').removeClass('show');
                        $('#modal-edit')[0].reset();
                        showToast({ type: response.status, message: response.msg });
                    } else {
                        alert(response.msg);
                    }
                },
                error: function () {
                    alert('Something went wrong while updating.');
                }
            });
        });


        $(document).on('click', '.logs-delete', function () {
            const id = $(this).data('id');
            $('#confirm-delete').data('id', id);
            $('#modal-delete').addClass('show').css('display', 'flex');
        });

        $('#confirm-delete').on('click', function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "http://localhost/internsync/index.php?page=delete-logs",
                data: { id: id },
                dataType: "json",
                success: function (response) {
                    loadLogs();
                    $('#modal-delete').removeClass('show');
                    showToast({ type: response.status, message: response.msg });
                }
            });
        });

        function showToast({ type = "info", message = "" }) {
            const toast = $(`
                <div class="toast toast-${type}">
                ${message}
                </div>
            `);

            $("#toast-container").append(toast);

            toast.click(() => toast.remove());
            setTimeout(() => {
                toast.fadeOut(400, () => toast.remove());
            }, 4000);
        }

        // Progess Bar
        var renderedPercent = parseFloat($('.progress-circle').data('rendered'));

        var radius = 30;
        var circumference = 2 * Math.PI * radius;
        var offset = circumference - (renderedPercent / 100) * circumference;

        $('#progressBar').css('stroke-dashoffset', offset);
        $('#progressText').text(renderedPercent + '%');

        var $openBtn = $('#openProfileModal');
            var $overlay = $('#profileModalOverlay');
            var $closeBtn = $('#closeProfileModal');
            var $navBtns = $('.profile-nav-btn');
            var $sections = {
                profile: $('#profileSection'),
                password: $('#passwordSection'),
                email: $('#emailSection')
            };

            $openBtn.on('click', function() {
                $overlay.css('display', 'flex');
                var scrollBarWidth = window.innerWidth - document.documentElement.clientWidth;
                $('body').css('padding-right', scrollBarWidth > 0 ? scrollBarWidth + 'px' : '');
                $('body').css('overflow', 'hidden');
            });

            $closeBtn.on('click', function() {
                $overlay.css('display', 'none');
                $('body').css('overflow', '');
                $('body').css('padding-right', '');
            });

            $overlay.on('click', function(e) {
                if (e.target === this) {
                    $overlay.css('display', 'none');
                    $('body').css('overflow', '');
                    $('body').css('padding-right', '');
                }
            });

            $navBtns.on('click', function() {
                $navBtns.removeClass('active');
                $(this).addClass('active');
                var section = $(this).data('section');
                $.each($sections, function(key, $el) {
                    $el.css('display', (section === key) ? 'block' : 'none');
                });
            });
        
        loadLogs();
    });