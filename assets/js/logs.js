/* // Add Activity Modal
const addActivityModal = document.getElementById('addActivityModal');
const editActiivityModal = document.getElementById('editActivityModal');


const addActivity = () =>{
    addActivityModal.style.display = 'flex';
}

const closeAddModal = () =>{
    addActivityModal.style.display = 'none';
}

const editActvity = () => {
    editActiivityModal.style.display = 'flex';
}

const closeEditModal = () => {
    editActiivityModal.style.display = 'none';
} */

    $(document).ready(function () {
        loadLogs();

        function loadLogs(page = 1){
            $.ajax({
                type: "GET",
                url: "ajax/logs.php",
                data: {action: 'get', p: page},
                dataType: 'json',
                success: function (response) {
                    $('tbody').html(response.tbody);
                    $('.logs-pagination-btns').html(renderPagination(page, response.totalPages));
                    $('.logs-summary-text').text(`Showing ${response.start} to ${response.end} of ${response.total} results`);
                },
                error: function () {
                    $('tbody').html('<tr><td colspan="6">Failed to load activities.</td></tr>');
                }
            });
        }

        $('.logs-add-btn').on('click', function () {
            $('#addActivityModal').addClass('show');
        });

        $(document).on('click', '.logs-edit', function () {
            const row = $(this).closest('tr');
            $('#editActivityModal').addClass('show');
            $('#editActivityModal #modal-date').val(row.data('date'));
            $('#editActivityModal #modal-time-in').val(row.data('timein'));
            $('#editActivityModal #modal-time-out').val(row.data('timeout'));
            $('#editActivityModal #modal-desc').val(row.data('activity'));
            $('#edit-log-id').val(row.data('id'));
        });

        $('#closeAddModal, #closeEditModal, .modal-cancel, .edit-cancel').on('click', function () {
            $('#addActivityModal').removeClass('show');
            $('#editActivityModal').removeClass('show');
        })

        $(document).on('click', '.page-btn', function () {
            const page = $(this).data('page');
            loadLogs(page);
        });

        function renderPagination(currentPage, totalPages) {
            let html = '';
            if (currentPage > 1) {
                html += `<button class="page-btn" data-page="${currentPage - 1}"><</button>`;
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
                html += `<button class="page-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>`;
            }

            if (currentPage < totalPages) {
                html += `<button class="page-btn" data-page="${currentPage + 1}">></button>`;
            }

            /*// Last
            if (currentPage < totalPages) {
                html += `<button class="page-btn" data-page="${totalPages}">>></button>`;
            } */

            return html;
        }

        $('#modal-add').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "http://localhost/internsync/index.php?page=add-logs",
                data: $(this).serialize(),
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
            $('#modal-delete').addClass('show');
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
    });